<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    
	    $this->load->model('merchant_model');
	}

	public function index()
	{
		echo "string";
		/*$passwordFromPost = 'AAAAAAAAAAAAA';

		$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $this->config->item('password_hash_options'));

		if (password_verify($passwordFromPost, '$2y$11$etwnox3v0zF6kfqwp5IT8O1K3x5q4z3khGWGOsXGM0eVNWrvSBzBO')) {
		    echo 'Password is valid!';
		} else {
		    echo 'Invalid password.';
		}

		echo $hash;*/
	}

	public function register()
	{
		echo "string";
		/*$passwordFromPost = 'AAAAAAAAAAAAA';

		$hash = password_hash($passwordFromPost, PASSWORD_BCRYPT, $this->config->item('password_hash_options'));

		if (password_verify($passwordFromPost, '$2y$11$etwnox3v0zF6kfqwp5IT8O1K3x5q4z3khGWGOsXGM0eVNWrvSBzBO')) {
		    echo 'Password is valid!';
		} else {
		    echo 'Invalid password.';
		}

		echo $hash;*/
	}

	public function login()
	{

		$this->load->library('form_validation');

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$data['email'] = $email;
		$data['password'] = $password;
		
		$hash = password_hash($password, PASSWORD_BCRYPT, $this->config->item('password_hash_options'));

		$merchant = $this->merchant_model->get_merchant_by_email($email);

		$this->form_validation->set_rules('email', lang('Email'), 'required');
		$this->form_validation->set_rules('password', lang('Password'), 'required');


		if ($this->form_validation->run() == FALSE)
        {
                $data[] = '';
				$this->load->view('merchant/login', $data);
        }
        else
        {
            if ($merchant)
			{
				if (password_verify($password, $merchant->password)) {
				    echo 'Password is valid!';
				} else {
				    echo 'Invalid password.';
				}
			}
        }

		

		
	}

}