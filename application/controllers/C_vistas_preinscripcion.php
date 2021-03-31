<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_vistas_preinscripcion extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_estado');
        $this->load->model('M_lengua');
        $this->load->model('M_plantel');
        $this->load->model('M_escuela_procedencia');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_componente');
        $this->load->model('M_usuario');
        $this->load->model('M_asesor');
    }

    public function nuevo(){
        $this->load->library('user_agent');
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['escuela_procedencia'] = $this->M_escuela_procedencia->get_secundarias();

            $data= array('title'=>'Nueva Preinscripción');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecerapreinscripcion", $data);
            $this->load->view("headers/menuarribapreinscripcion");
            $this->load->view("headers/menuizquierdapreinscripcion");
            $this->load->view("preinscripcion/nuevapreinscripcion",$datos);
            $this->load->view("footers/footerpreinscripcion");
        

        
    }

    public function lista_aspirantes(){
        $this->load->library('user_agent');
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['escuela_procedencia'] = $this->M_escuela_procedencia->get_secundarias();

            $data= array('title'=>'Nueva Preinscripción');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecerapreinscripcion", $data);
            $this->load->view("headers/menuarribapreinscripcion");
            $this->load->view("headers/menuizquierdapreinscripcion");
            $this->load->view("preinscripcion/nuevapreinscripcion",$datos);
            $this->load->view("footers/footerpreinscripcion");
        

        
    }


    //control alumnos ------------------------------------------------
    
    public function control_aspirantes(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Aspirantes inscritos en línea');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/aspirantes",$datos);
            $this->load->view("footers/footerpreinscripcion");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Aspirantes inscritos en línea');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/aspirantes",$datos);
            $this->load->view("footers/footerpreinscripcion");
        }
        
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    //fin control alumnos ---------------------------------------------------
}
?>