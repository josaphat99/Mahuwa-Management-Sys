<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pch_order extends CI_Controller
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
         * Purchase Order
         * 
         * pch order statuses
         * 
         * 0: pending
         * 1: validated
         * 2: rejected
         */
        $pending_pch_order = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $valid_pch_order = $this->Crud->join_pch_st_eq(null,null,null,'1');

        $d = [
            'pending_pch_order' => $pending_pch_order,
            'valid_pch_order' => $valid_pch_order
        ];

        $this->load->view('pch_order/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //new purchase order
    public function new_order()
    {
        $estimated_price = $this->input->post('estimated_price');
        $quote1 = $this->input->post('quote1');
        $quote2 = $this->input->post('quote2');
        $quote3 = $this->input->post('quote3');
        $quantity = $this->input->post('quantity');
        $curency_id = $this->input->post('curency_id');
        $delivery_date = $this->input->post('delivery_date');
        $st_id = $this->input->post('st_id');


        $d = [
            'date' => date('d-m-Y',time()),
            'estimated_price' =>  $estimated_price,
            'quote1' => $quote1,
            'quote2' => $quote2,
            'quote3' => $quote3,  
            'delivery_date' => $delivery_date,    
            'curency_id' => $curency_id,
            'status' => 0,
            'store_requisition_id' => $st_id
        ];

        //adding a new pch order
        $this->Crud->add_data('purchase_order',$d); 

        //store requisition traité
        $this->Crud->update_data('store_requisition',['id'=>$st_id],['status'=>1]);

        $this->session->set_flashdata(['pch_order_added'=>true]);

        redirect('pch_order/index');
    }

    //validate an order
    public function validate_order()
    {
        $po_id = $this->input->get('po_id');

        $this->Crud->update_data('purchase_order',['id'=>$po_id],['status'=>1]);
        $this->session->set_flashdata(['po_validated' => true]);

        redirect('pch_order/index');
    }

     //rejection an order
     public function reject_order()
     {
         $po_id = $this->input->get('po_id');
 
         $this->Crud->update_data('purchase_order',['id'=>$po_id],['status'=>2]);
         $this->session->set_flashdata(['po_rejected' => true]);
 
         redirect('pch_order/index');
     }

    public function view_order()
    {}
}