<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_req extends CI_Controller
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

        $d['store_req_attente'] = $this->Crud->join_storereq_ep_dept(null,'0');
        $d['pending_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $this->load->view('layout/topbar',$d);
    } 

    public function index()
    {
        /**
         * Store requisition
         * STATUS
         * ------
         * 0: en attente
         * 1: traité
         */

        $store_req_attente = $this->Crud->join_storereq_ep_dept(null,'0');
        //$st_req_satisfied = $this->Crud->join_storereq_ep_dept(null,1);
        $curency = $this->Crud->get_data('curency');

        $d = [
            'store_req_attente' => $store_req_attente,
            // 'st_req_satisfied' => $st_req_satisfied,
            'curency' => $curency
        ];

        $this->load->view('store_req/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }


    public function new_req()
    {
        $d = [
            'equipment_id' => $this->input->post('equipment_id'),
            'quantity' => $this->input->post('quantity'),
            'reason' => $this->input->post('reason'),
            'department_id' => $this->input->post('department_id'),
            'date' => date('d-m-Y',time()),
            'status' => 0
        ];

        $this->Crud->add_data('store_requisition',$d);
        
        $this->session->set_flashdata(['store_req_added'=>true]);

        redirect('department/index');
    }
}