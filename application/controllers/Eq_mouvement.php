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
        $this->load->view('layout/topbar');
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

        $d = [
            'date' => $this->input->post('date'),
            'equipment_id' =>  $equipment_id,
            'type' => $type_operation,
            'quantity' => $quantity,            
        ];

        $eq = $this->Crud->get_data('equipment',['id'=>$equipment_id])[0];

        
        if($type_operation == 'sortie')
        {
            $solde = $eq->quantity - $quantity;

            if($solde >= 0)
            {
                $add_mouvement = true;

                $this->Crud->update_data('equipment',['id'=>$equipment_id],['quantity'=>$solde]);
            }
        }else{
            $add_mouvement = true;

            $new_quantity = $eq->quantity + $quantity;
            
            $this->Crud->update_data('equipment',['id'=>$equipment_id],['quantity'=>$new_quantity]);
        }

        if($add_mouvement)
        {
            $this->Crud->add_data('mouvement_equipment',$d);
            $this->session->set_flashdata(['mouvement_added'=>true]);
        }else{
            $this->session->set_flashdata(['mouvement_not_added'=>true]);
        }

        redirect('eq_mouvement/index');
    }
}