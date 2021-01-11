<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Properti extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if (!$this->session->userdata('username')) {
        //     redirect('login');
        // }
        $this->load->library('pagination');
        $this->load->model('properti_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $title['title'] = 'Properti';

        // Config pagination
        $config['base_url'] = base_url('properti/index');
        $config['total_rows'] = $this->db->count_all('properti');
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
 
        // Pagination style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';


        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if (!empty($this->input->post('Search'))) {
            $id = $this->input->post('searchById');
            $this->session->set_flashdata(array("search_properti"=>$id));  
            $data['search']=$id;
            $n_row = $this->properti_model->countquery($id)[0]->n_row;
            $config['total_rows'] = $n_row;
            $data['page'] = 0;
        } 
        else{
            if($this->session->flashdata('search_properti') != NULL){
                $data['search']= $this->session->flashdata('search_properti');
                $n_row = $this->properti_model->countquery($data['search'])[0]->n_row;
                $config['total_rows'] = $n_row;
            }
            else{
                $data['search']= '';
                $config['total_rows'] = $this->db->count_all('properti');
            }
        }
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $data['properti'] = $this->properti_model->getPagination($data['search'], $config["per_page"], $data['page']);
        // $data['properti'] = $this->properti_model->getAll();

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // exit($data['properti']);
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("PROPERTI/list_properti", $data);
        $this->load->view('templates/footer.php');
    }

    public function propertidetail($ID_properti = null){
        $title['title'] = 'Detail properti';
        $data["Detail"] = $this->properti_model->getById($ID_properti);
        $data['image'] = $this->properti_model->getImage($ID_properti);
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("PROPERTI/properti", $data);
        $this->load->view('templates/footer.php');
    }

    public function map(){
        $title['title'] = 'Detail properti';
        // $data["Detail"] = $this->properti_model->getById($ID_properti);
        $data['properti'] = $this->properti_model->getNoImage();
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        $this->load->view('templates/header.php', $title);
        $this->load->view('templates/navbar.php', $data);
        $this->load->view("PROPERTI/map", $data);
        $this->load->view('templates/footer.php');
    }

    public function add()
    {
        $title['title'] = 'Tambah Properti';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        
        if ($data['user']['ROLE'] == 'Admin') {
            $pm = $this->properti_model;
            $validation = $this->form_validation;
            $validation->set_rules($pm->rules());
            $post = $this->input->post();

            if ($validation->run() == TRUE) {
                // $config['upload_path'] ='D:\Xampp2\htdocs\SIG\assets\image';
                // $config['upload_path']  = './upload/product/';
                // $config['upload_path'] = './assets/image/';

                // $config['allowed_types'] = 'gif|jpg|png';

                // $this->load->library('upload', $config);
                // $this->upload->do_upload();
                // $pm->save($this->upload->data());
                $pm->save();
                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">Berhasil disimpan</div>');
                redirect('Properti/add');
            }

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("Properti/add", $data);
            $this->load->view('templates/footer.php');
        } 
        else {
            redirect('Properti');
        }
    }

    public function editproperti($id_p = null)
    {
        $title['title'] = 'Edit properti';
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();

        if ($data['user']['ROLE'] == 'Admin') {
            if (!isset($id_p)) redirect('properti');

            $pro = $this->properti_model;
            $validation = $this->form_validation;
            $validation->set_rules($pro->rules2());

            if ($validation->run()) {
                if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
                    redirect('properti');}
                $pro->update();

                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect("properti");
            }

            $data["properti"] = $pro->getById($id_p);

            if (!$data["properti"]) show_404();

            $this->load->view('templates/header.php', $title);
            $this->load->view('templates/navbar.php', $data);
            $this->load->view("properti/edit", $data);
            $this->load->view('templates/footer.php');
        } else {
            redirect('properti');
        }
    }

    public function delete($id_p)
    {
        $pro = $this->properti_model;
        $data['user'] = $this->db->get_where('user', ['USERNAME' => $this->session->userdata('username')])->row_array();
        if ($data['user']['ROLE'] == 'Admin') {
            $data_pro = $pro->getById($id_p);
            $pro->delete($id_p);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Properti berhasil dihapus.</div>');
        } 
        redirect('properti');
    }
}
