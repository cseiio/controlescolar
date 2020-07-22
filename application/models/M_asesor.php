<?php
class M_asesor extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_asesores_plantel($id_plantel){
       //$asesores = $this->db->query("select * from Asesor where Plantel_cct_plantel='".$id_plantel."' and  puesto NOT LIKE  'INTENDENTE DE PLANTEL%' and puesto NOT LIKE 'SECRETARIA(O) DE PLANTEL%'")->result();
       $asesores = $this->db->query("select * from Asesor a inner join Categoria c on a.id_categoria=c.id_categoria inner join Puesto p on p.id_puesto=c.id_puesto where Plantel_cct_plantel='".$id_plantel."' and clave IN ('ASESOR','DIR') ORDER BY nombre,primer_apellido,segundo_apellido")->result();
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
      return $this->db->query("select * from Puesto order by nombre_puesto;")->result();
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

     public function buscar_asesores_activos_plantel($curp,$plantel,$num_empleado){
        
        $num_empleado=intval($num_empleado);
        if($num_empleado==0){
           $num_empleado="";
        }
      return $this->db->query("select * from Asesor a inner join Categoria c on c.id_categoria=a.id_categoria inner join Puesto p on c.id_puesto=p.id_puesto where a.curp like '%".$curp."%' and a.Plantel_cct_plantel like '%".$plantel."%' and a.estatus=1 and if(a.num_empleado is NULL,'',a.num_empleado) like '%".$num_empleado."%'")->result();
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

     public function buscar_asesor_baja_x_curp($curp,$num_empleado){
        if($num_empleado==""){
         $num_empleado=-1;

        }
      return $this->db->query("select * from Asesor a inner join Categoria c on c.id_categoria=a.id_categoria inner join Puesto p on c.id_puesto=p.id_puesto where a.curp='".$curp."' or num_empleado=".$num_empleado." and estatus=0")->result();
      
   }

   public function existe_asesor_x_curp($curp,$num_empleado){
      $jsondata = array();
      $consulta_asesor= $this->db->query("select * from Asesor where curp='".$curp."'")->result();
      $plantel_cct="";

      if($num_empleado==""){
          $num_empleado=-1;
      }

      $consulta_asesor2= $this->db->query("select * from Asesor where num_empleado=".$num_empleado)->result();

      

      $resultado=3;

     // echo "c: ".count($consulta_asesor).", c2: ".count($consulta_asesor2);

      if(count($consulta_asesor)>0 && count($consulta_asesor2)>0){
         if($consulta_asesor[0]->curp==$consulta_asesor2[0]->curp){
            if($consulta_asesor[0]->estatus==1){
               $resultado=1;
               $plantel_cct=$consulta_asesor[0]->Plantel_cct_plantel;
            }
            else{
               $resultado=2;
            }
         }
         else{
            $resultado=3;
         }
         
      }
      else{
         if(count($consulta_asesor)==0 && count($consulta_asesor2)==0){
            if($curp=="" && $num_empleado==-1){
               $resultado=4;
            }
            else{
               $resultado=5;
            }
         }

         else{
                  if(count($consulta_asesor)>0 && $num_empleado==-1){
                     if($consulta_asesor[0]->estatus==1){
                        $plantel_cct=$consulta_asesor[0]->Plantel_cct_plantel;
                        $resultado=1;
                     }
                     else{
                        $resultado=2;
                     }
                     
               }
               
               
               if(count($consulta_asesor2)>0 && $curp==""){
                     if($consulta_asesor2[0]->estatus==1){
                        $plantel_cct=$consulta_asesor2[0]->Plantel_cct_plantel;
                        $resultado=1;
                     }
                     else{
                        $resultado=2;
                     }
               }

         }

      }

      
      switch ($resultado) {
         case 1:
            $plantel= $this->db->query("select * from Plantel where cct_plantel='".$plantel_cct."'")->row();
             return $jsondata['resultado'] = ["tipo"=>"alta","respuesta"=>"Los datos de Asesor se encuentran dados de alta en <span style='font-weight:bold'>".$plantel->nombre_corto." DE ".$plantel->nombre_plantel."</span>, solicite su baja para incorporarlo."];
             break;
         case 2:
            return $jsondata['resultado'] = ["tipo"=>"baja","respuesta"=>"Asesor para importar"];
             break;
         case 3:
            return $jsondata['resultado'] = ["tipo"=>"alta","respuesta"=>"Los datos ingresados de Asesor son incorrectos, verifique."];
             break;

             case 4:
               return $jsondata['resultado'] = ["tipo"=>"datos_vacios","respuesta"=>"Ingrese datos para realizar la busqueda"];
                break;


         case 5:
            return $jsondata['resultado'] = ["tipo"=>"no_existe","respuesta"=>"No existen datos"];
         break;
     }
      
      
      
   }

   public function importar($datos,$id){
      $this->db->trans_start();
      
      $this->db->where('id_asesor',$id);
        $this->db->update('Asesor',$datos);
             $this->db->trans_complete();
    
             if ($this->db->trans_status() === FALSE)
             {
                return "no";
             }
    
             else{
                return "si";
             }
      
   }

   public function get_asesor($id){
      return $this->db->query("select * from Asesor a inner join Categoria c on c.id_categoria=a.id_categoria inner join Puesto p on c.id_puesto=p.id_puesto where id_asesor=".$id)->row();
   }

   public function modificar($datos,$id){
      $this->db->trans_start();
      
      $this->db->where('id_asesor',$id);
        $this->db->update('Asesor',$datos);
             $this->db->trans_complete();
    
             if ($this->db->trans_status() === FALSE)
             {
                return "no";
             }
    
             else{
                return "si";
             }
      
   }


}