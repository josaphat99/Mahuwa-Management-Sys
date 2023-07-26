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
        
        $d['pending_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $this->load->view('layout/topbar',$d);
    } 

    public function index()
    {
        /**
         * Purchase Order
         */
        /**
         * Equipment STATUSES
         * =============
         *
         */

        $capex_eq = $this->Crud->join_equipment_category('capex',5);   
        $all_capex_eq = $this->Crud->join_equipment_category('capex');
        $opex_eq = $this->Crud->join_equipment_category('opex',5);  
        $all_opex_eq = $this->Crud->join_equipment_category('opex');
        $all_eq = $this->Crud->join_equipment_category();

        $d['pending_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $d = [
            'capex_eq' => $capex_eq,
            'all_capex_eq' => $all_capex_eq,
            'opex_eq' => $opex_eq,
            'all_opex_eq' => $all_opex_eq,
            'all_eq' => $all_eq,
        ];
        
        $this->load->view('dg/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}