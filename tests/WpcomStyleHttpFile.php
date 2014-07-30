<?php
/**
 * Created by PhpStorm.
 * User: blowery
 * Date: 7/25/14
 * Time: 12:51 PM
 */

class WpcomStyleHttpFile extends SimplePie_File {

	public function __construct($url, $timeout = 10, $redirects = 5, $headers = null, $useragent = null, $force_fsockopen = false) {
		parent::__construct( $url, $timeout, $redirects, $headers, $useragent, $force_fsockopen);

		if( $this->success && $this->status_code >= 400 ) {
			// status codes above 400 should not be success...
			$this->error = "HTTP $this->status_code";
			$this->success = false;
		}

	}

} 
