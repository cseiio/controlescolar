<?php
class M_asesor extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_asesores_plantel($id_plantel){
       $asesores = $this->db->query("select * from Asesor where Plantel_cct_plantel='".$id_plantel."' and  puesto NOT LIKE  'INTENDENTE DE PLANTEL%' and puesto NOT LIKE 'SECRETARIA(O) DE PLANTEL%'")->result();
        $respuesta = '<option value="">SIN PROFESOR ASIGNADO</option>';
       foreach($asesores as $asesor){
        $respuesta.='<option value="'.$asesor->id_asesor.'">'.$asesor->nombre.' '.$asesor->primer_apellido.' '.$asesor->segundo_apellido.'</option>';
       }


       return $respuesta;
   }


   public function asesor_materia_grupo($grupo,$materia){
      return $this->db->query("select nombre,primer_apellido,segundo_apellido from Grupo_Estudiante as ge inner join Asesor as a on ge.id_asesor=a.id_asesor where Grupo_id_grupo='".$grupo."' and id_materia='".$materia."' limit 1")->result();
   }

   public function buscar_asesores_plantel($curp,$plantel){
      return $this->db->query("select * from Asesor where curp like '%".$curp."%' and Plantel_cct_plantel like '%".$plantel."%' ")->result();
   }

   public function get_puestos(){
      return $this->db->query("select * from Puesto;")->result();
   }

   public function get_categoria_x_puesto($id_puesto){
      return $this->db->query("select * from Categoria where id_puesto=".$id_puesto.";")->result();
   }

   public function alta($datos){
      $this->db->trans_start();
      $existe_curp=$this->db->query("select * from Asesor where curp='".$datos['curp']."'")->result();

      if(count($existe_curp)==0){
               $this->db->insert('Asesor', $datos);
               $this->db->trans_complete();
      
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
               }
      
               else{
                  return "si";
               }

      }
      else{
         return "existe_curp";

      }

          
     }

     public function buscar_asesores_activos_plantel($curp,$plantel){
      return $this->db->query("select * from Asesor where curp like '%".$curp."%' and Plantel_cct_plantel like '%".$plantel."%' and estatus=1")->result();
   }

     public function eliminar($datos){
        $this->db->trans_start();
        $this->db->query("update Asesor set estatus=0 where id_asesor=".$datos[0]->idasesor);
               $this->db->trans_complete();
      
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
               }
      
               else{
                  return "si";
               }
     }

     public function buscar_asesor_baja_x_curp($curp){
      return $this->db->query("select * from Asesor where curp='".$curp."'")->result();
      
   }

   public function existe_asesor_x_curp($curp){
      $resultado_asesor= $this->db->query("select * from Asesor where curp='".$curp."'")->row();
            if(count($resultado_asesor)>0){
               if($resultado_asesor->estatus==1){
                  return "alta";

               }
               else{
                  return "baja";

               }
         }
         else{
               return "no_existe";
         }
      
      
   }
}