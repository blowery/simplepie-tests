<?php
require_once "NullCache.php";
require_once "WpcomStyleHttpFile.php";

class SimplePie404Test extends PHPUnit_Framework_TestCase {

	/** @var SimplePie */
	private $pie;

	protected function defaultPie() {
		$pie = new SimplePie();
		$pie->registry->register( "Cache", "NullCache" );
		$pie->set_cache_location( 'null:' );
		$pie->registry->register( "File", "WpcomStyleHttpFile" );

		return $pie;
	}

	public function setUp() {
		$pie = $this->pie = $this->defaultPie();
		$pie->set_feed_url( "http://localhost:9998/4xx/404/" );
		$pie->init();
	}

	public function test404WasReported() {
		$this->assertNotEmpty( $this->pie->error );
	}

}
