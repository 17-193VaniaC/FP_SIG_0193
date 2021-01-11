<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');;
        $this->load->library('form_validation');
        $this->load->library('session');
		if (!$this->session->userdata('username')) {
			// redirect('login');
		}
	}
	public function index()
	{
		$title['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
		$this->load->view('templates/header.php', $title);
		$this->load->view('templates/navbar.php', $data);
		$this->load->view('welcome_message');
		$this->load->view('templates/footer.php');
	}
}
