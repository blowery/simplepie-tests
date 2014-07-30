<?php

require_once "NullCache.php";

class SimplePieCacheMissWithAutodiscoveryTest extends PHPUnit_Framework_TestCase {

	/** @var SimplePie */
	private $pie;

	protected function defaultPie() {
		$pie = new SimplePie();
		$pie->registry->register( "Cache", "NullCache" );
		$pie->set_cache_location( 'null:' );
		return $pie;
	}

	protected function setUp() {
		$this->pie = $this->defaultPie();
		$this->pie->set_feed_url( "http://localhost:9998/single/" );
		$this->pie->init();
	}

	public function testHasNoError() {
		$this->assertEmpty( $this->pie->error() );
	}

	public function testHasRightSubscribeUrl() {
		$this->assertEquals( "http://localhost:9998/feed/", $this->pie->subscribe_url() );
	}

	public function testHasADiscoveredFeed() {
		$this->assertEquals(200, $this->pie->all_discovered_feeds[0]->status_code );
	}

	public function testCacheMissHasRawData() {
		$this->assertNotEmpty( $this->pie->raw_data );
	}
}
