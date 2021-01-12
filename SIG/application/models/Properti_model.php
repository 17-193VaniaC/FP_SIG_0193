<?php defined('BASEPATH') or exit('No direct script access allowed');

class Properti_model extends CI_Model
{
    private $_table = "properti";
    private $_table2 = "image";


    public $ID_P;
    public $NAMA_P;
    public $ALAMAT;
    public $TIPE;
    public $LUAS;
    public $DESKRIPSI;
    public $HARGA;
    public $LATITUDE;
    public $LONGITUDE;
    public $input_date;

    public function rules()
    {
        return [
            [
                'field' => 'n_properti',
                'label' => 'n_properti',
                'rules' => 'required'
            ],

            [
                'field' => 'almt',
                'label' => 'alamat',
                'rules' => 'required'
            ],

            [
                'field' => 'type',
                'label' => 'tipe',
                'rules' => 'required'
            ],

            [
                'field' => 'size',
                'label' => 'luas',
                'rules' => 'required'
            ],

            [
                'field' => 'desk',
                'label' => 'deskripsi',
                'rules' => 'required'
            ],

            [
                'field' => 'price',
                'label' => 'price',
                'rules' => 'required'
            ],

            [
                'field' => 'lat',
                'label' => 'latitude',
                'rules' => 'required'
            ],

            [
                'field' => 'long',
                'label' => 'longitude',
                'rules' => 'required'
            ]
        ];
    }

    public function rules2()
    {
        return [
            [
                'field' => 'id_prop',
                'label' => 'id_prop',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll($that = null)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->like('ID_P', $that, 'both');
            // $this->db->order_by('INPUT_DATE', 'desc');
            return $this->db->get('properti')->result();
        }
        $this->db->order_by('input_date', 'asc');
        $response = $this->db->get('properti')->result();
        return $response;
    }

    public function getNoImage()
    {
        $this->db->select('ID_P, NAMA_P, HARGA, DESKRIPSI, ALAMAT, LATITUDE, LONGITUDE, TIPE');
        return $this->db->get('properti')->result();
    }


    public function getPagination($that = null, $limit, $start)
    {
        $response = array();
        if (!empty($that)) {
            $this->db->select('*');
            $this->db->like('ID_P', $that, 'both');
            $this->db->order_by('input_date', 'desc');
            return $this->db->get('properti', $limit, $start)->result();
        }
        $this->db->order_by('input_date', 'desc');
        $response = $this->db->get('properti', $limit, $start)->result();
        return $response;

        // $this->db->order_by('INPUT_DATE', 'desc');
        $response = $this->db->get('properti', $limit, $start)->result();
        return $response;
    }

  
    public function save($dataimg = NULL)
    {
        $post = $this->input->post();
        // $imgdata = $this->input->post(file_get_contents($_FILES['pict']['name']),TRUE);
        // $imgdata = file_get_contents($dataimg['full_path']);//get the content of the image using its path
        // $image = addslashes(file_get_contents($_FILES['pict']['tmp_name']));      
        $image = addslashes(file_get_contents($_FILES['pict']['tmp_name']));
        // (file_get_contents($_FILES['pict']['name'],TRUE));

        // $imgdata = file_get_contents($dataimg['full_path']);
        // $image = $this->input->post(file_get_contents($post['pict']));
        $this->IMG = $image;
        $this->ID_P = uniqid();
        $this->NAMA_P = $post["n_properti"];
        $this->HARGA = $post["price"];
        $this->ALAMAT = $post["almt"];
        $this->LATITUDE = $post["lat"];
        $this->LONGITUDE = $post["long"];
        $this->TIPE = $post["type"];
        $this->LUAS = $post["size"];
        $this->DESKRIPSI = $post["desk"];
        $this->input_date = date("Y-m-d h:i:s");
        return $this->db->insert($this->_table, $this);
    }

    public function getById($ID_P)
    {
        return $this->db->get_where($this->_table, ["ID_P" => $ID_P])->row();
    }

    public function getImage($ID_P)
    {
        return $this->db->get_where($this->_table2, ["P_Img" => $ID_P])->row();
    }


    public function update()
    {
        $post = $this->input->post();
        $this->ID_P = $post['id_prop'];
        $this->NAMA_P = $post["n_properti"];
        $this->HARGA = $post["price"];
        $this->ALAMAT = $post["almt"];
        $this->DESKRIPSI = $post["desk"];
        $this->TIPE = $post["type"];
        $this->LUAS = $post["size"];
        $this->LATITUDE = $post["lat"];
        $this->LONGITUDE = $post["long"];
        if(file_get_contents($_FILES['pict2']['tmp_name'])){
            $image = addslashes(file_get_contents($_FILES['pict2']['tmp_name']));
            $this->IMG = $image;
            
        }
        return $this->db->update($this->_table, $this, array('ID_P' => $post['id_prop']));
    }

    public function delete($id_p)
    {

        return $this->db->delete($this->_table, array("ID_P" => $id_p));
    }

    public function sisa_subtr($KODERBB, $nominal) //untk mengurangi anggaran RBB
    {
        $rbb = $this->db->get_where($this->_table, ["KODE_RBB" => $KODERBB])->row();
        $total = $rbb->SISA_ANGGARAN - $nominal;
        $this->db->set('SISA_ANGGARAN', $total);
        $this->db->where('KODE_RBB', $KODERBB);
        $this->db->update('rbb');
    }

    function getKode()
    {
        $response = array();

        // Select record
        $this->db->select('KODE_RBB');
        $q = $this->db->get('rbb');
        $response = $q->result();

        return $response;
    }
    public function isExist()
    {
        $post = $this->input->post(); //Take from input
        $this->db->where('KODE_RBB', $post["KODE_RBB"]);
        $rbbdata = $this->db->get('rbb')->result();
        if (count($rbbdata) < 1) { //no data found
            return False;
        }
        return true;
    }
    public function sych()
    {
        $post = $this->input->post(); //Take from input
        $this->db->where('KODE_RBB', $post["KODE_RBB"]);
        $rbb = $this->db->get('rbb')->result();
        $used = $rbb[0]->ANGGARAN - $rbb[0]->SISA_ANGGARAN;
        if ($post["NOMINAL"] < $used) { //if the new budget is less than used budget
            return false;
        }
        $new_left = $post["NOMINAL"] - $used;
        $this->db->set("ANGGARAN", $post["NOMINAL"], False);
        $this->db->set("SISA_ANGGARAN", $new_left, False);
        $this->db->where('KODE_RBB', $post['KODE_RBB']);
        $this->db->update('rbb');
        return true;
    }
    public function countquery($name = null)
    {
        if (!empty($name)) {
            $this->db->select('count(rbb.KODE_RBB) as n_row');
            $this->db->like('rbb.KODE_RBB', $name, 'both');
            return $this->db->get('rbb')->result();
        }
        $this->db->select('count(rbb.KODE_RBB) as n_row');
        return $this->db->get('rbb')->result();
    }
}
