<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encoder extends CI_Controller
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
        //fetch infos from DB

        /**
         * Equipment STATUSES
         * =============
         *
         * 
         * Requisition de stock statuses
         * 
         * 0 : pending
         * 00: purchase_order provided
         * 1 : satisfied
         * 2: rejected
         */

        $capex_eq = $this->Crud->join_equipment_category('capex',5);   
        $all_capex_eq = $this->Crud->join_equipment_category('capex');
        $opex_eq = $this->Crud->join_equipment_category('opex',5);  
        $all_opex_eq = $this->Crud->join_equipment_category('opex');
        $all_eq = $this->Crud->join_equipment_category();

        $pending_store_req = $this->Crud->join_storereq_ep_dept(null,'0',null);
        $store_req = $this->Crud->join_storereq_ep_dept(null,'0',5);

        //$pending_store_requisition = $this->Crud->join_reading_book_account(0);

        $d = [
            'capex_eq' => $capex_eq,
            'all_capex_eq' => $all_capex_eq,
            'opex_eq' => $opex_eq,
            'all_opex_eq' => $all_opex_eq,
            'all_eq' => $all_eq,
            'pending_store_req' => $pending_store_req,
            'store_req' => $store_req
        ];

        $this->load->view('encoder/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //view capex equipment
    public function eq_capex(){

        if(count($_POST) <= 0)
        {
            $eq_capex = $this->Crud->join_equipment_category('capex');
            $category = $this->Crud->get_data('category_equipment');

            $d = [
                'eq_capex' => $eq_capex,
                'category' => $category
            ];

            $this->load->view('encoder/eq_capex',$d);
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{

            $image_uploaded = false;
            
            if($_FILES['image']['name'] != null)
            {
                $image_file_name = str_replace(' ','_',$_FILES['image']['name']);
                $image = 'fichier'.md5(time())."_".$image_file_name;
    
                //upload files
                if(move_uploaded_file($_FILES['image']['tmp_name'], './assets/files/equipments/'.$image))
                {
                    $code = 'eq-'.rand(10,5102);

                    $d = [
                        'designation' => $this->input->post('designation'),
                        'quantity' => $this->input->post('quantity'),
                        'category_id' => $this->input->post('category_id'),
                        'image' => $image,
                        'code' => $code,                        
                    ];
    
                    $this->Crud->add_data('equipment',$d);       
    
                    $image_uploaded = true;
                }
            }
    
            if($image_uploaded)
            {
                $this->session->set_flashdata(['equipment_added'=>true]);                
            }else{
                $this->session->set_flashdata(['equipment_not_added'=>false]);
            }
    
            redirect('encoder/eq_capex');
        }        
    }

    //view opex equipment
    public function eq_opex()
    {
        $eq_opex = $this->Crud->join_equipment_category('opex');
        $category = $this->Crud->get_data('category_equipment');

        $d = [
            'eq_opex' => $eq_opex,
            'category' => $category
        ];

        $this->load->view('encoder/eq_opex',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //view all equipment
    public function all_eq()
    {
        $eq_opex = $this->Crud->join_equipment_category('opex');
        $eq_capex = $this->Crud->join_equipment_category('capex');
        $category = $this->Crud->get_data('category_equipment');

        $d = [
            'eq_opex' => $eq_opex,
            'eq_capex' => $eq_capex,
            'category' => $category
        ];

        $this->load->view('encoder/all_eq',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    //new equipment
    public function new_eq()
    {
        $image_uploaded = false;
            
        if($_FILES['image']['name'] != null)
        {
            $image_file_name = str_replace(' ','_',$_FILES['image']['name']);
            $image = 'fichier'.md5(time())."_".$image_file_name;

            //upload files
            if(move_uploaded_file($_FILES['image']['tmp_name'], './assets/files/equipments/'.$image))
            {
                $code = 'eq-'.rand(10,5102);

                $d = [
                    'designation' => $this->input->post('designation'),
                    'quantity' => $this->input->post('quantity'),
                    'category_id' => $this->input->post('category_id'),
                    'image' => $image,
                    'code' => $code,                        
                ];

                $this->Crud->add_data('equipment',$d);       

                $image_uploaded = true;
            }
        }

        if($image_uploaded)
        {
            $this->session->set_flashdata(['equipment_added'=>true]);                
        }else{
            $this->session->set_flashdata(['equipment_not_added'=>false]);
        }
        $page = $this->input->post('type');

        redirect('encoder/'.$page);
    }
}