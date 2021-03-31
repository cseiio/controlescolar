<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_aspirante_preinscripcion extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('M_aspirante_preinscripcion');
        $this->load->model('M_estudiante');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_localidad');
        $this->load->model('M_lengua');
        $this->load->model('M_plantel');
        $this->load->model('M_escuela_procedencia');
        
        $this->folder = './ims/';
        $this->load->helper('download');

    }


    public function subir_doc(){ 
        $config = [
          "upload_path" => "./ims",
          'allowed_types' => "gif|jpg|jpeg|png|pdf",
          'max_size'=>2048
        ];
        
        $this->load->library("upload",$config);
        $iddocumento=$this->input->post('iddocumento');
        $cct_plantel=$this->input->post('cct_plantel');
        if($cct_plantel==''){
          $cct_plantel=NULL;
        }
        


                if ($this->upload->do_upload('file1')) {
                $data = array("upload_data" => $this->upload->data());
                $nombrearchivo=$data['upload_data']['file_name'];
                  
                       /* $actualizo=$this->M_documentacion->update_aspirante_doc($iddocumento,$nombrearchivo,$no_control);
                        if($actualizo){
                            $datos['status']='Los datos se actualizaron correctamente';
                            $datos['ruta']=$nombrearchivo;
                            $datos['iddocumento']=$iddocumento;
     
                            $datos['cct_plantel']=$cct_plantel;
                        }
                        else{
                           $datos['status_error']="Ha ocurrido un error en la actualización.";
                        }*/
                        $datos['nombredoc']=$nombrearchivo;
                        $datos['cct_plantel']=$cct_plantel;
                        $datos['status']='Carga exitosa';
                  


                
          }

          else{
                $datos['status_error']=$this->upload->display_errors();
              }

        echo json_encode($datos);

    }


    public function get_escuela(){
        $cct = $this->input->get('cct');
        echo json_encode($this->M_aspirante_preinscripcion->get_escuela($cct));
    }


    public function insert_escuela(){
        $escuela = json_decode($this->input->raw_input_stream);
    
       if($this->M_aspirante_preinscripcion->insert_escuela($escuela)==1){
           echo "si";
       }
    
       else{
           echo "no";
       }
     
        
    }


    //generacion de matricula aspirante
    public function generar_numcontrol($semestre){

        $numero=$this->M_aspirante_preinscripcion->asignar_numero_consecutivo();
        $no_control='';
        if($numero==NULL){
            $numero=1;
        }
        else{
            $numero=$numero+1;
        }
        $no_control = 'CSEIIO'.date('y').$semestre.str_pad($numero,4,'0',STR_PAD_LEFT);
        
        return $no_control;

    }
        //fin generacion de matriucla aspirante


    //generacion de matricula aspirante
    public function generar_numcontrol_alumno($semestre){

        $numero=$this->M_estudiante->asignar_numero_consecutivo();
        $no_control='';
        if($numero==NULL){
            $numero=1;
        }
        else{
            $numero=$numero+1;
        }
        $no_control = 'CSEIIO'.date('y').$semestre.str_pad($numero,4,'0',STR_PAD_LEFT);
        
        return $no_control;

    }
        //fin generacion de matriucla aspirante

    public function agregar_aspirante(){
            $no_control=NULL;
            $tipo_estudiante = $this->input->post('formulario');
            

            $fecha_inscripcion_del_ciclo=NULL;
            $fecha_ingreso=NULL;

            if(!is_null($this->input->post("id_ciclo_escolar"))){
                $fecha_inscripcion_del_ciclo=$this->M_ciclo_escolar->obtener_nombre_ciclo_escolar($this->input->post("id_ciclo_escolar"))[0]->fecha_inicio;

                $anio_inscripcion = date("y", strtotime($fecha_inscripcion_del_ciclo)); 


                
                $fecha_ingreso=$fecha_inscripcion_del_ciclo;

                
                $no_control=$this->generar_numcontrol_ciclos_anteriores(1,$anio_inscripcion);

            }
            else{
                $fecha_inscripcion_del_ciclo = $this->M_ciclo_escolar->fecha_inscripcion();
                $fecha_ingreso=mb_strtoupper(date("Y-m-d"));
                $no_control=$this->generar_numcontrol(1);
            }




            if($this->input->post("aspirante_procedencia_combo")=="igual"){
                $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_municipio;
            }

            else if($this->input->post("aspirante_procedencia_combo")=="diferente"){
                $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_municipio;
                //$localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad;
            }

            else if($this->input->post("aspirante_procedencia_combo")=="extranjero"){
                $localidad_origen = $this->input->post("aspirante_procedencia_extranjero");
            }

            $fecha_registro_nacimiento=NULL;

            if($this->input->post('aspirante_anio_nacimiento_registro')!='' && $this->input->post('aspirante_mes_nacimiento_registro')!='' && $this->input->post('aspirante_dia_nacimiento_registro')!=''){
                $fecha_registro_nacimiento= $this->input->post('aspirante_anio_nacimiento_registro').'-'.$this->input->post('aspirante_mes_nacimiento_registro').'-'.(strlen($this->input->post('aspirante_dia_nacimiento_registro'))==1?('0'.$this->input->post('aspirante_dia_nacimiento_registro')):$this->input->post('aspirante_dia_nacimiento_registro'));

            }
            

            //inicio estudiante
            $datos_estudiante = array(
                'no_control' => $no_control,
                'nombre' => mb_strtoupper($this->input->post('aspirante_nombre')),
                'primer_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_paterno')),
                'segundo_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_materno')),
                //'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
                'fecha_nacimiento' => $this->input->post('aspirante_anio_nacimiento').'-'.$this->input->post('aspirante_mes_nacimiento').'-'.(strlen($this->input->post('aspirante_dia_nacimiento'))==1?('0'.$this->input->post('aspirante_dia_nacimiento')):$this->input->post('aspirante_dia_nacimiento')),
                'sexo' => $this->input->post('aspirante_sexo'),
                'curp' => mb_strtoupper($this->input->post('aspirante_curp')),
                'fecha_registro' => $fecha_ingreso,
                'folio_programa_social' => $this->input->post('aspirante_programa_social'),
                'correo' =>$this->input->post('aspirante_correo'),
                'nss' => mb_strtoupper($this->input->post('aspirante_nss')),
                'calle' => mb_strtoupper($this->input->post('aspirante_direccion_calle')),
                'colonia' => mb_strtoupper($this->input->post('aspirante_direccion_colonia')),
                'cp' => $this->input->post('aspirante_direccion_cp'),
                'id_localidad' => $this->input->post('aspirante_direccion_localidad'),
                'fecha_inscripcion' => $fecha_inscripcion_del_ciclo,
                'telefono' => $this->input->post('aspirante_telefono'),
                'Plantel_cct_plantel' => $this->input->post('aspirante_plantel'),
                'lugar_nacimiento' => mb_strtoupper($this->input->post('aspirante_lugar_nacimiento')),
                'nacionalidad' => $this->input->post('aspirante_nacionalidad'),
                'localidad_origen' => $localidad_origen,
                'etnia'=>$this->input->post("aspirante_etnia"),
                'fecha_registro_nacimiento' =>$fecha_registro_nacimiento

                
                
            );

            if($tipo_estudiante=='nuevo_ingreso'){
                $datos_estudiante['tipo_ingreso'] = 'NUEVO INGRESO';
                $datos_estudiante['semestre'] = 1;
                $datos_estudiante['semestre_en_curso'] = 1;
                $datos_estudiante['semestre_ingreso'] = 1;

                
                $datos_escuela_procedencia['secundaria']=array(
                    'Aspirante_no_control'=>$no_control,
                    'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct'),
                    'promedio_procedencia'=>$this->input->post('promedio_procedencia_secundaria')
                );
            }

            else{
                $datos_estudiante['tipo_ingreso'] = 'PORTABILIDAD';
                $datos_estudiante['semestre'] = $this->input->post('aspirante_semestre');
                $datos_estudiante['semestre_en_curso'] = $this->input->post('aspirante_semestre');
                $datos_estudiante['semestre_ingreso'] = $this->input->post('aspirante_semestre');
                $datos_escuela_procedencia['secundaria']=array(
                    'Aspirante_no_control'=>$no_control,
                    'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct'),
                    'promedio_procedencia'=>$this->input->post('promedio_procedencia_secundaria')
                );

                if(strlen($this->input->post('aspirante_bachillerato_cct'))>0){
                    $datos_escuela_procedencia['bachillerato']=array(
                        'Aspirante_no_control'=>$no_control,
                        'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_bachillerato_cct')
                    );

                }

                
            }


            

            //print_r($datos_estudiante);
            
            //fin estudiante

            $datos_estudiante_tutor = array(
                'nombre_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_nombre')),
                'primer_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellido')),
                'segundo_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellidodos')),
                'folio_programa_social_tutor' => $this->input->post('aspirante_tutor_prospera'),
                'telefono_comunidad' => mb_strtoupper($this->input->post('aspirante_tutor_telefono_comunidad')),
                'telefono_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_telefono')==''?null:$this->input->post('aspirante_tutor_telefono')),
                'ocupacion' => mb_strtoupper($this->input->post('aspirante_tutor_ocupacion'))
            );

            $parentesco_estudiante_tutor = mb_strtoupper($this->input->post('aspirante_tutor_parentesco')); 

            //print_r($datos_estudiante_tutor);


            //inicio lenguas maternas

            $id_lengua = $this->input->post('aspirante_lengua_nombre');

            $datos_estudiante_lengua_materna['lee'] = array(
                'Aspirante_no_control' => $no_control,
                'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
                'descripcion' => 'LEE',
                'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_lee')
            );


            $datos_estudiante_lengua_materna['habla'] = array(
                'Aspirante_no_control' => $no_control,
                'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
                'descripcion' => 'HABLA',
                'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_habla')
            );


            $datos_estudiante_lengua_materna['escribe'] = array(
                'Aspirante_no_control' => $no_control,
                'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
                'descripcion' => 'ESCRIBE',
                'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_escribe')
            );


            $datos_estudiante_lengua_materna['entiende'] = array(
                'Aspirante_no_control' => $no_control,
                'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
                'descripcion' => 'ENTIENDE',
                'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_entiende')
            );


            $datos_estudiante_lengua_materna['traduce'] = array(
                'Aspirante_no_control' => $no_control,
                'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
                'descripcion' => 'TRADUCE',
                'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_traduce')
            );

            //print_r($datos_estudiante_lengua_materna);

            //fin datos lengua materna

            $datos_estudiante_medicos['alergia'] = array(
                'descripcion' => 'ALERGIA',
                'valor' => mb_strtoupper($this->input->post('aspirante_alergia')),
                'Aspirante_no_control' => $no_control
            );

            $datos_estudiante_medicos['discapacidad'] = array(
                'descripcion' => 'DISCAPACIDAD',
                'valor' => mb_strtoupper($this->input->post('aspirante_discapacidad')),
                'Aspirante_no_control' => $no_control
            );

            $datos_estudiante_medicos['sangre'] = array(
                'descripcion' => 'TIPO DE SANGRE',
                'valor' => mb_strtoupper($this->input->post('tipo_sangre')),
                'Aspirante_no_control' => $no_control
            );


            $datos_estudiante_medicos['enfermedad_cronica'] = array(
                'descripcion' => 'ENFERMEDAD CRONICA',
                'valor' => mb_strtoupper($this->input->post('aspirante_enfermedad_cronica')),
                'Aspirante_no_control' => $no_control
            );



        



        //documentacion estudiante


            //acta de nacimiento
                if($this->input->post('aspirante_documento_acta_nacimiento')!=''){
                    
                    $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_acta_nacimiento') !='') ? $this->input->post('nombre_documento_acta_nacimiento') : NULL),
                        'id_documento' => 1,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                        'id_documento' => 1,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


            //curp
                if($this->input->post('aspirante_documento_curp')!=''){
                    $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_curp') !='') ? $this->input->post('nombre_documento_curp') : NULL),
                        'id_documento' => 2,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                        'id_documento' => 2,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


                //certiicado secundaria
                if($this->input->post('aspirante_documento_certificado_secundaria')!=''){
                    $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_certificado_secundaria') !='') ? $this->input->post('nombre_documento_certificado_secundaria') : NULL),
                        'id_documento' => 3,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                        'id_documento' => 3,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


                //fotos
                if($this->input->post('aspirante_documento_fotos')!=''){
                    $datos_estudiante_documentos['aspirante_documento_fotos'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_fotos') !='') ? $this->input->post('nombre_documento_fotos') : NULL),
                        'id_documento' => 4,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_documento_fotos'] = array(
                        'id_documento' => 4,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }

                


                //certificado medico
                if($this->input->post('aspirante_documento_certificado_medico')!=''){
                    $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_certificado_medico') !='') ? $this->input->post('nombre_documento_certificado_medico') : NULL),
                        'id_documento' => 101,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                        'id_documento' => 101,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


                //carta buena conducta
                if($this->input->post('aspirante_documento_carta_buena_conducta')!=''){
                    $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_carta_buena_conducta') !='') ? $this->input->post('nombre_documento_carta_buena_conducta') : NULL),
                        'id_documento' => 102,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                        'id_documento' => 102,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


                //documentacion extra
                if($tipo_estudiante!='nuevo_ingreso'){

                    if($this->input->post('aspirante_documento_certificado_parcial')!=''){

                        $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                            'id_documento' => 6,
                            'entregado' => true,
                            'Aspirante_no_control' => $no_control
                        );
                    }
                    else{
                        $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                            'id_documento' => 6,
                            'entregado' => 0,
                            'Aspirante_no_control' => $no_control
                        );
                    }


                    if($this->input->post('aspirante_documento_resolucion')!=''){
                        $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                            'id_documento' => 7,
                            'entregado' => true,
                            'Aspirante_no_control' => $no_control
                        );
                    }
                    else{
                        $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                            'id_documento' => 7,
                            'entregado' => 0,
                            'Aspirante_no_control' => $no_control
                        );
                    }

                }

                $check = $this->input->post('aspirante_documento_carta_extemporaneo');

                if($check=="8"){
                    $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                        'ruta' =>(($this->input->post('nombre_documento_carta_extemporaneo') !='') ? $this->input->post('nombre_documento_carta_extemporaneo') : NULL),
                        'id_documento' => 8,
                        'entregado' => 1,
                        'Aspirante_no_control' => $no_control
                    );
                }

                else if($check==""){
                    $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                        'id_documento' => 8,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }

            

                $resultado=$this->M_aspirante_preinscripcion->insertar_estudiante_nuevo_ingreso(
                    $datos_estudiante,
                    $datos_estudiante_tutor,
                    $parentesco_estudiante_tutor,
                    $datos_estudiante_lengua_materna,
                    $datos_estudiante_documentos,
                    $datos_estudiante_medicos,
                    $datos_escuela_procedencia
                );
            echo json_encode($resultado);

        if($resultado['respuesta']['tipo']=='exito'){
            $emailpara='heca123@live.com.mx';
            $this->load->library('email');
            $config['protocol']    = 'smtp';
                $config['smtp_host']    = 'ssl://smtp.gmail.com';
                $config['smtp_port']    = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'desarrolladorcseiio@gmail.com';
                $config['smtp_pass']    = 'Cseii02001';

                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or html
                $config['validation'] = TRUE; // bool whether to validate email or not     

                $this->email->initialize($config);

                $this->email->from('desarrolladorcseiio@gmail.com', 'SISE');

                $this->email->to($emailpara);

                $this->email->subject('NUEVA INSCRIPCIÓN DE ASPIRANTE EN LÍNEA');
                $this->email->message("Consulta en SISE los datos del nuevo aspirante:<br><ul><li><strong>Nombre: </strong>".mb_strtoupper($this->input->post('aspirante_nombre')).".</li><li><strong>Primer Apellido: </strong>".mb_strtoupper($this->input->post('aspirante_apellido_paterno')).".</li><li><strong>Segundo Apellido: </strong>".mb_strtoupper($this->input->post('aspirante_apellido_materno')).".</li><li><strong>Clave de Plantel: </strong>".mb_strtoupper($this->input->post('aspirante_plantel'))."</li></ul><br><br><h5>Ingrese a la página de <a href='http://localhost/controlescolar/'>SISE</a></h5>"); 

                $this->email->send();
                
                
                //echo $this->email->print_debugger();


        }
        

        
     
        
    }

    public function generar_formato_inscripcion(){
        $no_control=$this->input->get('id');
        $this->load->library('pdf');
        $datos['estudiante'] = $this->M_aspirante_preinscripcion->get_estudiante($no_control);
        $datos['plantel']= $this->M_plantel->get_plantel($datos['estudiante']['estudiante'][0]->Plantel_cct_plantel);
    
        $datos['domicilio_estudiante'] = $this->M_localidad->get_nombre_estado_municipio_localidad($datos['estudiante']['estudiante'][0]->id_localidad);
    
    
    
        
        $datos['escuela_procedencia']=$datos['estudiante']['escuela_procedencia'];
    
        if(isset($datos['estudiante']['lengua_materna'][0]->id_lengua)){
            $datos['nombre_lengua'] = $this->M_lengua->get_nombre_lengua($datos['estudiante']['lengua_materna'][0]->id_lengua)->nombre_lengua;
        $datos['lengua_lee'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][0]->porcentaje);
        $datos['lengua_habla'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][1]->porcentaje);
        $datos['lengua_escribe'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][2]->porcentaje);
        $datos['lengua_entiende'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][3]->porcentaje);
        $datos['lengua_traduce'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][4]->porcentaje);
    
        }
        else{
    
        $datos['nombre_lengua'] = "";
        $datos['lengua_lee'] ="";
        $datos['lengua_habla'] ="";
        $datos['lengua_escribe'] ="";
        $datos['lengua_entiende'] ="";
        $datos['lengua_traduce'] ="";
    
        }
        
        
        $datos['lista_documentacion'] =$this->M_aspirante_preinscripcion->get_documentacion_xnombrede_aspirante($no_control);
        $this->load->view('reportes/formatofichainscripcion',$datos);
    }


    public function valor_Lengua($valor){
        $resultado="";
        switch ($valor) {
            case 0:
                $resultado= "Nada 0%";
                break;
            case 25:
                $resultado= "Poco 25%";
                break;
            case 50:
                $resultado= "Regular 50%";
                break;
            case 75:
                $resultado= "Bien 75%";
            break;
             case 100:
                $resultado= "Muy bien 100%";
                break;
        }
    
        return $resultado;
    
    }

    public function get_aspirantes_curp_plantel(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_aspirante_preinscripcion->get_aspirantes_curp_plantel($curp,$cct_plantel));
    }

    public function get_aspirante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_aspirante_preinscripcion->get_estudiante($no_control));
    }

    public function descargar()
    {
      $iddocumento = $this->uri->segment(3);
  
       $nombredocumento=$this->M_aspirante_preinscripcion->get_nombre_archivo_documentacion($iddocumento);
      $data = file_get_contents($this->folder.$nombredocumento); 
      force_download($nombredocumento,$data); 
    }


    public function update_aspirante(){
        $no_control=NULL;
        $tipo_estudiante = $this->input->post('formulario');
        

        $no_control=$this->input->post("aspirante_no_control");//

        if($this->input->post("aspirante_procedencia_combo")=="igual"){//
            $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_municipio;
        }

        else if($this->input->post("aspirante_procedencia_combo")=="diferente"){//
            $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_municipio;
            //$localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad;
        }

        else if($this->input->post("aspirante_procedencia_combo")=="extranjero"){//
            $localidad_origen = $this->input->post("aspirante_procedencia_extranjero");
        }

        $fecha_registro_nacimiento=NULL;

        if($this->input->post('aspirante_anio_nacimiento_registro')!='' && $this->input->post('aspirante_mes_nacimiento_registro')!='' && $this->input->post('aspirante_dia_nacimiento_registro')!=''){
            $fecha_registro_nacimiento= $this->input->post('aspirante_anio_nacimiento_registro').'-'.$this->input->post('aspirante_mes_nacimiento_registro').'-'.(strlen($this->input->post('aspirante_dia_nacimiento_registro'))==1?('0'.$this->input->post('aspirante_dia_nacimiento_registro')):$this->input->post('aspirante_dia_nacimiento_registro'));

        }
        

        //inicio estudiante
        $datos_estudiante = array(
            'no_control' => $no_control,//
            'nombre' => mb_strtoupper($this->input->post('aspirante_nombre')),//
            'primer_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_paterno')),//
            'segundo_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_materno')),//
            //'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'fecha_nacimiento' => $this->input->post('aspirante_anio_nacimiento').'-'.$this->input->post('aspirante_mes_nacimiento').'-'.(strlen($this->input->post('aspirante_dia_nacimiento'))==1?('0'.$this->input->post('aspirante_dia_nacimiento')):$this->input->post('aspirante_dia_nacimiento')),//
            'sexo' => $this->input->post('aspirante_sexo'),//
            'curp' => mb_strtoupper($this->input->post('aspirante_curp')),//
            'folio_programa_social' => $this->input->post('aspirante_programa_social'),//
            'correo' =>$this->input->post('aspirante_correo'),//
            'nss' => mb_strtoupper($this->input->post('aspirante_nss')),//
            'calle' => mb_strtoupper($this->input->post('aspirante_direccion_calle')),//
            'colonia' => mb_strtoupper($this->input->post('aspirante_direccion_colonia')),//
            'cp' => $this->input->post('aspirante_direccion_cp'),//
            'id_localidad' => $this->input->post('aspirante_direccion_localidad'),//
            'telefono' => $this->input->post('aspirante_telefono'),//
            'Plantel_cct_plantel' => $this->input->post('aspirante_plantel'),//
            'lugar_nacimiento' => mb_strtoupper($this->input->post('aspirante_lugar_nacimiento')),//
            'nacionalidad' => $this->input->post('aspirante_nacionalidad'),//
            'localidad_origen' => $localidad_origen,
            'etnia'=>$this->input->post("aspirante_etnia"),//
            'fecha_registro_nacimiento' =>$fecha_registro_nacimiento//

            
            
        );

        if($tipo_estudiante=='nuevo_ingreso'){
            
            $datos_escuela_procedencia['secundaria']=array(
                'Aspirante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct'),//
                'promedio_procedencia'=>$this->input->post('promedio_procedencia_secundaria')//
            );
        }

        else{
            $datos_estudiante['tipo_ingreso'] = 'PORTABILIDAD';
            $datos_estudiante['semestre'] = $this->input->post('aspirante_semestre');
            $datos_estudiante['semestre_en_curso'] = $this->input->post('aspirante_semestre');
            $datos_estudiante['semestre_ingreso'] = $this->input->post('aspirante_semestre');
            $datos_escuela_procedencia['secundaria']=array(
                'Aspirante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct'),
                'promedio_procedencia'=>$this->input->post('promedio_procedencia_secundaria')
            );

            if(strlen($this->input->post('aspirante_bachillerato_cct'))>0){
                $datos_escuela_procedencia['bachillerato']=array(
                    'Aspirante_no_control'=>$no_control,
                    'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_bachillerato_cct')
                );

            }

            
        }


        

        //print_r($datos_estudiante);
        
        //fin estudiante

        $datos_estudiante_tutor = array(
            'id_tutor' =>$this->input->post('id_tutor'),
            'nombre_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_nombre')),//
            'primer_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellido')),//
            'segundo_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellidodos')),//
            'folio_programa_social_tutor' => $this->input->post('aspirante_tutor_prospera'),//
            'telefono_comunidad' => mb_strtoupper($this->input->post('aspirante_tutor_telefono_comunidad')),//
            'telefono_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_telefono')==''?null:$this->input->post('aspirante_tutor_telefono')),//
            'ocupacion' => mb_strtoupper($this->input->post('aspirante_tutor_ocupacion'))//
        );

        $parentesco_estudiante_tutor = mb_strtoupper($this->input->post('aspirante_tutor_parentesco')); //

        //print_r($datos_estudiante_tutor);


        //inicio lenguas maternas

        $id_lengua = $this->input->post('aspirante_lengua_nombre');//

        $datos_estudiante_lengua_materna['lee'] = array(
            'Aspirante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'LEE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_lee')//
        );


        $datos_estudiante_lengua_materna['habla'] = array(
            'Aspirante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'HABLA',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_habla')//
        );


        $datos_estudiante_lengua_materna['escribe'] = array(
            'Aspirante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ESCRIBE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_escribe')//
        );


        $datos_estudiante_lengua_materna['entiende'] = array(
            'Aspirante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ENTIENDE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_entiende')//
        );


        $datos_estudiante_lengua_materna['traduce'] = array(
            'Aspirante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'TRADUCE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_traduce')//
        );

        //print_r($datos_estudiante_lengua_materna);

        //fin datos lengua materna

        $datos_estudiante_medicos['alergia'] = array(
            'descripcion' => 'ALERGIA',
            'valor' => mb_strtoupper($this->input->post('aspirante_alergia')),//
            'Aspirante_no_control' => $no_control
        );

        $datos_estudiante_medicos['discapacidad'] = array(
            'descripcion' => 'DISCAPACIDAD',
            'valor' => mb_strtoupper($this->input->post('aspirante_discapacidad')),//
            'Aspirante_no_control' => $no_control
        );

        $datos_estudiante_medicos['sangre'] = array(
            'descripcion' => 'TIPO DE SANGRE',
            'valor' => mb_strtoupper($this->input->post('tipo_sangre')),//
            'Aspirante_no_control' => $no_control
        );


        $datos_estudiante_medicos['enfermedad_cronica'] = array(
            'descripcion' => 'ENFERMEDAD CRONICA',
            'valor' => mb_strtoupper($this->input->post('aspirante_enfermedad_cronica')),//
            'Aspirante_no_control' => $no_control
        );



    



    //documentacion estudiante


        //acta de nacimiento
            if($this->input->post('aspirante_documento_acta_nacimiento')!=''){
                
                $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_acta_nacimiento') !='') ? $this->input->post('nombre_documento_acta_nacimiento') : NULL),
                    'id_documento' => 1,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'id_documento' => 1,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }


        //curp
            if($this->input->post('aspirante_documento_curp')!=''){
                $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_curp') !='') ? $this->input->post('nombre_documento_curp') : NULL),
                    'id_documento' => 2,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                    'id_documento' => 2,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }


            //certiicado secundaria
            if($this->input->post('aspirante_documento_certificado_secundaria')!=''){
                $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_certificado_secundaria') !='') ? $this->input->post('nombre_documento_certificado_secundaria') : NULL),
                    'id_documento' => 3,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'id_documento' => 3,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }


            //fotos
            if($this->input->post('aspirante_documento_fotos')!=''){
                $datos_estudiante_documentos['aspirante_documento_fotos'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_fotos') !='') ? $this->input->post('nombre_documento_fotos') : NULL),
                    'id_documento' => 4,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_documento_fotos'] = array(
                    'id_documento' => 4,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }

            


            //certificado medico
            if($this->input->post('aspirante_documento_certificado_medico')!=''){
                $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_certificado_medico') !='') ? $this->input->post('nombre_documento_certificado_medico') : NULL),
                    'id_documento' => 101,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                    'id_documento' => 101,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }


            //carta buena conducta
            if($this->input->post('aspirante_documento_carta_buena_conducta')!=''){
                $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_carta_buena_conducta') !='') ? $this->input->post('nombre_documento_carta_buena_conducta') : NULL),
                    'id_documento' => 102,
                    'entregado' => true,
                    'Aspirante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                    'id_documento' => 102,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }


            //documentacion extra
            if($tipo_estudiante!='nuevo_ingreso'){

                if($this->input->post('aspirante_documento_certificado_parcial')!=''){

                    $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                        'id_documento' => 6,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                        'id_documento' => 6,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }


                if($this->input->post('aspirante_documento_resolucion')!=''){
                    $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                        'id_documento' => 7,
                        'entregado' => true,
                        'Aspirante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                        'id_documento' => 7,
                        'entregado' => 0,
                        'Aspirante_no_control' => $no_control
                    );
                }

            }

            $check = $this->input->post('aspirante_documento_carta_extemporaneo');

            if($check=="8"){
                $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                    'ruta' =>(($this->input->post('nombre_documento_carta_extemporaneo') !='') ? $this->input->post('nombre_documento_carta_extemporaneo') : NULL),
                    'id_documento' => 8,
                    'entregado' => 1,
                    'Aspirante_no_control' => $no_control
                );
            }

            else if($check==""){
                $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                    'id_documento' => 8,
                    'entregado' => 0,
                    'Aspirante_no_control' => $no_control
                );
            }

        

            $resultado=$this->M_aspirante_preinscripcion->update_estudiante_nuevo_ingreso(
                $datos_estudiante,
                $datos_estudiante_tutor,
                $parentesco_estudiante_tutor,
                $datos_estudiante_lengua_materna,
                $datos_estudiante_documentos,
                $datos_estudiante_medicos,
                $datos_escuela_procedencia
            );
        echo json_encode($resultado);
   
    
}

public function eliminar_bd(){
    $datos = json_decode($this->input->raw_input_stream);
    echo $this->M_aspirante_preinscripcion->eliminar_bd($datos);
}


public function exportar_id(){
    $datos = json_decode($this->input->raw_input_stream);
    $aspirante=$this->M_aspirante_preinscripcion->get_estudiante($datos->no_control);
    $no_control=NULL;
      $fecha_inscripcion_del_ciclo=NULL;
      $fecha_ingreso=NULL;

      $datos_escuela=array();
      $datos_escuela_procedencia=array();

      $fecha_inscripcion_del_ciclo = $this->M_ciclo_escolar->fecha_inscripcion();
      $fecha_ingreso=mb_strtoupper(date("Y-m-d"));
      $no_control=$this->generar_numcontrol_alumno(1);
      $aspirante_no_control = array('no_control' => $aspirante['estudiante'][0]->no_control);

      /**Ingresar datos a tabla estudiante */
      $datos_estudiante = array(
        'no_control' => $no_control,
        'nombre' =>$aspirante['estudiante'][0]->nombre,
        'primer_apellido' =>$aspirante['estudiante'][0]->primer_apellido,
        'segundo_apellido' =>$aspirante['estudiante'][0]->segundo_apellido,
        'fecha_nacimiento' =>$aspirante['estudiante'][0]->fecha_nacimiento,
        'sexo' => $aspirante['estudiante'][0]->sexo,
        'curp' => $aspirante['estudiante'][0]->curp,
        'fecha_registro' =>$aspirante['estudiante'][0]->fecha_registro,
        'folio_programa_social' => $aspirante['estudiante'][0]->folio_programa_social,
        'correo' =>$aspirante['estudiante'][0]->correo,
        'nss' =>$aspirante['estudiante'][0]->nss,
        'calle' => $aspirante['estudiante'][0]->calle,
        'colonia' =>$aspirante['estudiante'][0]->colonia,
        'cp' => $aspirante['estudiante'][0]->cp,
        'id_localidad' =>$aspirante['estudiante'][0]->id_localidad,
        'fecha_inscripcion' => $fecha_inscripcion_del_ciclo,
        'telefono' => $aspirante['estudiante'][0]->telefono,
        'Plantel_cct_plantel' => $aspirante['estudiante'][0]->Plantel_cct_plantel,
        'lugar_nacimiento' =>$aspirante['estudiante'][0]->lugar_nacimiento,
        'nacionalidad' => $aspirante['estudiante'][0]->nacionalidad,
        'localidad_origen' => $aspirante['estudiante'][0]->localidad_origen,
        'etnia'=>$aspirante['estudiante'][0]->etnia,
        'fecha_registro_nacimiento' =>$aspirante['estudiante'][0]->fecha_registro_nacimiento,
        'tipo_ingreso'=>'NUEVO INGRESO',
        'semestre'=>1,
        'semestre_en_curso'=>1,
        'semestre_ingreso'=>1,
    );
    /**Termina datos a tabla estudiante */
    if(count($aspirante['escuela_procedencia'])>0){
        if(count($this->M_escuela_procedencia->get_escuela($aspirante['escuela_procedencia'][0]->cct_escuela_procedencia))<1){
            $datos_escuela['escuela']=array(
                'cct_escuela_procedencia'=>$aspirante['escuela_procedencia'][0]->cct_escuela_procedencia,
                'nombre_escuela_procedencia'=>$aspirante['escuela_procedencia'][0]->nombre_escuela_procedencia,
                'tipo_subsistema'=>$aspirante['escuela_procedencia'][0]->tipo_subsistema,
                'id_localidad_escuela_procedencia'=>$aspirante['escuela_procedencia'][0]->id_localidad_escuela_procedencia,
                'tipo_escuela_procedencia'=>$aspirante['escuela_procedencia'][0]->tipo_escuela_procedencia
            );
        }

        $datos_escuela_procedencia['secundaria']=array(
            'Estudiante_no_control'=>$no_control,
            'Escuela_procedencia_cct_escuela_procedencia'=>$aspirante['escuela_procedencia'][0]->Escuela_procedencia_cct_escuela_procedencia,
            'promedio_procedencia'=>$aspirante['escuela_procedencia'][0]->promedio_procedencia
        );

    }
    

    $datos_estudiante_tutor = array(
        'nombre_tutor' => $aspirante['tutor'][0]->nombre_tutor,
        'primer_apellido_tutor' =>$aspirante['tutor'][0]->primer_apellido_tutor,
        'segundo_apellido_tutor' =>$aspirante['tutor'][0]->segundo_apellido_tutor,
        'folio_programa_social_tutor' =>$aspirante['tutor'][0]->folio_programa_social_tutor, 
        'telefono_comunidad' => $aspirante['tutor'][0]->telefono_comunidad,
        'telefono_tutor' =>$aspirante['tutor'][0]->telefono_tutor,
        'ocupacion' =>$aspirante['tutor'][0]->ocupacion
         );

        foreach($aspirante['lengua_materna'] as $lengua){

            $datos_estudiante_lengua_materna[] = array(
               'Estudiante_no_control' => $no_control,
               'id_lengua' => $lengua->id_lengua,
               'descripcion' => $lengua->descripcion,
               'porcentaje' =>$lengua->porcentaje
           );
   
         }

         foreach($aspirante['expediente_medico'] as $m){
            $datos_estudiante_medicos[] = array(
               'descripcion' => $m->descripcion,
               'valor' => $m->valor,
               'Estudiante_no_control' => $no_control
           );
         }

         foreach($aspirante['documentacion'] as $doc){
            $datos_estudiante_documentos[] = array(
               'id_documento' =>$doc->id_documento,
               'fecha_entrega' =>$doc->fecha_entrega,
               'entregado' =>$doc->entregado,
               'observacion'=>$doc->observacion,
               'ruta'=>$doc->ruta,
               'Estudiante_no_control'=>$no_control,
               'id_plantel'=>$doc->id_plantel
           );
            
         }

         $parentesco_estudiante_tutor = $aspirante['tutor'][0]->parentesco;

        echo $this->M_aspirante_preinscripcion->exportar_id(
        $datos_estudiante,
        $datos_estudiante_tutor,
        $parentesco_estudiante_tutor,
        $datos_estudiante_lengua_materna,
        $datos_estudiante_documentos,
        $datos_estudiante_medicos,
        $datos_escuela_procedencia,
        $datos_escuela,
        $aspirante_no_control
    );
    }

}
?>