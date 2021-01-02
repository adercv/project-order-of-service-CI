<?php

defined('BASEPATH') or exit('Ação não permitida');

/**
 * Esta classe é a responsável por salvar e recuperar informações dos usuários.
 * @author Aderbal Cavalcante de Oliveira Neto <aderc19@gmail.com>
 * @version 1.0
 * @copyright Copyright © 2021, AD DEVELOPMENT.
 * @access public
 * @package model 
 */

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Definir se há sessão
    }

    public function index() {
        $data = array(
            'titulo' => 'Usuários cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'usuarios' => $this->ion_auth->users()->result(), //get all users
        );

        //debug
        //echo '<pre>';
        //print_r($data['usuarios']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function edit($usuario_id = NULL) {

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {

            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');
        } else {

//            [first_name] => Admin
//            [last_name] => istrator
//            [email] => admin@admin.com
//            [username] => administrator
//            [active] => 1
//            [perfil_usuario] => 1
//            [password] =>
//            [confirm_password] =>
//            [usuario_id] => 1
//            echo '<pre>';
//            print_r($this->input->post());
//            exit();

            $this->form_validation->set_rules('first_name', '', 'trim|required');
            $this->form_validation->set_rules('last_name', '', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirme', 'matches[password]');

            if ($this->form_validation->run()) {
                exit('Validado');
            } else {

                $data = array(
                    'titulo' => 'Editar Usuário',
                    'usuario' => $this->ion_auth->user($usuario_id)->row(),
                    'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                );


                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    //função que faz a checkagem do email no bd, verificando se já existe.
    public function email_check($email) {

        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('email' => $email, 'id != ' => $usuario_id))) {

            $this->form_validation->set_message('email_check', 'Esse e-mail já existe!');

            return FALSE;
        } else {

            return TRUE;
        }
    }

//função que faz a checkagem do usuário no bd, verificando se já existe.
    public function username_check($username) {

        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', array('username' => $username, 'id != ' => $usuario_id))) {

            $this->form_validation->set_message('username_check', 'Esse usuário já existe!');

            return FALSE;
        } else {

            return TRUE;
        }
    }

}
