<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
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

        // $d['store_req_attente'] = $this->Crud->join_storereq_ep_dept($department_id,'0',null);
        // $d['pending_pch_order'] = $this->Crud->join_pch_st_eq(null,null,null,'0');

        $this->load->view('layout/topbar');
    }


    //dashboard
    public function index()
    {
        redirect('encoder/index');
    }

    //users
    public function view_users()
    {
        $user = $this->Crud->get_data('user',['matricule !='=>'23CK01']); 
        
        foreach($user as $u)
        {
            $account = $this->Crud->get_data('account',['user_id'=>$u->id])[0];
            $u->email = $account->email;
            $u->department = $this->Crud->get_data('department',['id'=>$u->department_id])[0]->name;

            if($account->type == 'encoder')
            {
                $u->role = "Encodage des données";
            }else if($account->type == 'dg')
            {
                $u->role = "DG";
            }else if($account->type == 'finance')
            {
                $u->role = "Finance";
            }else if($account->type == 'do')
            {
                $u->role = "Responsable de departement";
            }
        }

        $d['user'] = $user;

        $this->load->view('admin/index',$d);
        $this->load->view('layout/footer');
        $this->load->view('layout/js');
    }
}
