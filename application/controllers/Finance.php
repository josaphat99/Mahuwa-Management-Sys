<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller
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
        
        $d['valid_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'1');

        $this->load->view('layout/topbar',$d);
    }

    public function index()
    {
        //fetch infos from DB

        /**
        * FINANCE
        */

        $user_id = $this->Crud->get_data('account',['id'=>$this->session->id])[0]->user_id;

        $valid_pch_order = $this->Crud->join_pch_st_eq(null,null,null,'1');
        $budget = $this->Crud->join_budget_dept();       

        $d = [
            'valid_pch_order' => $valid_pch_order,
            'budget' => $budget
        ];

        $this->load->view('finance/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}