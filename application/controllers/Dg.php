<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dg extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->connected)
		{
			redirect('auth');
		}

        if(!$this->session->type == 'dg')
		{
			redirect('auth');
		}

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/head');
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar');
    } 

    public function index()
    {
        /**
         * Purchase Order
         */
        $pch_order = $this->Crud->join_pch_st_eq();

        $d = [
            'pch_order' => $pch_order,
        ];

        $this->load->view('dg/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}