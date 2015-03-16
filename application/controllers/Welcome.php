<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
		/*$passwordFromPost = 'AAAAAAAAAAAAA';

		$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $this->config->item('password_hash_options'));

		if (password_verify($passwordFromPost, '$2y$11$etwnox3v0zF6kfqwp5IT8O1K3x5q4z3khGWGOsXGM0eVNWrvSBzBO')) {
		    echo 'Password is valid!';
		} else {
		    echo 'Invalid password.';
		}

		echo $hash;*/
	}
}
