<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if(!$this->session->connected)
		// {
		// 	redirect('compte');
		// }

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/head');
        // $this->load->view('layout/admin/sidebar');
        // $this->load->view('layout/admin/topbar');
    }

    public function index()
    {
        $this->session->sess_destroy();
        $this->login();
    }

    //login view and process
    public function login()
    {
        if(count($_POST) <= 0)
        {
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{
            $email = $this->input->post('email');
            $pwd = $this->input->post('password');

            $res = $this->Crud->get_data('account',['email'=>$email,'password'=>$pwd]);
            
            $user = $this->Crud->get_data('user',['id'=>$res[0]->user_id])[0];

            if(count($res) > 0)
            {
                $fullname = $user->fullname;
                $email = $res[0]->email;
                $type = $res[0]->type;

                //creation de la session
                $session = [
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "fullname"=>$fullname,
                    "type"=>$type,
                    "email"=>$email,
                    "connected"=>true,                    
                ];
    
                $this->session->set_userdata($session);
    
                //interfaces management
                if(trim($type) == trim("admin"))
                {
                    redirect('admin/index');                    
                }               
                else if(trim($type) == trim("finance"))
                {
                    redirect('finance/index'); 
                }
                else if(trim($type) == trim("encoder"))
                {
                    redirect('encoder/index'); 
                }
                else if(trim($type) == trim("do"))
                {
                    redirect('department/index'); 
                }
                else if(trim($type) == trim("dg"))
                {
                    redirect('pch_order/index'); 
                }
                else if(trim($type) == trim("hr"))
                {
                    redirect('hr/index'); 
                }
                else{				
                    $login_error = array("error_login" => "L'adresse email le ou mot de passe est incorrecte!!");
                    $this->session->set_flashdata($login_error);
                    redirect('auth/login'); 
                }
            }else{
                $login_error = array("error_login" => "L'adresse email le ou mot de passe est incorrecte!!");
                $this->session->set_flashdata($login_error);
                redirect('auth/login');
            }
        }
    }

    //signup view and process
    public function signup()
    {
        if(count($_POST) <= 0)
        {
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar');
            $this->load->view('auth/signup');
            $this->load->view('layout/footer');
            $this->load->view('layout/js');
        }else{
            
            echo 'process';die();
        }
    }

    //logout
    public function logout()
    {
        $this->session->sess_destroy();

        redirect('auth');
    }
}
