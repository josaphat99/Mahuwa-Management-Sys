<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eq_mouvement extends CI_Controller
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
         * TYPES DE MOUVEMENTS
         * entre : approvisionnement
         * sortie: Sortie
         */

        $mouvement_entre = $this->Crud->join_mouvement_equipment(null,'entre');
        $mouvement_sortie = $this->Crud->join_mouvement_equipment(null,'sortie');

        $equipment = $this->Crud->get_data_desc('equipment');

        $d = [
            'mouvement_entre' => $mouvement_entre,
            'mouvement_sortie' => $mouvement_sortie,
            'equipment'=> $equipment
        ];

        $this->load->view('eq_mouvement/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }

    public function new_eq_mouvement()
    {
        $type_operation = $this->input->post('type');
        $equipment_id = $this->input->post('equipment_id');
        $quantity = $this->input->post('quantity');

        $add_mouvement = false;
        $insuffisant_stock = false;
        $beyond_max = false;

        $d = [
            'date' => date("d-m-Y",time()),
            'equipment_id' =>  $equipment_id,
            'type' => $type_operation,
            'quantity' => $quantity,            
        ];

        $eq = $this->Crud->get_data('equipment',['id'=>$equipment_id])[0];

        //Verifier le type de mouvement et gerer les quantites

        if($type_operation == 'sortie')
        {
            $solde = $eq->quantity - $quantity;

            if($solde >= 0)
            {
                $add_mouvement = true;

                $this->Crud->update_data('equipment',['id'=>$equipment_id],['quantity'=>$solde]);
            }else{
                $insuffisant_stock = true;
            }
        }else{

            $new_quantity = $eq->quantity + $quantity;

            if($new_quantity <= $eq->maximum_stock)
            {
                $add_mouvement = true;
                $this->Crud->update_data('equipment',['id'=>$equipment_id],['quantity'=>$new_quantity]);
            }else{
                $beyond_max = true;
            }
        }

        if($add_mouvement)
        {
            $this->Crud->add_data('mouvement_equipment',$d);
            $this->session->set_flashdata(['mouvement_added'=>true]);
        }else{
            if($insuffisant_stock){
                $this->session->set_flashdata(['insuffisant_stock'=>true]);
            }

            if($beyond_max)
            {
                $this->session->set_flashdata(['beyond_max'=>true]);
            }
        }

        if($this->input->post('view_eq_mv') != null)
        {
            redirect('eq_mouvement/view_eq_mouvement?eq_id='.$equipment_id);
        }
        redirect('eq_mouvement/index');
    }

    public function view_eq_mouvement()
    {
        /**
         * TYPES DE MOUVEMENTS
         * entre : approvisionnement
         * sortie: Sortie
        */

        $eq_id = $this->input->get('eq_id');

        $mouvement_entre = $this->Crud->join_mouvement_equipment($eq_id,'entre');
        $mouvement_sortie = $this->Crud->join_mouvement_equipment($eq_id,'sortie');

        $equipment = $this->Crud->get_data('equipment',['id'=>$eq_id])[0];

        $d = [
            'eq_id' => $eq_id,
            'equipment' => $equipment,
            'mouvement_entre' => $mouvement_entre,
            'mouvement_sortie' => $mouvement_sortie,
        ];

        $this->load->view('eq_mouvement/view_eq_mouvement',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}