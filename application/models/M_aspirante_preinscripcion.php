<?php
class M_aspirante_preinscripcion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   //generacion de matricula

public function asignar_numero_consecutivo(){
    /*SELECT  max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero FROM control_escolar.aspirante a where no_control like 'CSEIIO20%';*/
   $this->db->select('max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero');
   $this->db->from('Aspirante a');
   $this->db->like('a.no_control','CSEIIO'.date("y"),'after');
 
   $consulta = $this->db->get();
   $resultado=$consulta->row()->numero;
 
   return $resultado;
    
 }
 
 //fin generacion de matricula

 public function insertar_estudiante_nuevo_ingreso(
    $datos_estudiante,
    $datos_estudiante_tutor,
    $parentesco_estudiante_tutor,
    $datos_estudiante_lengua_materna,
    $datos_estudiante_documentos,
    $datos_estudiante_medicos,
    $datos_escuela_procedencia){
      $resultado["respuesta"]=array("tipo" =>"error","descripcion" =>"Ha ocurrido un error, Consulte con el administrador del sistema.");
 
       
 
             $this->db->trans_start();



             $resultado_estudiante=$this->db->query("select * from Estudiante where curp='".$datos_estudiante['curp']."'")->result();

             $resultado_aspirante=$this->db->query("select * from Aspirante where curp='".$datos_estudiante['curp']."'")->result();


            if(count($resultado_estudiante)<1 && count($resultado_aspirante)<1){
                     $this->db->insert('Aspirante',$datos_estudiante);
      
                  
                  $this->db->insert('Tutor_aspirante',$datos_estudiante_tutor);
                  $id_tutor = $this->db->insert_id();
                  
                  $this->db->insert('Detalle_aspirante_tutor',array(
                     'Aspirante_no_control' => $datos_estudiante['no_control'],
                     'Tutor_id_tutor' => $id_tutor,
                     'parentesco' => $parentesco_estudiante_tutor
                  ));
                  
                  
                  
                  foreach($datos_estudiante_lengua_materna as $dato_lengua){
                     $this->db->insert('Datos_lengua_materna_aspirante',$dato_lengua);
                  }
      
                  
      
                  
                  
                  foreach($datos_estudiante_medicos as $dato_medico){
                     $this->db->insert('Expediente_medico_aspirante',$dato_medico);
                  }
                  
                  
                  foreach($datos_estudiante_documentos as $documento){
      
                     $this->db->insert('Documentacion_aspirante',$documento);
                     }
      
      
               foreach($datos_escuela_procedencia as $escuela){
                  if($escuela['Escuela_procedencia_cct_escuela_procedencia']!=""){
                     $this->db->insert('Aspirante_escuela_procedencia',$escuela);
                  }
                     
               }
               
               
               
      
               
                  
                  $this->db->trans_complete();
      
                  if ($this->db->trans_status() === FALSE)
                  {
                     //print_r($this->db->error());
                     $resultado["respuesta"]=array("tipo" =>"error","descripcion" =>"Ha ocurrido un error, verifique los datos ingresados al formulario.");
                     
                  }
                     
                  else{
                     $resultado["respuesta"]=array("tipo" =>"exito","descripcion" =>"Los datos han sido ingresados correctamente.","id" =>$datos_estudiante['no_control']);
                     
                  }


            }
            else{
               $resultado["respuesta"]=array("tipo" =>"error","descripcion" =>"Los datos de aspirante ya se encuentran registrados en la base de datos.");
            }
 
             
            return $resultado;
    
 }



 public function update_estudiante_nuevo_ingreso(
   $datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_documentos,
   $datos_estudiante_medicos,
   $datos_escuela_procedencia){
     $resultado["respuesta"]=array("tipo" =>"error","descripcion" =>"Ha ocurrido un error, Consulte con el administrador del sistema.");

      

            $this->db->trans_start();

                    $this->db->where('no_control', $datos_estudiante['no_control']);
                    $this->db->update('Aspirante',$datos_estudiante);
                    
     
               $this->db->where('id_tutor', $datos_estudiante_tutor['id_tutor']);
                 $this->db->update('Tutor_aspirante',$datos_estudiante_tutor);

                  $this->db->where('Aspirante_no_control', $datos_estudiante['no_control']);
                  $this->db->where('Tutor_id_tutor', $datos_estudiante_tutor['id_tutor']);
                 $this->db->update('Detalle_aspirante_tutor',array(
                    'parentesco' => $parentesco_estudiante_tutor
                 ));
                 
                
                 
                 foreach($datos_estudiante_lengua_materna as $dato_lengua){
                  $this->db->where('Aspirante_no_control',$datos_estudiante['no_control']);
                  $this->db->where('descripcion',$dato_lengua['descripcion']);
                    $this->db->update('Datos_lengua_materna_aspirante',$dato_lengua);
                 }
     
                 
     
                 
                 
                 foreach($datos_estudiante_medicos as $dato_medico){
                  $this->db->where('Aspirante_no_control',$datos_estudiante['no_control']);
                  $this->db->where('descripcion',$dato_medico['descripcion']);
                    $this->db->update('Expediente_medico_aspirante',$dato_medico);
                 }
                 
                 
                 foreach($datos_estudiante_documentos as $documento){
                  $this->db->where('id_documento',$documento['id_documento']);
                  $this->db->where('Aspirante_no_control',$datos_estudiante['no_control']);
                    $this->db->update('Documentacion_aspirante',$documento);
                    }
     
     
              foreach($datos_escuela_procedencia as $escuela){
                 if($escuela['Escuela_procedencia_cct_escuela_procedencia']!=""){
                  $this->db->where('Aspirante_no_control',$datos_estudiante['no_control']);
                    $this->db->update('Aspirante_escuela_procedencia',$escuela);
                 }
                    
              }
              
              
              
     
              
                 
                 $this->db->trans_complete();
     
                 if ($this->db->trans_status() === FALSE)
                 {
                    //print_r($this->db->error());
                    $resultado["respuesta"]=array("tipo" =>"error","descripcion" =>"Ha ocurrido un error, verifique los datos ingresados al formulario.");
                    
                 }
                    
                 else{
                    $resultado["respuesta"]=array("tipo" =>"exito","descripcion" =>"Los datos han sido ingresados correctamente.","id" =>$datos_estudiante['no_control']);
                    
                 }

            
           return $resultado;
   
}

   public function get_escuela($cct){
    return $this->db->get_where('Escuela_procedencia_aspirante',array('cct_escuela_procedencia'=>$cct))->result();
    }

    public function insert_escuela($datos){
        return $this->db->insert('Escuela_procedencia_aspirante',$datos);
    }

    


    public function estado_curp_nacimiento($id){
       $id=substr($id,11, 2);
       $resultado=0;
         switch ($id) {
            case 'AS'://Aguascalientes
               $resultado=1;
               break;
            case 'BC'://Baja California
               $resultado=2;
               break;
            case 'BS'://Baja California SUR
               $resultado=3;
               break;
            case 'CC'://cAMPECHE
               $resultado=4;
               break;
            case 'CL'://cOAHUILA
               $resultado=5;
               break;
            case 'CM'://COLIMA
               $resultado=6;
               break;
            case 'CS'://CHIAPAS
               $resultado=7;
               break;
            case 'CH'://CHIHUAHUA
               $resultado=8;
               break;
            case 'DF'://DF
               $resultado=9;
               break;
            case 'DG'://DURANGO
               $resultado=10;
               break;
            case 'GT'://GUANAJUATO
               $resultado=11;
               break;
            case 'GR'://GUERRERO
               $resultado=12;
               break;
            case 'HG'://HIDALGO
               $resultado=13;
               break;
            case 'JC'://JALISCO
               $resultado=14;
               break;
            case 'MC'://MÉXICO
               $resultado=15;
               break;
            case 'MN'://MICHOACÁN
               $resultado=16;
               break;
            case 'MS'://MORELOS
               $resultado=17;
               break;
            case 'NT'://NAYARIT
               $resultado=18;
               break;
            case 'NL'://NUEVO LEÓN
               $resultado=19;
               break;
            case 'OC'://OAXACA
               $resultado=20;
               break;
            case 'PL'://PUEBLA
               $resultado=21;
               break;
            case 'QT'://QUERÉTARO
               $resultado=22;
               break;
            case 'QR'://QUINTANA ROO
               $resultado=23;
               break;
            case 'SP'://SAN LUIS POTOSÍ
               $resultado=24;
               break;
            case 'SL'://SINALOA
               $resultado=25;
               break;
            case 'SR'://SONORA
               $resultado=26;
               break;
            case 'TC'://TABASCO
               $resultado=27;
               break;
            case 'TS'://TAMAULIPAS
               $resultado=28;
               break;
            case 'TL'://TLAXCALA
               $resultado=29;
               break;
            case 'VZ'://VERACRUZ
               $resultado=30;
               break;
            case 'YN'://YUCATÁN
               $resultado=31;
               break;
            case 'ZS'://ZACATECAS
               $resultado=31;
               break;
            case 'NE'://EXTRANJERO
               $resultado='otro';
               break;
            
         }
         return $resultado; 
   }


   public function localidad_origen($dato,$id_localidad){
      
      $pivote=strrpos($dato,"-");
      $nombre_municipio=substr($dato,$pivote+1);
      $nombre_localidad=substr($dato,0,-(strlen($nombre_municipio)+1));
      $resultado["procedencia"]=array();
      $procedencia=$this->db->query("select * from Municipio m inner join Localidad l on m.id_municipio=l.Municipio_id_municipio where m.nombre_municipio='".$nombre_municipio."' and l.nombre_localidad='".$nombre_localidad."';")->result();
      if(count($procedencia)>0){
         if($id_localidad==$procedencia[0]->id_localidad){
            $resultado["procedencia"]=array("tipo" =>"igual");
         }
         else{
            $resultado["procedencia"]=array("tipo" =>"diferente","id_localidad" =>$procedencia[0]->id_localidad,"id_municipio" =>$procedencia[0]->id_municipio,"id_estado" =>$procedencia[0]->Estado_id_estado);
         }
         
      }
      else{
         $resultado["procedencia"]=array("tipo" =>"extranjero","localidad"=>$dato);

      }
       
      return $resultado;
    }

    public function get_estudiante($no_control){
      $datos['estudiante'] = $this->db->get_where('Aspirante',array(
         'no_control' => $no_control
      ))->result();


      array_push($datos['estudiante'],["id_estado_nacimiento"=>$this->estado_curp_nacimiento($datos['estudiante'][0]->curp)]);

      array_push($datos['estudiante'],$this->localidad_origen($datos['estudiante'][0]->localidad_origen,$datos['estudiante'][0]->id_localidad));
      
      
      $datos['escuela_procedencia'] = $this->db->query("select * from Aspirante_Escuela_procedencia as ee inner join Escuela_procedencia_aspirante as ep on ee.Escuela_procedencia_cct_escuela_procedencia=ep.cct_escuela_procedencia where Aspirante_no_control='".$no_control."' order by tipo_escuela_procedencia desc")->result();
   
      $datos['tutor'] =$this->db->query("SELECT * from Detalle_aspirante_Tutor as et inner join Tutor_aspirante as t on et.Tutor_id_tutor=t.id_tutor  where Aspirante_no_control='".$no_control."'")->result();
   
      $datos['expediente_medico'] = $this->db->query("SELECT * from Expediente_medico_aspirante where Aspirante_no_control='".$no_control."'")->result();
      $datos['lengua_materna'] = $this->db->query("SELECT * from Datos_lengua_materna_aspirante where Aspirante_no_control='".$no_control."'")->result();

       $datos['documentacion']=$this->get_documentacion_xnombrede_aspirante($no_control);

      return $datos;
   }

   function get_documentacion_xnombrede_aspirante($no_control){
      $this->db->select('*');
      $this->db->from('Documentacion_aspirante');
      $this->db->join('Documento', 'Documentacion_aspirante.id_documento = Documento.id_documento');
      $this->db->join('Plantel', 'Documentacion_aspirante.id_plantel=Plantel.cct_plantel', 'left');
      $this->db->where('Documentacion_aspirante.Aspirante_no_control',$no_control);
       $resultado = $this->db->get();
       return $resultado->result();
 
    }

    public function get_aspirantes_curp_plantel($curp,$cct_plantel){
      return $this->db->query("SELECT * FROM Aspirante WHERE curp LIKE '".$curp."%' and Plantel_cct_plantel LIKE '".$cct_plantel."%'")->result();
   }


   function get_nombre_archivo_documentacion($iddocumento){

      $this->db->select('*');
      $this->db->from('Documentacion_aspirante');
      $this->db->where('id_documentacion',$iddocumento);
     // $this->db->where('id_plantel',$plantel);
      //$this->db->where('Estudiante_no_control',$no_control);
      $resultado = $this->db->get()->row();
      return $resultado->ruta;
   
     }

     public function eliminar_bd($datos){
      $this->db->trans_start();
      
      $resultado_tutor=$this->db->query("select * from Detalle_aspirante_Tutor where aspirante_no_control='".$datos->no_control."'")->result();
      $this->db->query("delete from Datos_lengua_materna_aspirante where Aspirante_no_control='".$datos->no_control."';");
      $this->db->query("delete from Documentacion_aspirante where Aspirante_no_control='".$datos->no_control."';");
      $this->db->query("delete from Aspirante_Escuela_procedencia where Aspirante_no_control='".$datos->no_control."';");
      $this->db->query("delete from Detalle_aspirante_Tutor where Aspirante_no_control='".$datos->no_control."';");
      $this->db->query("delete from Expediente_medico_aspirante where Aspirante_no_control='".$datos->no_control."';");
      $this->db->query("delete from Aspirante where no_control='".$datos->no_control."'");
      if(count($resultado_tutor>0)){
         $this->db->query("delete from Tutor_aspirante where id_tutor='".$resultado_tutor[0]->Tutor_id_tutor."'");
      }
      
      $this->db->trans_complete();
   
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
                }
                  
               else{
                  return "si";
                 
               }
   }




   public function exportar_id($datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_documentos,
   $datos_estudiante_medicos,
   $datos_escuela_procedencia,
   $datos_escuela,
   $aspirante_no_control){
   $this->db->trans_start();

   $this->db->insert('Estudiante',$datos_estudiante);
      $this->db->insert('Tutor',$datos_estudiante_tutor);
      $id_tutor = $this->db->insert_id();

       $this->db->insert('Estudiante_Tutor',array(
         'Estudiante_no_control' => $datos_estudiante['no_control'],
         'Tutor_id_tutor' => $id_tutor,
         'parentesco' => $parentesco_estudiante_tutor
      ));

      foreach($datos_estudiante_lengua_materna as $dato_lengua){
         
         $this->db->insert('Datos_lengua_materna',$dato_lengua);
      }

     foreach($datos_estudiante_medicos as $dato_medico){
         $this->db->insert('Expediente_medico',$dato_medico);
      }

      foreach($datos_estudiante_documentos as $documento){
         $this->db->insert('Documentacion',$documento);
      }

      foreach($datos_escuela as $e){
         if($e['cct_escuela_procedencia']!=""){
            $this->db->insert('Escuela_procedencia',$e);
         }
            
      }

      foreach($datos_escuela_procedencia as $escuela){
         if($escuela['Escuela_procedencia_cct_escuela_procedencia']!=""){
            $this->db->insert('Estudiante_Escuela_procedencia',$escuela);
         }
            
      }

      
      $this->db->trans_complete();
   
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
                }
                  
               else{
                  $this->eliminar_bd($aspirante_no_control);
                  return "si";
                 
               }
   }

}