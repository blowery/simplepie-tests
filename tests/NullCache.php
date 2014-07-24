<?php

class NullCache extends SimplePie_Cache {

	public function __construct($location, $name, $type) {

	}

	public function save( $data ) {
		return true;
	}

	public function load() {
		return null;
	}

	public function mtime() {
		return null;
	}

	public function touch() {
		return null;
	}

	public function unlink() {
		return null;
	}
}

SimplePie_Cache::register( 'null', 'NullCache' );