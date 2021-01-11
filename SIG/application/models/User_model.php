<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

    public $EMAIL;
    public $NAMA;
    public $USERNAME;
    public $PASSWORD;

    public function rules()
    {
        return [
            [
                'field' => 'EMAIL',
                'label' => 'email',
                'rules' => 'required'
            ],

            [
                'field' => 'USERNAME',
                'label' => 'email',
                'rules' => 'required'
            ],

            [
                'field' => 'PASSWORD',
                'label' => 'password',
                'rules' => 'required'
            ],
            [
                'field' => 'PASSWORD',
                'label' => 'password',
                'rules' => 'required'
            ]
        ];
    }

    public function index()
    {
        $data["user"] = $this->User_model->getAll();
        $this->load->view("login", $data);
    }
    public function getPagination($that = null, $limit, $start)
    {
        $response = array();
        if (!empty($that) || $that == '0') {
            $this->db->select('*');
            $this->db->like('user.USERNAME', $that, 'both');
            $this->db->order_by('USERNAME', 'asc');
            return $this->db->get('user', $limit, $start)->result();
        }
        // Select record
        $this->db->select('*');
        $this->db->order_by('USERNAME', 'asc');
        return $this->db->get('user', $limit, $start)->result();
    }

    public function getByUsername($usernm)
    {
        return $this->db->get_where($this->_table, ["USERNAME" => $usernm])->row();
    }

    public function getByEmail($email)
    {
        return $this->db->get_where($this->_table, ["EMAIL" => $email])->row_array();
    }

    public function login($usernm, $pswrd)
    {
    }
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function delete($username)
    {
        $this->db->delete('user', array('USERNAME' => $username));
    }
    public function countquery($that = null)
    {
        if (!empty($that) || $that == '0') {
            $this->db->select('count(USERNAME) as n_row');
            $this->db->like('user.USERNAME', $that, 'both');
            return $this->db->get('user')->result();
        }
        // Select record
        $this->db->select('count(USERNAME) as n_row');
        return $this->db->get('user')->result();
    }
    public function deletetoken($token)
    {
        $this->db->delete('user_token', array('token' => $token));
    }
}
