<?php
	class Errorpage extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->helper('url');
		}

		public function error404() {
			$this->output->set_status_header( '404' );
			$this->load->view( 'errors/cli/error_404' ); //loading in custom error view
		}
	}

?>