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
        $plantel = $this->input->post("asesor_plantel");
        $fecha_ingreso = $this->input->post("asesor_fecha_ingreso");
        $id_categoria = $this->input->post("asesor_categoria");
        $sexo = $this->input->post("asesor_sexo");
        $num_empleado_asesor = $this->input->post("num_empleado_asesor");

        $datos = array(
            'nombre' => strtoupper($nombre),
            'primer_apellido' => strtoupper($apellido_paterno),
            'segundo_apellido' => strtoupper($apellido_materno),
            'curp' => strtoupper($curp),
            'rfc' => strtoupper($rfc),
            'nss' => strtoupper($nss),
            'fecha_ingreso' => strtoupper($fecha_ingreso),
            'Plantel_cct_plantel' => strtoupper($plantel),
            'estatus' =>1,
            'id_categoria' =>$id_categoria,
            'sexo' =>$sexo,
            'num_empleado' =>$num_empleado_asesor


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
        $num_empleado = $this->input->get("num");
        echo json_encode($this->M_asesor->buscar_asesores_activos_plantel($curp,$plantel,$num_empleado));
    }

    public function buscar_asesor_baja_x_curp(){
        
        $curp = $this->input->get("curp");
        $num_empleado = $this->input->get("num");
        echo json_encode($this->M_asesor->buscar_asesor_baja_x_curp($curp,$num_empleado));
    }

    public function existe_asesor_x_curp(){
        
        $curp = $this->input->get("curp");
        $num_empleado = $this->input->get("num");
        echo json_encode($this->M_asesor->existe_asesor_x_curp($curp,$num_empleado));
    }

    public function importar(){
        
        $id_asesor = $this->input->post("import_id_asesor");
        $nombre = $this->input->post("import_asesor_nombre");
        $apellido_paterno = $this->input->post("import_asesor_apellido_paterno");
        $apellido_materno = $this->input->post("import_asesor_apellido_materno");
        $curp = $this->input->post("import_asesor_curp");
        $rfc = $this->input->post("import_asesor_rfc");
        $nss = $this->input->post("import_asesor_nss");
        $id_categoria = $this->input->post("import_asesor_categoria");
        $id_plantel = $this->input->post("import_asesor_plantel");
        $fecha_ingreso = $this->input->post("import_asesor_fecha_ingreso");
        $num_empleado = $this->input->post("import_num_empleado_asesor");
        $sexo = $this->input->post("import_asesor_sexo");

        $datos = array(
            'nombre' => strtoupper($nombre),
            'primer_apellido' => strtoupper($apellido_paterno),
            'segundo_apellido' => strtoupper($apellido_materno),
            'curp' => strtoupper($curp),
            'rfc' => strtoupper($rfc),
            'nss' => strtoupper($nss),
            'fecha_ingreso' => $fecha_ingreso,
            'Plantel_cct_plantel' => strtoupper($id_plantel),
            'id_categoria' =>$id_categoria,
            'estatus' =>1,
            'sexo' =>$sexo,
            'num_empleado' =>$num_empleado
            

        );
        

        echo $this->M_asesor->importar($datos,$id_asesor);
    }

    public function get_asesor(){
        $id = $this->input->get("id");
        echo json_encode($this->M_asesor->get_asesor($id));
    }

    public function modificar(){
        $id_asesor = $this->input->post("modificar_asesor_id");
        $nombre = $this->input->post("modificar_asesor_nombre");
        $apellido_paterno = $this->input->post("modificar_asesor_apellido_paterno");
        $apellido_materno = $this->input->post("modificar_asesor_apellido_materno");
        $curp = $this->input->post("modificar_asesor_curp");
        $rfc = $this->input->post("modificar_asesor_rfc");
        $nss = $this->input->post("modificar_asesor_nss");
        $id_categoria = $this->input->post("modificar_asesor_categoria");
        $id_plantel = $this->input->post("modificar_asesor_plantel");
        $fecha_ingreso = $this->input->post("modificar_asesor_fecha_ingreso");
        $num_empleado = $this->input->post("modificar_num_empleado_asesor");
        $sexo = $this->input->post("modificar_asesor_sexo");
        

        $datos = array(
            'nombre' => strtoupper($nombre),
            'primer_apellido' => strtoupper($apellido_paterno),
            'segundo_apellido' => strtoupper($apellido_materno),
            'curp' => strtoupper($curp),
            'rfc' => strtoupper($rfc),
            'nss' => strtoupper($nss),
            'fecha_ingreso' => $fecha_ingreso,
            'Plantel_cct_plantel' => strtoupper($id_plantel),
            'num_empleado' =>$num_empleado,
            'sexo' =>$sexo,
            'id_categoria' => $id_categoria

        );

        echo $this->M_asesor->modificar($datos,$id_asesor);
    }


}