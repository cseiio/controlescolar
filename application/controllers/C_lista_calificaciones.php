<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


//el controlador debe empezar con mayuscula
class C_lista_calificaciones extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_localidad');
        $this->load->model('M_grupo_estudiante');
        $this->load->model('M_asesor');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_baja');
    }

    public function get_nombre_mes($semestre){
          
        switch ($semestre){
            case 1: return "ENERO"; break;
            case 2: return "FEBRERO"; break;
            case 3: return "MARZO"; break;
            case 4: return "ABRIL"; break;
            case 5: return "MAYO"; break;
            case 6: return "JUNIO"; break;
            case 7: return "JULIO"; break;
            case 8: return "AGOSTO"; break;
            case 9: return "SEPTIEMBRE"; break;
            case 10: return "OCTUBRE"; break;
            case 11: return "NOVIEMBRE"; break;
            case 12: return "DICIEMBRE"; break;
            
        }
    }

    public function get_nombre_semestre($semestre){
       
        switch ($semestre){
            case 1: return "PRIMER"; break;
            case 2: return "SEGUNDO"; break;
            case 3: return "TERCER"; break;
            case 4: return "CUARTO"; break;
            case 5: return "QUINTO"; break;
            case 6: return "SEXTO"; break;
            
        }
        }

    public function lista_calificaciones_grupo_materia(){
        
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $this->load->library('pdf');
        $datos['estudiantes'] = $this->M_grupo_estudiante->nombres_estudiantes_grupo_materia($grupo,$materia);
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $datos['asesor'] = $this->M_asesor->asesor_materia_grupo($grupo,$materia);
        $datos['fecha_fin'] = $this->M_ciclo_escolar->fecha_fin_ciclo();
        $this->load->view("reportes/lista_calificaciones",$datos);
    }


    public function lista_calificaciones_grupo_materia_llena(){
        $this->load->library('pdf');
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");

        $datos['estudiantes'] = $this->M_grupo_estudiante->datos_estudiantes_grupo_materia($grupo,$materia);

        $bajas = array();
        $contador = 0;

        foreach($datos['estudiantes'] as $estudiante){
            $baja = $this->M_baja->baja_estudiante_x_ciclo($estudiante->no_control,$grupo);
            
            if(sizeof($baja)>0){
                $bajas[$contador]=$baja;
            }

            else{
                $bajas[$contador]=array();
            }
            $contador+=1;
        }
        $datos['plantel'] = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos['materia'] = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $datos['asesor'] = $this->M_asesor->asesor_materia_grupo($grupo,$materia);
        $datos['fecha_fin'] = $this->M_ciclo_escolar->fecha_fin_ciclo();
        $datos['bajas'] = $bajas;
        //$datos['bajas'] = $this->;
       // print_r($this->M_asesor->asesor_materia_grupo($grupo,$materia));
        $this->load->view("reportes/lista_calificaciones_llena",$datos);
        //print_r($bajas);
    }

    public function lista_calificaciones_grupo_materia_llena_formato_excel(){
        $grupo = $this->input->get("grupo");
        $materia = $this->input->get("materia");
        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $respuesta='';
        

        $sheet2 = $spreadsheet->getActiveSheet();
        $sheet2->getSheetView()->setZoomScale(80);

        $datos_estudiante = $this->M_grupo_estudiante->datos_estudiantes_grupo_materia($grupo,$materia);
        $datos_plantel = $this->M_grupo_estudiante->plantel_grupo($grupo);
        $datos_materia = $this->M_grupo_estudiante->datos_materia_grupo($materia,$grupo);
        $datos_fecha_fin = $this->M_ciclo_escolar->fecha_fin_ciclo();
        $datos_asesor = $this->M_asesor->asesor_materia_grupo($grupo,$materia);
        $bajas = array();
        $contador_array_baja = 0;

        foreach($datos_estudiante as $estudiante){
            $baja = $this->M_baja->baja_estudiante_x_ciclo($estudiante->no_control,$grupo);
            
            if(sizeof($baja)>0){
                $bajas[$contador_array_baja]=$baja;
            }

            else{
                $bajas[$contador_array_baja]=array();
            }
            $contador_array_baja+=1;
        }

        
        $date = date_create($datos_fecha_fin);
        $cadena_fecha=date_format($date, 'd').' DE '.$this->get_nombre_mes(date_format($date, 'm')).' DE '.date_format($date, 'Y');
        $asesor_nombre = sizeof($datos_asesor)==0?"":($datos_asesor[0]->nombre.' '.$datos_asesor[0]->primer_apellido.' '.$datos_asesor[0]->segundo_apellido);

        // manually set table data value
        $cont_fila_excel=13;
        $cont_numero=0;

        $styleArray = [
            'font' => [
                'bold' => true,
                'size'  => 10,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFC4BD97',
                ]
            ],
        ];

        $styleArrayListaAlumno1 = [
            'font' => [
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];

       

        $styleArrayListaAlumno2 = [
            'font' => [
                'size'  => 14,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ]
        ];

        $styleArrayListaCintillo = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF808080',
                ]
            ],
        ];

        $styleArrayListaCintilloBaja = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFBFBFBF',
                ]
            ],
        ];

        $styleArrayTitulo1 = [
            'font' => [
                'bold' => true,
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTitulo2 = [
            'font' => [
                'bold' => true,
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTitulo3 = [
            'font' => [
                'bold' => true,
                'italic' => true,
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTitulo4 = [
            'font' => [
                'italic' => true,
                'size'  => 10,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTitulo5 = [
            'font' => [
                'bold' => true,
                'size'  => 10,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTitulo6 = [
            'font' => [
                'size'  => 11,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTituloFecha = [
            'font' => [
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayFecha = [
            'font' => [
                'size'  => 12,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayNombreAsesorDirector = [
            'font' => [
                'size'  => 11,
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $styleArrayTituloAsesorDirector = [
            'font' => [
                'size'  => 10,
                'name'  => 'Arial'
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setPath('./assets/img/logo_cseiio.png');
        $drawing->setHeight(91);
        $drawing->setOffsetX(30);
        $drawing->setOffsetY(10);
        $drawing->setWorksheet($sheet2);


        $drawing2 = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing2->setName('Logo2');
        $drawing2->setDescription('Logo2');
        $drawing2->setPath('./assets/img/logo_gobierno.png');
        $drawing2->setHeight(113);
        $drawing2->setCoordinates('K1');
        $drawing2->setOffsetX(30);
        $drawing2->setOffsetY(10);
        $drawing2->setWorksheet($sheet2);
        
        $sheet2->mergeCells("A1:K1");
        $sheet2->setCellValue('A1','COLEGIO SUPERIOR PARA LA EDUCACION INTEGRAL INTERCULTURAL DE OAXACA');
        $sheet2->getStyle('A1:K1')->applyFromArray($styleArrayTitulo1);

        $sheet2->mergeCells("A2:K2");
        $sheet2->setCellValue('A2','DEPARTAMENTO DE CONTROL ESCOLAR');
        $sheet2->getStyle('A2:K2')->applyFromArray($styleArrayTitulo2);

        $sheet2->mergeCells("A4:K4");
        $sheet2->setCellValue('A4','CONCENTRADO DE CALIFICACIONES MODULARES');
        $sheet2->getStyle('A4:K4')->applyFromArray($styleArrayTitulo3);

        $sheet2->mergeCells("A5:K5");
        $sheet2->setCellValue('A5',$this->get_nombre_semestre($datos_materia->semestre).' MÓDULO');
        $sheet2->getStyle('A5:K5')->applyFromArray($styleArrayTitulo4);

        
        $sheet2->setCellValue('A7','NOMBRE DEL PLANTEL:');
        $sheet2->getStyle('A7')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('C7',$datos_plantel->nombre_largo.' DE '.$datos_plantel->nombre_plantel);
        $sheet2->getStyle('C7')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('A8','CLAVE C.T.:');
        $sheet2->getStyle('A8')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('C8',$datos_plantel->cct_plantel);
        $sheet2->getStyle('C8')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('A9','LOCALIDAD Y MUNICIPIO:');
        $sheet2->getStyle('A9')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('C9',$datos_plantel->localidad_municipio);
        $sheet2->getStyle('C9')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('A10','UNIDAD DE CONTENIDO:');
        $sheet2->getStyle('A10')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('C10',strtoupper($datos_materia->unidad_contenido));
        $sheet2->getStyle('C10')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('A11','CLAVE:');
        $sheet2->getStyle('A11')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('C11',strtoupper($datos_materia->clave));
        $sheet2->getStyle('C11')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('I8','GRUPO:');
        $sheet2->getStyle('I8')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('K8',strtoupper($datos_materia->nombre_grupo));
        $sheet2->getStyle('K8')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('I9','PERIODO:');
        $sheet2->getStyle('I9')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('K9',strtoupper($datos_materia->periodo));
        $sheet2->getStyle('K9')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('I10','CICLO ESCOLAR :');
        $sheet2->getStyle('I10')->applyFromArray($styleArrayTitulo5);
        $sheet2->setCellValue('K10',strtoupper($datos_materia->nombre_ciclo_escolar));
        $sheet2->getStyle('K10')->applyFromArray($styleArrayTitulo6);

        $sheet2->setCellValue('B51','FECHA:');
        $sheet2->setCellValue('C51',strtoupper($cadena_fecha));
        $sheet2->getStyle('B51')->applyFromArray($styleArrayTituloFecha);
        $sheet2->getStyle('C51')->applyFromArray($styleArrayFecha);

        $sheet2->mergeCells("A56:C56");
        $sheet2->setCellValue('A56',$asesor_nombre);
        $sheet2->getStyle('A56')->applyFromArray($styleArrayNombreAsesorDirector);

        $sheet2->mergeCells("A57:C57");
        $sheet2->setCellValue('A57','NOMBRE Y FIRMA DEL ASESOR');
        $sheet2->getStyle('A57:C57')->applyFromArray($styleArrayTituloAsesorDirector);

        $sheet2->mergeCells("E57:F57");
        $sheet2->setCellValue('E57','SELLO');
        $sheet2->getStyle('E57:F57')->applyFromArray($styleArrayTituloAsesorDirector);

        $sheet2->mergeCells("H56:K56");
        $sheet2->setCellValue('H56',$datos_plantel->director);
        $sheet2->getStyle('H56')->applyFromArray($styleArrayNombreAsesorDirector);

        $sheet2->mergeCells("H57:K57");
        $sheet2->setCellValue('H57','NOMBRE Y FIRMA DEL DIRECTOR(A)');
        $sheet2->getStyle('H57:K57')->applyFromArray($styleArrayTituloAsesorDirector);
        


        

        $sheet2->mergeCells("A12:A13");
        $sheet2->getColumnDimension('A')->setWidth(4.42);
        $sheet2->setCellValue('A12','NO.');
        $sheet2->mergeCells("B12:D13");
        $sheet2->getColumnDimension('B')->setWidth(26.71);
        $sheet2->getColumnDimension('C')->setWidth(29.42);
        $sheet2->getColumnDimension('D')->setWidth(44.14);
        $sheet2->setCellValue('B12','NOMBRE DEL ALUMNO');
        if($datos_materia->tipo_semestre=='A'){
            $sheet2->setCellValue('E12','MAR');
            $sheet2->getColumnDimension('E')->setWidth(8.71);
            $sheet2->setCellValue('F12','MAY');
            $sheet2->getColumnDimension('F')->setWidth(8.71);
            $sheet2->setCellValue('G12','JUN');
            $sheet2->getColumnDimension('G')->setWidth(8.71);
        }
            
        else{
            $sheet2->setCellValue('E12','SEP');
            $sheet2->getColumnDimension('E')->setWidth(8.71);
            $sheet2->setCellValue('F12','NOV');
            $sheet2->getColumnDimension('F')->setWidth(8.71);
            $sheet2->setCellValue('G12','DIC');
            $sheet2->getColumnDimension('G')->setWidth(8.71);
                
        }
        
        $sheet2->setCellValue('H12','PROM MOD.');
        $sheet2->getColumnDimension('H')->setWidth(8.71);
        $sheet2->getStyle('H12')->getAlignment()->setWrapText(true);
        $sheet2->setCellValue('I12','EXA. FINAL');
        $sheet2->getColumnDimension('I')->setWidth(8.71);
        $sheet2->getStyle('I12')->getAlignment()->setWrapText(true);
        $sheet2->setCellValue('J12','CAL. FINAL');
        $sheet2->getColumnDimension('J')->setWidth(12.28);
        $sheet2->getStyle('J12')->getAlignment()->setWrapText(true);
        $sheet2->setCellValue('K12','FECHA DE BAJA');
        $sheet2->getColumnDimension('K')->setWidth(29.14);
        $sheet2->mergeCells("E12:E13");
        $sheet2->mergeCells("F12:F13");
        $sheet2->mergeCells("G12:G13");
        $sheet2->mergeCells("H12:H13");
        $sheet2->mergeCells("I12:I13");
        $sheet2->mergeCells("J12:J13");
        $sheet2->mergeCells("K12:K13");
        $sheet2->getStyle('A12:K13')->applyFromArray($styleArray);
        foreach($datos_estudiante as $estudiante){
            $cont_fila_excel++;
            $cont_numero++;

            /*codigo para generar promedio y estilo para las bajas*/
            $promedio="";

        if(!is_null($estudiante->primer_parcial) && !is_null($estudiante->segundo_parcial) && !is_null($estudiante->tercer_parcial)){
            $promedio = (intval($estudiante->primer_parcial)+intval($estudiante->segundo_parcial)+intval($estudiante->tercer_parcial))/3;
            if($promedio>0 && $promedio<6){
                $promedio=5;
            }
            else{
                $promedio = round($promedio,0,PHP_ROUND_HALF_UP);
            }
            

        }
        

       
        if(sizeof($bajas[$cont_numero-1])>0){
            $respuesta.='<tr style="background-color:#ececec;line-height: 20px;">';
            $promedio="/";
            
        }

       

        if($estudiante->calificacion_final>0 && $estudiante->calificacion_final!="" && !is_null($estudiante->calificacion_final)){
            if($datos_materia->tipo=="EXTRAESCOLAR"){
                switch ($estudiante->calificacion_final){
        
                    case 6: 
                        $calificacion_final="S";
                    break;
                    case 7: 
                        $calificacion_final="R"; 
                    break;
                    case 8: 
                        $calificacion_final="B"; 
                    break;
                    case 9: 
                        $calificacion_final="MB"; 
                    break;
                    case 10: 
                        $calificacion_final="E"; 
                    break;
                    default:
                    $calificacion_final="/";
                    
                }

                
            }
            else{
                $calificacion_final=$estudiante->calificacion_final;
            }
            
        }

        else{
            if(is_null($estudiante->calificacion_final) && $estudiante->calificacion_final==""){
                $calificacion_final="";
            }
            else{
                $calificacion_final="/";
            }
            
        }
        
        if(strlen($promedio)>0){
            if($promedio=='0'){
                $promedio='/';
            }

        }
            /*Termina código para generar promedio y estilo para las bajas*/
            $sheet2->setCellValue('A'.$cont_fila_excel, str_pad($cont_numero,2,0,STR_PAD_LEFT));
            $sheet2->setCellValue('B'.$cont_fila_excel, $estudiante->primer_apellido);
            $sheet2->setCellValue('C'.$cont_fila_excel, $estudiante->segundo_apellido);
            $sheet2->setCellValue('D'.$cont_fila_excel, $estudiante->nombre);
            $sheet2->setCellValue('E'.$cont_fila_excel, (($estudiante->primer_parcial)=='0'?'/':$estudiante->primer_parcial));
            $sheet2->setCellValue('F'.$cont_fila_excel,(($estudiante->segundo_parcial)=='0'?'/':$estudiante->segundo_parcial));
            $sheet2->setCellValue('G'.$cont_fila_excel, (($estudiante->tercer_parcial)=='0'?'/':$estudiante->tercer_parcial));
            $sheet2->setCellValue('H'.$cont_fila_excel, $promedio);
            $sheet2->setCellValue('I'.$cont_fila_excel, (($estudiante->examen_final)=='0'?'/':$estudiante->examen_final));
            $sheet2->setCellValue('J'.$cont_fila_excel,$calificacion_final);

            if(sizeof($bajas[$cont_numero-1])>0){
                $fecha_baja="";
    
                if($bajas[$cont_numero-1][0]->fecha!=''){
                    $fecha_baja=date("d/m/Y", strtotime($bajas[$cont_numero-1][0]->fecha));
                    $sheet2->getStyle('A'.$cont_fila_excel.':K'.$cont_fila_excel)->applyFromArray($styleArrayListaCintilloBaja);
                }
                $sheet2->setCellValue('K'.$cont_fila_excel,$fecha_baja);
                
            }
           
            
        }

        
        $sheet2->getStyle('A14:D'.$cont_fila_excel)->applyFromArray($styleArrayListaAlumno1);
        $sheet2->getStyle('E14:K'.$cont_fila_excel)->applyFromArray($styleArrayListaAlumno2);
        $cont_fila_excel++;
        $sheet2->getStyle('A'.$cont_fila_excel.':K'.$cont_fila_excel)->applyFromArray($styleArrayListaCintillo);
        $cont_numero++;
        $sheet2->setCellValue('A'.$cont_fila_excel, str_pad($cont_numero,2,0,STR_PAD_LEFT));
        $filas_restantes=35-($cont_numero);
        if($filas_restantes>0){
            $fila_final=$cont_fila_excel+$filas_restantes;
            $sheet2->getStyle('A'.($cont_fila_excel++).':K'.$fila_final)->applyFromArray($styleArrayListaAlumno1);

            for($x=$cont_fila_excel;$x<=$fila_final;$x++){
                $cont_numero++;
                $sheet2->setCellValue('A'.$x, str_pad($cont_numero,2,0,STR_PAD_LEFT));
    
            }
            
            

        }

        
        
        $sheet2->getStyle('A14:A'.$fila_final)->applyFromArray($styleArrayListaAlumno1);
       $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'lista_de_calificaciones'; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        ob_end_clean();
        
        $writer->save('php://output');	// download file
        

    }

   
}