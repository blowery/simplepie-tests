<?php

/**
 * A little in-memory cache that we can control.
 *
 * Useful for playing around with the cache interface to see
 * how it works. */
class MemoryCache extends SimplePie_Cache {

	// our cache. Shared across all instances.
	private static $_cache = array();

	// clear the cache
	public static function clear() {
		self::$_cache = array();
	}

	private $key = "";
	private $mtime = "";

	// SimplePie constructs a cache object for each cache item
	public function __construct($location, $name, $type) {
		// figure out our keys and stash them
		$this->key = "$name.$type";
		$this->mtime_key = $this->key . "-mtime";
	}

	public function save( $data ) {
		// Tricky bit here. Only save the data property off the SimplePie object we're passed.
		self::$_cache[ $this->key ] = $data->data;
		self::$_cache[ $this->mtime_key ] = time();
		return true;
	}

	public function load() {
		if ( ! array_key_exists( $this->key, self::$_cache ) ) {
			return null;
		}
		return self::$_cache [ $this->key ];
	}

	public function mtime() {
		if ( ! array_key_exists( $this->mtime_key, self::$_cache ) ) {
			return null;
		}
		return self::$_cache [ $this->mtime_key ];
	}

	public function touch() {
		self::$_cache [ $this->mtime_key ] = time();
	}

	public function unlink() {
		unset( self::$_cache[ $this->key ] );
		unset( self::$_cache[ $this->mtime_key ] );
	}
}

SimplePie_Cache::register( 'memory', 'MemoryCache' );