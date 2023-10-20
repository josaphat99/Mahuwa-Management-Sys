<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->connected)
		{
			redirect('auth');
		}

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/head');
        $this->load->view('layout/sidebar');

        $user_id = $this->Crud->get_data('account',['id'=>$this->session->id])[0]->user_id;
        $department_id = $this->Crud->get_data('user',['id'=>$user_id])[0]->department_id;

        $d['store_req_attente'] = $this->Crud->join_storereq_ep_dept($department_id,'0',null);
        $d['pending_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $this->load->view('layout/topbar',$d);
    }

    public function index()
    {
        //fetch infos from DB

        /**
        * CHEF DE DEPARTEMENT
        * List de requisitions de stock
        * Bons de commandes
        */

        $user_id = $this->Crud->get_data('account',['id'=>$this->session->id])[0]->user_id;
        $department_id = $this->Crud->get_data('user',['id'=>$user_id])[0]->department_id;
        $department_name = $this->Crud->get_data('department',['id'=>$department_id])[0]->name;

        $pending_store_req = $this->Crud->join_storereq_ep_dept($department_id,'0',null);
        $store_req = $this->Crud->join_storereq_ep_dept($department_id,1,null);
        $equipment = $this->Crud->get_data_desc('equipment');

        $d = [
            'pending_store_req' => $pending_store_req,
            'store_req' => $store_req,
            'department_id' => $department_id,
            'department_name' => $department_name,
            'equipment' => $equipment
        ];

        $this->load->view('department/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}