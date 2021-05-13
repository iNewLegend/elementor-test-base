<?php
namespace ElementorTesting;

use ElementorTesting\Traits\Base_Elementor;
use ElementorTesting\Traits\Extra_Assertions;

abstract class Elementor_Test_AJAX extends \WP_Ajax_UnitTestCase {

	use Base_Elementor, Extra_Assertions;

	public function define_doing_ajax() {
		if ( ! wp_doing_ajax() ) {
			define( 'DOING_AJAX', true );
		}
	}

	public function _handleAjaxAndDecode( $action ) {
		try {
			$this->_handleAjax( $action );
		} catch ( \WPAjaxDieContinueException $e ) {
			unset( $e );
		}

		return json_decode( $this->_last_response, true );
	}
}
