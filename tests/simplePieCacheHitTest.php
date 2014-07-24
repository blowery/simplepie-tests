<?php

require_once "MemoryCache.php";

class SimplePieCacheHitTest extends PHPUnit_Framework_TestCase {
	/** @var SimplePie */
	private $pieHit;
	/** @var  SimplePie  */
	private $pieMiss;

	protected function defaultPie() {
		$pie = new SimplePie();
		$pie->registry->register( 'Cache', 'MemoryCache' );
		$pie->set_cache_location( 'memory:' );
		return $pie;
	}

	protected function setUp() {
		MemoryCache::clear();
		$pieMiss = $this->defaultPie();
		$pieMiss->set_feed_url( "http://blowery.org" );
		$pieMiss->init();

		$this->assertNotEmpty( $pieMiss->raw_data, "Cache Miss should have raw data" );

		$pieHit = $this->defaultPie();
		$pieHit->set_feed_url( "http://blowery.org" );
		$pieHit->init();

		$this->pieMiss = $pieMiss;
		$this->pieHit = $pieHit;
	}

	public function testCacheHitDoesNotHaveRawData() {
		$this->assertEmpty( $this->pieHit->raw_data );
	}

}
 