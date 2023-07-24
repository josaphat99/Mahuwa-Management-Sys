<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

       //======================================================
		$this->load->model('Crud');
    }
    
   public function view_eq()
   {
        $eq_id = $this->input->post('eq_id');

        $eq = $this->Crud->get_data('equipment',['id'=>$eq_id])[0];

        $img_path = base_url("assets/files/equipments/".$eq->image);

        $html = '<img src="'.$img_path.'" class="img-fluid"/>';

        echo $html;
   }
}