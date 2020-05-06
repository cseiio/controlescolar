<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_asesor extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_asesor");
        
    }


    public function get_asesores_plantel(){
        $id_plantel = $this->input->get("plantel");
        echo $this->M_asesor->get_asesores_plantel($id_plantel);
    }

    public function buscar_asesores_plantel(){
        $plantel = $this->input->get("cct_plantel");
        $curp = $this->input->get("curp");
        echo json_encode($this->M_asesor->buscar_asesores_plantel($curp,$plantel));
    }

    public function get_categoria_x_puesto(){
        $id_puesto = $this->input->get("id_puesto");
        echo json_encode($this->M_asesor->get_categoria_x_puesto($id_puesto));
    }

    public function alta(){
        $nombre = $this->input->post("asesor_nombre");
        $apellido_paterno = $this->input->post("asesor_apellido_paterno");
        $apellido_materno = $this->input->post("asesor_apellido_materno");
        $curp = $this->input->post("asesor_curp");
        $rfc = $this->input->post("asesor_rfc");
        $nss = $this->input->post("asesor_nss");
        $puesto = $this->input->post("asesor_puesto");
        $categoria = $this->input->post("asesor_categoria");
        $modalidad = $this->input->post("asesor_modalidad");
        $plantel = $this->input->post("asesor_plantel");
        $fecha_ingreso = $this->input->post("asesor_fecha_ingreso");

        $datos = array(
            'nombre' => strtoupper($nombre),
            'primer_apellido' => strtoupper($apellido_paterno),
            'segundo_apellido' => strtoupper($apellido_materno),
            'puesto' => strtoupper($puesto),
            'categoria' => strtoupper($categoria),
            'curp' => strtoupper($curp),
            'rfc' => strtoupper($rfc),
            'nss' => strtoupper($nss),
            'fecha_ingreso' => strtoupper($fecha_ingreso),
            'modalidad' => strtoupper($modalidad),
            'Plantel_cct_plantel' => strtoupper($plantel)

        );

        echo $this->M_asesor->alta($datos);
    }

    public function eliminar(){
        $datos = json_decode($this->input->raw_input_stream);
        echo $this->M_asesor->eliminar($datos);
    }

    public function buscar_asesores_activos_plantel(){
        $plantel = $this->input->get("cct_plantel");
        $curp = $this->input->get("curp");
        echo json_encode($this->M_asesor->buscar_asesores_activos_plantel($curp,$plantel));
    }

    public function buscar_asesor_baja_x_curp(){
        
        $curp = $this->input->get("curp");
        echo json_encode($this->M_asesor->buscar_asesor_baja_x_curp($curp));
    }

    public function existe_asesor_x_curp(){
        
        $curp = $this->input->get("curp");
        echo $this->M_asesor->existe_asesor_x_curp($curp);
    }


}