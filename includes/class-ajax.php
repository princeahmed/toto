<?php

defined('ABSPATH') || exit();

class Toto_Ajax{

	public function __construct() {
		add_action('wp_ajax_toto_save_data', [$this, 'save_data']);
		add_action('wp_ajax_nopriv_toto_save_data', [$this, 'save_data']);
	}

	public function save_data(){

	}

}

new Toto_Ajax();