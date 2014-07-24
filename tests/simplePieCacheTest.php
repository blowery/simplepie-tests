<?php

class NullCache implements SimplePie_Cache_Base {

	public function __construct($location, $name, $type) {
		echo "hi";
	}

	public function save( $data ) {
		echo "saving $data\n";
		return false;
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



class SimplePieCachelessTest extends PHPUnit_Framework_TestCase {

	/** @var SimplePie */
	private $pie;

	protected function setUp() {
		SimplePie_Cache::register( 'null-cache', 'NullCache' );
		$this->pie = new SimplePie();
		$this->pie->registry->register( "Cache", "NullCache" );
		$this->pie->set_cache_location( 'null-cache' );
	}

	public function test() {
		$this->pie->set_feed_url( "http://blowery.org/" );
		$this->pie->init();
		$this->assertEquals( "http://feeds.blowery.org/blowery", $this->pie->subscribe_url() );
		$this->assertNotEmpty( $this->pie->raw_data );
	}
}
