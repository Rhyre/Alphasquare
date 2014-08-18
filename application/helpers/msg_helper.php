<?php
/**
 * Message/alert box helper
 * @package Helpers
 * @author Nathan Johnson
 */

/* No direct access allowed */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('msg')) {
	/**
	 * Show an alert box at top of page.
	 * @param  string $msg  The text to show in the alert box
	 * @param  string $type The type of alert to show (Bootstrap class)
	 * @param  string $css  Extra CSS to add.
	 * @return void
	 */
	function msg($msg, $type = "danger", $css = null) {
		$CI =& get_instance();
		$CI->php_session->set_flashdata('msg_text', $msg);
		$CI->php_session->set_flashdata('msg_type', $type);
		if($css) $CI->php_session->set_flashdata('msg_style', $css);
	}
}

if (!function_exists('show_msg')) {
	/**
	 * Show the alert message set by msg.
	 *
	 * This is only used in the main template and doesn't need to be used anywhere else.
	 * 
	 * @return array An array of information about the message
	 */
	function show_msg() {
	    $CI =& get_instance();
	    $msg = array();
	    $msg['text'] = $CI->php_session->flashdata('msg_text');
	    $msg['type'] = $CI->php_session->flashdata('msg_type');
	    $msg['style'] = $CI->php_session->flashdata('msg_style');
	    $msg['exists'] = ($msg['text'] && $msg['type']);
	    return $msg;
	}
}

if (!function_exists('show_form_errors')) {
	/**
	 * Show form validation errors (CI form validation class)
	 * @param  array $errors A string of the errors generated by CI's form validation class.
	 * @return void
	 */
	function show_form_errors($errors) {
		$CI =& get_instance();
		$CI->load->view('templates/validation_errors', array('errors'=>$errors));
	}
}

if (!function_exists('login_required')) {
	/**
	 * Call this on every controller (or method) where user needs to be logged in.
	 * 
	 * This function will return JSON error if it's an AJAX request
	 * or redirect to the login page if it's a normal request.
	 * 
	 * @param  boolean $die Output plain text instead of JSON. Only applies to ajax requests.
	 * @return void
	 */
	function login_required($die = false) {
		$CI =& get_instance();
		if($CI->php_session->get('loggedin')) {
			return false;
		}
		// If it's an ajax request, return json
		if($CI->input->is_ajax_request()) {
			if($die) {
				die('Please <a href="'.base_url('login').'">sign in</a> to view this.');
			}
			else {
				header("Content-Type: application/json");
				header("HTTP/1.0 401 Unauthorized");
				json_error('Please sign in to do that.', 'login');
			}
		}
		// Else redirect page
		else {
			msg('Please sign in to continue.', 'info');
			redirect('login?next='.current_url());
		}
	}
}


/* End of file msg_helper.php */
/* Location: ./application/helpers/msg_helper.php */