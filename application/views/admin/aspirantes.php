<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de aspirantes</a>
      </li>
      <li class="breadcrumb-item active">Ingrese la búsqueda que desea realizar</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="aspirante_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>


        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="aspirante_plantel_busqueda" name="aspirante_plantel">
                  <option value="">Buscar en todos los planteles</option>

                  <?php
                      foreach ($planteles as $plantel)
                      {
                        echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>

                </select>
                <span>Plantel</span>
              </label>

            </div>

            <div class="col-md-4">
              <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar"
                onclick='buscar()'>Buscar</button>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="card" style="overflow:scroll; display:none" id="busqueda_oculto">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Matrícula</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Fecha Ingreso</th>
              <th scope="col" class="col-md-1">Editar</th>
              <th scope="col" class="col-md-1">Exportar</th>
              <?php if ($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){?>
              <th scope="col" class="col-md-1">Eliminar</th>
              <?php }?>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="modalaspirante" tabindex="-1" role="dialog" aria-labelledby="modalaspiranteTitle"
  aria-hidden="true" style="overflow-y: scroll;">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <!-- Inicia cuerpo modal-->

        <div class="container-fluid" id="grad1">
            <div class="row justify-content-center mt-0">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <h2><strong>Editar datos de Aspirante</strong></h2>
                        <p>Rellene los campos del formulario.</p>
                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <div id="msform"><!--Empieza div de formulario paso a paso-->
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>1.- Datos Personales</strong></li>
                                        <li id="personal"><strong>2.- Documentos Solicitados</strong></li>
                                    <!-- <li id="payment"><strong>Payment</strong></li>
                                        <li id="confirm"><strong>Finish</strong></li> -->
                                    </ul> <!-- fieldsets -->

                                    <!-- Fieldset para datos personales-->
                                    <fieldset>
                                    
                                        
                                        <div class="form-card">
                                        <form id="datos_alumno" name="datos_alumno">
                                            <!-- Breadcrumbs-->
                                            <input type="hidden" class="form-control text-uppercase" id="aspirante_no_control"
                                                    name="aspirante_no_control">
                                                    <input type="hidden" id="id_tutor" name="id_tutor">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                            <a>Nueva Preinscripción</a>
                                            </li>
                                            <li class="breadcrumb-item active">Rellene todos los campos</li>
                                            <div class=" col-md-4 text-right" style="font-weight:bold"> Ciclo escolar:
                                            <?php
                                                //echo ($ciclo_escolar[0]->nombre_ciclo_escolar);
                                                ?>
                                            </div>
                                        </ol>

                                        <input type="text" name="formulario" value="nuevo_ingreso" style="display:none">

                                        

                                        <!--datos personales------------------------------------------------------>
                                        <p class="text-center text-white rounded titulo-form h4 ">Datos personales de Aspirante</p>
                                        <hr>

                                        <div class="form-group">

                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca el nombre"
                                                    class="form-control text-uppercase" id="aspirante_nombre" name="aspirante_nombre"
                                                    onchange="valida(this);" placeholder="Nombre(s)" style="color: #237087 ">
                                                    <label for="aspirante_nombre">Nombre(s)</label>
                                                    
                                                </div>
                                                
                                                </div>

                                                <div class="col-md-4">
                                                <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca el primer apellido"
                                                    class="form-control text-uppercase" id="aspirante_apellido_paterno" name="aspirante_apellido_paterno"
                                                    onchange="valida(this);" placeholder="Apellido Paterno" style="color: #237087 ">
                                                    <label for="aspirante_apellido_paterno">Primer Apellido</label>
                                                </div>
                                                </div>

                                                <div class="col-md-4">
                                                <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo texto"
                                                    class="form-control text-uppercase" id="aspirante_apellido_materno" name="aspirante_apellido_materno"
                                                    onchange="valida(this);" placeholder="Apellido Materno" style="color: #237087 ">
                                                    <label for="aspirante_apellido_materno">Segundo Apellido</label>
                                                </div>
                                                </div>
                                            </div>

                                            </div>

                                            <div class="card form-group">
                                                <div>
                                                <label class="form-group has-float-label text-center" style="font-size: 12pt; font-weight: bold; color:#777;" >Fecha de nacimiento</label>
                                                </div>

                                                <div class="row">
                                                
                                                <div class=" col-md-4 ">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_anio_nacimiento" required name="aspirante_anio_nacimiento" onclick="get_dias()">

                                                    </select>
                                                    <span>Año</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_mes_nacimiento" required name="aspirante_mes_nacimiento" onclick="get_dias()">
                                                    <option value="01">Enero 01</option>
                                                    <option value="02">Febrero 02</option>
                                                    <option value="03">Marzo 03</option>
                                                    <option value="04">Abril 04</option>
                                                    <option value="05">Mayo 05</option>
                                                    <option value="06">Junio 06</option>
                                                    <option value="07">Julio 07</option>
                                                    <option value="08">Agosto 08</option>
                                                    <option value="09">Septiembre 09</option>
                                                    <option value="10">Octubre 10</option>
                                                    <option value="11">Noviembre 11</option>
                                                    <option value="12">Diciembre 12</option>
                                                    </select>
                                                    <span>Mes</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4 ">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_dia_nacimiento" required name="aspirante_dia_nacimiento">

                                                    </select>
                                                    <span>Día</span>
                                                    </label>
                                                </div>


                                                </div>

                                                </div>

                                            <div class="form-group">

                                                <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-label-group">
                                                    <input type="number" title="El numero de telefono debe de ser a 13 digitos" style="color: #237087 "
                                                        class="form-control text-uppercase" id="aspirante_telefono" name="aspirante_telefono"
                                                        placeholder="Telefono">
                                                    <label for="aspirante_telefono">Teléfono</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-label-group">
                                                    <input type="email"
                                                        title="Introduzca un correo valido" class="form-control text-lowercase" id="aspirante_correo"
                                                        name="aspirante_correo" placeholder="Correo Electrónico" style="color: #237087 ">
                                                    <label for="aspirante_correo">Correo electrónico</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_sexo" required name="aspirante_sexo" title="Seleccione el sexo">
                                                        <option value="">Seleccione</option>
                                                        <option value="H">Hombre</option>
                                                        <option value="M">Mujer</option>
                                                    </select>
                                                    <span>Sexo</span>
                                                    </label>
                                                </div>

                                                </div>

                                            </div>


                                        <div class="form-group">
                                            <div class="row">
                                            

                                                <div class="col-md-4">
                                                <div class="form-label-group">
                                                    <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos" class="form-control text-uppercase"
                                                    id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social" style="color: #237087 ">
                                                    <label for="aspirante_nss">NSS (IMSS)</label>
                                                </div>
                                                </div>
                                                <div class="col-md-4">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control text-uppercase" id="aspirante_programa_social"
                                                    name="aspirante_programa_social" placeholder="Folio de programa social" style="color: #237087 ">
                                                    <label for="aspirante_programa_social">Folio de Prospera</label>
                                                </div>
                                                </div>

                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" name="tipo_sangre" required id="tipo_sangre" title="Seleccione el tipo de sangre">
                                                        <option value="">Seleccione una opción</option>
                                                        <option value="NO CONOCE">No conoce su tipo de sangre</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                    </select>
                                                    <span>Tipo de sangre</span>
                                                    </label>
                                                </div>
                                                </div>

                                                </div>
                                            </div>
                                        
                                            <div class="form-group">
                                                <div class="row">

                                                <div class="col-md-4">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_alergia_combo" name="aspirante_alergia_combo"
                                                        onchange="alergia(this)">
                                                        <option value="2">No</option>
                                                        <option value="1">Sí</option>
                                                    </select>
                                                    <span>¿Alérgico a algún medicamento?</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4" style="display:none" id="a" name="alergia_medicamento">
                                                    <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                                                        class="form-control text-uppercase" id="aspirante_alergia" name="aspirante_alergia"
                                                        placeholder="Ingrese el medicamento" style="color: #237087 ">
                                                    <label for="aspirante_alergia">Ingrese el medicamento</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_discapacidad_combo"
                                                        name="aspirante_discapacidad_combo" onchange="discapacidad(this)">
                                                        <option value="2">No</option>
                                                        <option value="1">Sí</option>
                                                    </select>
                                                    <span>¿Padece alguna discapacidad?</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4" style="display:none" id="b" name="discapacidad">
                                                    <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                                                        class="form-control text-uppercase" id="aspirante_discapacidad" name="aspirante_discapacidad"
                                                        placeholder="Ingrese la discapacidad" style="color: #237087 ">
                                                    <label for="aspirante_discapacidad">Ingrese la discapacidad</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_enfermedad_cronica_combo"
                                                        name="aspirante_enfermedad_cronica_combo" onchange="enfermedad_cronica(this)">
                                                        <option value="2">No</option>
                                                        <option value="1">Sí</option>
                                                    </select>
                                                    <span>¿Padece alguna enfermedad cronica?</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-4" style="display:none" id="c" name="enfermedad_cronica">
                                                    <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                                                        class="form-control text-uppercase" id="aspirante_enfermedad_cronica" name="aspirante_enfermedad_cronica"
                                                        placeholder="Ingrese la enfermedad cronica" style="color: #237087 ">
                                                    <label for="aspirante_enfermedad_cronica">Ingrese enfermedad cronica</label>
                                                    </div>
                                                </div>



                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" id="aspirante_plantel" required name="aspirante_plantel">

                                                        <?php
                                                                                foreach ($planteles as $plantel)
                                                                                {
                                                                                echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                                                                                }
                                                                                ?>

                                                    </select>
                                                    <span>Plantel</span>
                                                    </label>
                                                </div>

                                                <div class="col-md-4">
                                                    <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control form-control-lg selcolor" disabled id="aspirante_semestre" name="aspirante_semestre">
                                                        <option value="">1</option>

                                                    </select>
                                                    <span>Semestre de ingreso</span>
                                                    </label>
                                                </div>

                                                </div>

                                            </div>
                                            <!--fin datos personales------------------------------------------------------>

                                            <!--curp------------------------------------------------------>
                                            <p class="text-center text-white rounded titulo-form h4">CURP</p>
                                                    <hr>

                                                    <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor" required name="aspirante_nacimiento_estado"
                                                            onChange="curp();" id="selector_estado_nacimiento_aspirante" title="Seleccione el estado">
                                                            <option value="">Seleccione el estado de nacimiento</option>
                                                            <option value="otro">NACIÓ EN OTRO PAÍS</option>

                                                            <?php
                                                                            foreach ($estados as $estado)
                                                                            {
                                                                                    echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                                                                            }
                                                                            ?>



                                                            </select>
                                                            <span>Estado de nacimiento</span>
                                                        </label>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <div class="form-label-group">
                                                            <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" 
                                                            class="form-control text-uppercase" id="aspirante_curp" name="aspirante_curp" 
                                                            onchange="valida(this);" placeholder="CURP" style="color: #237087 ">
                                                            <label for="aspirante_curp">CURP</label>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-label-group">
                                                            <a name="" id="" class="btn btn-outline-success btn-lg btn-block btn-responsive"
                                                            href="https://www.gob.mx/curp/" target="_blank" role="button">
                                                            ¿No cuenta con curp? Buscar aquí</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor" id="aspirante_nacionalidad" required name="aspirante_nacionalidad" title="Seleccione la nacionalidad">
                                                            <option value="">Seleccione</option>
                                                            <option value="MEXICANA">MEXICANA</option>
                                                            <option value="EXTRANJERA">EXTRANJERA</option>
                                                            </select>
                                                            <span>Nacionalidad</span>
                                                        </label>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <div class="form-label-group">
                                                            <input type="text" title="Introduzca el lugar de nacimiento" class="form-control text-uppercase"
                                                            id="aspirante_lugar_nacimiento" name="aspirante_lugar_nacimiento" required
                                                            placeholder="Lugar de nacimiento"style="color: #237087 ">
                                                            <label for="aspirante_lugar_nacimiento">Lugar de Nacimiento</label>
                                                        </div>
                                                        </div>

                                                                        </div>
                                                                        </div>

                                                    <div class="form-group">
                                                    <div class="row">
                                                    <div class=" col-md-2 ">
                                                        <label class="form-group has-float-label text-center" style="font-size: 12pt; font-weight: bold; color:#777;">Fecha de registro de Acta</label>
                                                        </div>

                                                        <div class=" col-md-2 ">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor" id="aspirante_anio_nacimiento_registro"  name="aspirante_anio_nacimiento_registro" onclick="get_dias_registro()">

                                                            </select>
                                                            <span>Año</span>
                                                        </label>
                                                        </div>
                                                        <div class="col-md-2">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor" id="aspirante_mes_nacimiento_registro"  name="aspirante_mes_nacimiento_registro" onclick="get_dias_registro()">
                                                            <option value="">Seleccione uno</option>
                                                            <option value="01">Enero</option>
                                                        <option value="02">Febrero</option>
                                                        <option value="03">Marzo</option>
                                                        <option value="04">Abril</option>
                                                        <option value="05">Mayo</option>
                                                        <option value="06">Junio</option>
                                                        <option value="07">Julio</option>
                                                        <option value="08">Agosto</option>
                                                        <option value="09">Septiembre</option>
                                                        <option value="10">Octubre</option>
                                                        <option value="11">Noviembre</option>
                                                        <option value="12">Diciembre</option>
                                                            </select>
                                                            <span>Mes</span>
                                                        </label>
                                                        </div>
                                                        <div class="col-md-2 ">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor" id="aspirante_dia_nacimiento_registro"  name="aspirante_dia_nacimiento_registro" onchange="validaracta_preinscripcion()">

                                                            </select>
                                                            <span>Día</span>
                                                        </label>
                                                        </div>


                                                    </div>

                                                    </div>

                                                    <!--direccion------------------------------------------------------>
                                                    <p class="text-center text-white rounded titulo-form h4">Dirección actual del Aspirante</p>
                                                    <hr>


                                                    <div class="form-group">

                                                    <div class="row">

                                                        <div class="col-md-4">
                                                        <label class="form-group has-float-label seltitulo">
                                                            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_estado" required
                                                            onChange="cambio_estado(selector_estado_aspirante,selector_municipio_aspirante,selector_localidad_aspirante)"
                                                            id="selector_estado_aspirante" title="Seleccione el estado">
                                                            <option value="">Seleccione el estado</option>

                                                            <?php
                                                                            foreach ($estados as $estado)
                                                                            {
                                                                                    echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                                                                            }
                                                                            ?>



                                                            </select>
                                                            <span>Estado</span>
                                                        </label>
                                                        </div>


                                                        <div class="col-md-4">
                                                        <label class="form-group has-float-label seltitulo" >
                                                            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_municipio" required
                                                            onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)"
                                                            id="selector_municipio_aspirante" title="Seleccione el municipio">
                                                            <option value="">Seleccione un municipio</option>

                                                            </select>
                                                            <span>Municipio</span>
                                                        </label>

                                                        </div>

                                                        <div class="col-md-4">
                                                        <label class="form-group has-float-label seltitulo" >
                                                            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_localidad" required
                                                            id="selector_localidad_aspirante" title="Seleccione la localidad">
                                                            <option value="">Seleccione una localidad</option>


                                                            </select>
                                                            <span>Localidad</span>
                                                        </label>
                                                        </div>
                                                    </div>

                                                    </div>



                                                    <div class="form-group">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        <div class="form-label-group">
                                                            <input type="text" 
                                                            title="La direccion tiene caracteres incorrectos"  class="form-control text-uppercase" 
                                                            id="aspirante_direccion_calle" name="aspirante_direccion_calle" 
                                                            placeholder="Calle y número" style="color: #237087 ">
                                                            <label for="aspirante_direccion_calle">Calle y número</label>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <div class="form-label-group">
                                                            <input type="text"  title="La colonia tiene caracteres incorrectos"
                                                            class="form-control text-uppercase" id="aspirante_direccion_colonia"
                                                            name="aspirante_direccion_colonia" placeholder="Colonia/Sección/Paraje/Barrio" style="color: #237087 ">
                                                            <label for="aspirante_direccion_colonia">Colonia/Sección/Paraje/Barrio</label>
                                                        </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                        <div class="form-label-group">
                                                            <input type="number" pattern="[0-9]{5}" title="El código postal solo debe contener 5 dígitos"
                                                            class="form-control text-uppercase" id="aspirante_direccion_cp" name="aspirante_direccion_cp"
                                                            placeholder="Código Postal" style="color: #237087 ">
                                                            <label for="aspirante_direccion_cp">Código Postal</label>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    </div>

                                                <!--fin direccion------------------------------------------------------>
                                                <!--direccion procedencia------------------------------------------------------>
                                                <p class="text-center text-white rounded titulo-form h4">Dirección de procedencia del Aspirante</p>
                                                <hr>

                                                <div class="form_group">
                                                <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-group has-float-label seltitulo">
                                                        <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_combo" required
                                                        id="aspirante_procedencia_combo" onchange="procedencia_combo();" title="Seleccione el lugar de procedencia">
                                                        <option value="">Seleccione una</option>
                                                        <option value="igual">Dirección de procedencia igual a direccion actual</option>
                                                        <option value="diferente">Dirección de procedencia diferente a direccion actual</option>
                                                        <option value="extranjero">Dirección de procedencia del extranjero</option>

                                                        </select>
                                                        <span>Procedencia</span>
                                                    </label>
                                                    </div>                    
                                                </div>                  
                                            </div>


                                                <div class="form-group">

                                                <div class="row">

                                                    <div class="col-md-4" id="aspirante_procedencia_estado_oculto" style="display:none">
                                                    <label class="form-group has-float-label seltitulo">
                                                        <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_estado" 
                                                        onChange="cambio_estado(aspirante_procedencia_estado,aspirante_procedencia_municipio,aspirante_procedencia_localidad)"
                                                        id="aspirante_procedencia_estado">
                                                        <option value="">Seleccione el estado</option>

                                                        <?php
                                                                        foreach ($estados as $estado)
                                                                        {
                                                                                echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                                                                        }
                                                                        ?>



                                                        </select>
                                                        <span>Estado</span>
                                                    </label>
                                                    </div>


                                                    <div class="col-md-4" id="aspirante_procedencia_municipio_oculto" style="display:none">
                                                    <label class="form-group has-float-label seltitulo" >
                                                        <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_municipio" 
                                                        onChange="cambio_municipio(aspirante_procedencia_municipio,aspirante_procedencia_localidad)"
                                                        id="aspirante_procedencia_municipio">
                                                        <option value="">Seleccione un municipio</option>

                                                        </select>
                                                        <span>Municipio</span>
                                                    </label>

                                                    </div>

                                                    <div class="col-md-4" id="aspirante_procedencia_localidad_oculto" style="display:none">
                                                    <label class="form-group has-float-label seltitulo" >
                                                        <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_localidad" 
                                                        id="aspirante_procedencia_localidad">
                                                        <option value="">Seleccione una localidad</option>


                                                        </select>
                                                        <span>Localidad</span>
                                                    </label>
                                                    </div>

                                                    <div class="col-md-4" id="aspirante_procedencia_extranjero_oculto" style="display:none">
                                                    <div class="form-label-group">
                                                        <input type="text" class="form-control text-uppercase" id="aspirante_procedencia_extranjero" name="aspirante_procedencia_extranjero"
                                                        placeholder="Ingrese la localidad" style="color: #237087 ">
                                                        <label for="aspirante_procedencia_extranjero">Ingrese la localidad</label>
                                                    </div>
                                                    </div>


                                                </div>



                                                </div>

                                            <!--fin direccion procedencia------------------------------------------------------>

                                            <!--datos tutor------------------------------------------------------>
                                        <p class="text-center text-white rounded titulo-form h4">Datos de Tutor</p>
                                        <hr>
                                    
                                        <div class="form-group">
                                    
                                            <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-label-group">
                                                <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required
                                                    title="Introduzca el nombre" class="form-control text-uppercase" id="aspirante_tutor_nombre"
                                                name="aspirante_tutor_nombre" placeholder="Nombre de Tutor" style="color: #237087 ">
                                                <label for="aspirante_tutor_nombre">Nombre de Tutor</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-label-group">
                                                <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required
                                                    title="Introduzca el primer apellido" class="form-control text-uppercase" id="aspirante_tutor_apellido"
                                                    name="aspirante_tutor_apellido" placeholder="Primer Apellido" style="color: #237087 ">
                                                <label for="aspirante_tutor_apellido">Primer Apellido</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-label-group">
                                                <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                                                    class="form-control text-uppercase" id="aspirante_tutor_apellidodos" name="aspirante_tutor_apellidodos"
                                                    placeholder="Segundo Apellido" style="color: #237087 ">
                                                <label for="aspirante_tutor_apellidodos">Segundo Apellido</label>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                    
                                            <div class="col-md-4">
                                                <label class="form-group has-float-label seltitulo">
                                                <select class="form-control form-control-lg selcolor"  id="aspirante_tutor_parentesco" required
                                                    name="aspirante_tutor_parentesco" onchange="parentesco(this)" title="Seleccione el parentesco">
                                                    <option value="">Seleccione</option>
                                                    <option value="PADRE">PADRE</option>
                                                    <option value="MADRE">MADRE</option>
                                                    <option value="HERMANO/A">HERMANO/A</option>
                                                    <option value="TIO">TIO</option>
                                                    <option value="TIA">TIA</option>
                                                    <option value="ABUELO">ABUELO</option>
                                                    <option value="ABUELA">ABUELA</option>
                                                    <option value="otro">OTRO</option>
                                                </select>
                                                <span>Parentesco</span>
                                    
                                                </label>
                                            </div>
                                    
                                            <div class="col-md-4" id="parentescootro" style="display:none;">
                                                <div class="form-label-group">
                                                <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                                                    class="form-control text-uppercase" id="aspirante_tutor_otro" name="aspirante_tutor_otro"
                                                    placeholder="Escriba el parentesco"style="color: #237087 ">
                                                <label for="aspirante_tutor_otro">Escriba el parentesco</label>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                    
                                    
                                    
                                    
                                    
                                            <div class="form-group">
                                    
                                            <div class="row">
                                                <div class="col-md-3">
                                                <div class="form-label-group">
                                                    <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                                                    title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_ocupacion"
                                                    name="aspirante_tutor_ocupacion" placeholder="Ocupación" style="color: #237087 ">
                                                    <label for="aspirante_tutor_ocupacion">Ocupación</label>
                                                </div>
                                                </div>
                                    
                                                <div class="col-md-3">
                                                <div class="form-label-group">
                                                    <input type="number" title="El numero de telefono debe de ser a 13 dígitos con lada"
                                                    class="form-control text-uppercase" id="aspirante_tutor_telefono" name="aspirante_tutor_telefono"
                                                    placeholder="Teléfono particular"style="color: #237087 ">
                                                    <label for="aspirante_tutor_telefono">Teléfono particular</label>
                                                </div>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="form-label-group">
                                                    <input type="number" title="El numero de telefono debe de ser a 13 digitos con lada"
                                                    class="form-control text-uppercase" id="aspirante_tutor_telefono_comunidad" style="color: #237087 "
                                                    name="aspirante_tutor_telefono_comunidad" placeholder="Teléfono de la comunidad">
                                                    <label for="aspirante_tutor_telefono_comunidad">Teléfono de la comunidad</label>
                                                </div>
                                                </div>
                                    
                                    
                                                <div class="col-md-3">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control text-uppercase" id="aspirante_tutor_prospera"
                                                    name="aspirante_tutor_prospera" placeholder="Folio de Prospera" style="color: #237087 ">
                                                    <label for="aspirante_tutor_prospera">Folio de Prospera</label>
                                                </div>
                                                </div>
                                            </div>
                                    
                                                
                                            </div>
                                            <!--fin tutor------------------------------------------------------>
                                            
                                            <!--datos lengua materna------------------------------------------------------>
                                            <p class="text-center text-white rounded titulo-form h4">Datos de lengua materna</p>
                                            <hr>
                                    
                                            <div class="form-group">
                                    
                                            <div class="row">
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" onchange="lenguas_evento(this)"  id="aspirante_lengua_nombre" required
                                                    name="aspirante_lengua_nombre" title="Seleccione la lengua">
                                                    <option value="">Seleccione una lengua</option>
                                    
                                                    <?php
                                                                foreach ($lenguas as $lengua)
                                                                {
                                                                        echo '<option value="'.$lengua->id_lengua.'">'.strtoupper($lengua->nombre_lengua).'</option>';
                                                                }
                                                                ?>
                                                                <option value="otra">OTRA</option>
                                    
                                                    </select>
                                                    <span>Lengua</span>
                                                </label>
                                                </div>
                                    
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" id="aspirante_lengua_lee" name="aspirante_lengua_lee" disabled>
                                                    <option value="0">Nada 0%</option>
                                                    <option value="25">Poco 25%</option>
                                                    <option value="50">Regular 50%</option>
                                                    <option value="75">Bien 75%</option>
                                                    <option value="100">Muy bien 100%</option>
                                                    </select>
                                                    <span>Lee</span>
                                                </label>
                                                </div>
                                    
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" id="aspirante_lengua_habla" name="aspirante_lengua_habla" disabled>
                                                    <option value="0">Nada 0%</option>
                                                    <option value="25">Poco 25%</option>
                                                    <option value="50">Regular 50%</option>
                                                    <option value="75">Bien 75%</option>
                                                    <option value="100">Muy bien 100%</option>
                                                    </select>
                                                    <span>Habla</span>
                                                </label>
                                                </div>
                                    
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" id="aspirante_lengua_escribe" name="aspirante_lengua_escribe" disabled>
                                                    <option value="0">Nada 0%</option>
                                                    <option value="25">Poco 25%</option>
                                                    <option value="50">Regular 50%</option>
                                                    <option value="75">Bien 75%</option>
                                                    <option value="100">Muy bien 100%</option>
                                                    </select>
                                                    <span>Escribe</span>
                                                </label>
                                                </div>
                                    
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" id="aspirante_lengua_entiende" name="aspirante_lengua_entiende"
                                                    disabled>
                                                    <option value="0">Nada 0%</option>
                                                    <option value="25">Poco 25%</option>
                                                    <option value="50">Regular 50%</option>
                                                    <option value="75">Bien 75%</option>
                                                    <option value="100">Muy bien 100%</option>
                                                    </select>
                                                    <span>Entiende</span>
                                                </label>
                                                </div>
                                    
                                    
                                                <div class="col-md-2">
                                                <label class="form-group has-float-label seltitulo">
                                                    <select class="form-control selcolor" id="aspirante_lengua_traduce" name="aspirante_lengua_traduce" disabled>
                                                    <option value="0">Nada 0%</option>
                                                    <option value="25">Poco 25%</option>
                                                    <option value="50">Regular 50%</option>
                                                    <option value="75">Bien 75%</option>
                                                    <option value="100">Muy bien 100%</option>
                                                    </select>
                                                    <span>Traduce</span>
                                                </label>
                                                </div>
                                    
                                    
                                    
                                    
                                            </div>
                                    
                                            <div class="row" id="lengua_oculto" style="display: none">
                                    
                                                <div class="col-md-2"  >
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control text-uppercase" id="aspirante_lengua_oculto"
                                                    name="aspirante_lengua_oculto" placeholder="Agregue lengua" style="color: #237087 ">
                                                    <label for="aspirante_lengua_oculto">Agregue lengua</label>
                                                </div>
                                                </div>
                                                                </div>
                                                                </div>
                                    
                                            <!--fin legua materna------------------------------------------------------>
                                            
                                            
                                            <!-- etnia ------------------------------------------------------------------>
                                            <div class="form-group">
                                            <div class="row">
                                    
                                            <div class="col-md-4"  >
                                                <label class="form-group has-float-label seltitulo">
                                                <select class="form-control form-control-lg selcolor" onchange="etnias_evento(this)"  name="aspirante_etnia" 
                                                    id="aspirante_etnia">
                                                    <option value="">Seleccione la etnia de procedencia</option>
                                                    <?php
                                                                foreach ($lenguas as $lengua)
                                                                {
                                                                        echo '<option value="'.strtoupper($lengua->nombre_lengua).'">'.strtoupper($lengua->nombre_lengua).'</option>';
                                                                }
                                                                ?>
                                                                <option value="otra">OTRA</option>
                                    
                                                </select>
                                                <span>Etnia</span>
                                                </label>
                                            </div>
                                    
                                            <div class="col-md-2" id="etnia_oculto" style="display: none"  >
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control text-uppercase" id="aspirante_etnia_oculto"
                                                    name="aspirante_etnia_oculto" placeholder="Agregue etnia" style="color: #237087 ">
                                                    <label for="aspirante_etnia_oculto">Agregue etnia</label>
                                                </div>
                                                </div>
                                    
                                    
                                        </div>
                                        </div>
                                            <!-- fin etnia --------------------------------------------------------------->
            
                                    <!--datos secundaria------------------------------------------------------>
                                        <p class="text-center text-white rounded titulo-form h4">Datos de Secundaria de procedencia</p>
                                        <hr>
                                
                                        <div class="form-group">
                                
                                        <div class="row">
                                            <div class="col-md-4">
                                            <div class="form-label-group">
                                
                                                <input list="secundarias" class="form-control text-uppercase" id="aspirante_secundaria_cct"
                                                name="aspirante_secundaria_cct" placeholder="Buscar secundaria por CCT" style="color: #237087 ">
                                                <datalist id="secundarias">
                                
                                                <?php
                                                            foreach ($escuela_procedencia as $escuela)
                                                            {
                                                                    echo '<option value="'.$escuela->cct_escuela_procedencia.'">';
                                                            }
                                                            ?>
                                                </datalist>
                                
                                                <label for="aspirante_secundaria_cct">Buscar secundaria por CCT</label>
                                            </div>
                                            <br>
                                            </div>
                                            <div class="col-md-3">
                                            <div class="form-label-group">
                                                <button type="button" class="btn btn-outline-success btn-lg"
                                                onclick="obtener_secundaria(document.getElementById('aspirante_secundaria_cct').value)">
                                                Buscar secundaria
                                                </button>
                                
                                
                                            </div>
                                            <br>
                                            </div>
                                
                                
                                            <div class="col-md-4">
                                            <div class="form-label-group">
                                            <input type="number" step="any" class="form-control text-uppercase" id="promedio_procedencia_secundaria"
                                                name="promedio_procedencia_secundaria" placeholder="Promedio procedencia de Secundaria" style="color: #237087 " disabled>
                                            <label for="promedio_procedencia_secundaria">Promedio de Secundaria</label>
                                            </div>
                                        </div>
                                
                                
                                
                                
                                
                                
                                        </div>
                                
                                        <div class="row">
                                            <div class="col-md-4" style="display: none" id="nombre_secundaria_oculto">
                                            <div class="form-label-group">
                                                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                                                title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                                                id="aspirante_secundaria_nombre" name="aspirante_secundaria_nombre"
                                                placeholder="Nombre de Secundaria" style="color: #237087 ">
                                                <label for="aspirante_secundaria_nombre">Nombre de Secundaria</label>
                                            </div>
                                            <br>
                                            </div>
                                
                                            <div class="col-md-4" style="display: none" id="tipo_subsistema_oculto">
                                            <label class="form-group has-float-label seltitulo">
                                                <select class="form-control form-control-lg selcolor" name="aspirante_secundaria_tipo_subsistema"
                                                id="aspirante_secundaria_tipo_subsistema">
                                                <option value="">Seleccione un tipo</option>
                                                <option value="TELESECUNDARIA">Telesecundaria</option>
                                                <option value="GENERAL">General</option>
                                                <option value="PARTICULAR">Particular</option>
                                                <option value="TÉCNICA">Técnica</option>
                                                <option value="COMUNITARIA">Comunitaria</option>
                                                <option value="OTRO">Otro</option>
                                                </select>
                                                <span>Tipo de Subsistema</span>
                                            </label>
                                            </div>
                                
                                        
                                
                                        </div>
                                
                                        </div>
                                
                                        <!--fin datos secundaria------------------------------------------------------>
                                        <input type="submit" name="next" class="next action-button" value="Siguente paso" />
                                        
                                        </form>
                                        </div> 

                                        
                                        
                                    </fieldset>
                                    <!-- Termina fieldset para datos personales-->

                                    <!-- Empieza fieldset para documentos solicitados-->
                                    <fieldset>
                                        <div class="form-card">

                                        <form id="datos_doc" name="datos_doc">
                                            
                                            <p class="text-center text-white rounded titulo-form h4 ">Documentos Solicitados</p>
                                        <hr>



                                <div class="form-group border border-dark table-secondary">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                        <h6>Documentación</h6>            
                                        </div>
                                    </div>
                        
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                            <h6>Cargar Documentación</h6>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                </div>


                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                            <div class="form-check">
                                                            <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento"
                                                                id="aspirante_documento_acta_nacimiento" value="1" unchecked onchange="check_preinscripcion(this,'file');">
                                                            Acta de Nacimiento
                                                            </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                        
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file" id="file" onchange="validarArchivo(this,'status','status_error','boton')" disabled/><input type="hidden" name="nombre_documento_acta_nacimiento" id="nombre_documento_acta_nacimiento"/><span class="badge badge-primary" id="enlace_acta_nacimiento"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar" value="0" max="100"></progress><span id="status" class="status_upload"></span><span id="status_error" class="status_upload_error"></span> <input  id="boton" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file','aspirante_documento_acta_nacimiento','progressBar','status','status_error','nombre_documento_acta_nacimiento','cct_plantel')" disabled>
                                        </div>
                                        
                                    </div>


                                    
                                    </div>
                                    
                                </div>

                                <div id="id_carta_registro" style="display:none">
                                            <hr>

                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                    <div class="form-check" id="aspirante_documento_carta_extemporaneo_oculto" >
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="aspirante_documento_carta_extemporaneo"
                                                            id="aspirante_documento_carta_extemporaneo" value="7" unchecked onchange="check_preinscripcion(this,'file2');">
                                                            Carta de registro extemporaneo
                                                        </label>
                                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file2" id="file2" onchange="validarArchivo(this,'status2','status_error2','boton2')" disabled/><input type="hidden" name="nombre_documento_carta_extemporaneo" id="nombre_documento_carta_extemporaneo"/><span class="badge badge-primary" id="enlace_carta_extemporaneo"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar2" value="0" max="100"></progress><span id="status2" class="status_upload"></span><span id="status_error2" class="status_upload_error"></span> <input  id="boton2" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file2','aspirante_documento_carta_extemporaneo','progressBar2','status2','status_error2','nombre_documento_carta_extemporaneo','cct_plantel')" disabled>
                                        </div>
                                    </div>


                                    </div>
                                    
                                </div>

                                </div>
                                
                                <hr>

                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                        <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input" name="aspirante_documento_curp"
                                                            id="aspirante_documento_curp" value="2" unchecked onchange="check_preinscripcion(this,'file3');">
                                                            CURP
                                                        </label>
                                                        </div>
                                        </div>
                                    </div>
                        

                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file3" id="file3" onchange="validarArchivo(this,'status3','status_error3','boton3')" disabled/><input type="hidden" name="nombre_documento_curp" id="nombre_documento_curp"/><span class="badge badge-primary" id="enlace_curp"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar3" value="0" max="100"></progress><span id="status3" class="status_upload"></span><span id="status_error3" class="status_upload_error"></span> <input  id="boton3" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file3','aspirante_documento_curp','progressBar3','status3','status_error3','nombre_documento_curp','cct_plantel')" disabled>
                                        </div>
                                    </div>


                                    </div>
                                    
                                </div>

                                <hr>


                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                <div class="form-check">
                                                <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_secundaria"
                                                    id="aspirante_documento_certificado_secundaria" value="3" unchecked onclick="checksecundaria();" onchange="check_preinscripcion(this,'file4');">
                                                Certificado de Secundaria
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file4" id="file4" onchange="validarArchivo(this,'status4','status_error4','boton4')" disabled/><input type="hidden" name="nombre_documento_certificado_secundaria" id="nombre_documento_certificado_secundaria"/><span class="badge badge-primary" id="enlace_certificado_secundaria"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar4" value="0" max="100"></progress><span id="status4" class="status_upload"></span><span id="status_error4" class="status_upload_error"></span> <input  id="boton4" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file4','aspirante_documento_certificado_secundaria','progressBar4','status4','status_error4','nombre_documento_certificado_secundaria','cct_plantel')" disabled>
                                        </div>
                                    </div>


                                    </div>
                                    
                                </div>

                                <hr>


                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="aspirante_documento_fotos"
                                                    id="aspirante_documento_fotos" value="4" unchecked onchange="check_preinscripcion(this,'file5');">
                                                    Fotos
                                                </label>
                                                </div>
                                        </div>
                                    </div>
                        
                                    
                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file5" id="file5" onchange="validarArchivo(this,'status5','status_error5','boton5')" disabled/><input type="hidden" name="nombre_documento_fotos" id="nombre_documento_fotos"/><span class="badge badge-primary" id="enlace_fotos"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar5" value="0" max="100"></progress><span id="status5" class="status_upload"></span><span id="status_error5" class="status_upload_error"></span> <input  id="boton5" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file5','aspirante_documento_fotos','progressBar5','status5','status_error5','nombre_documento_fotos','cct_plantel')" disabled>
                                        </div>
                                    </div>



                                    </div>
                                    
                                </div>

                                <hr>


                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="aspirante_documento_carta_buena_conducta"
                                                    id="aspirante_documento_carta_buena_conducta" value="5" unchecked onchange="check_preinscripcion(this,'file6');">
                                                    Carta de conducta
                                                </label>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file6" id="file6" onchange="validarArchivo(this,'status6','status_error6','boton6')" disabled/><input type="hidden" name="nombre_documento_carta_buena_conducta" id="nombre_documento_carta_buena_conducta"/><span class="badge badge-primary" id="enlace_carta_buena_conducta"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar6" value="0" max="100"></progress><span id="status6" class="status_upload"></span><span id="status_error6" class="status_upload_error"></span> <input  id="boton6" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file6','aspirante_documento_carta_buena_conducta','progressBar6','status6','status_error6','nombre_documento_carta_buena_conducta','cct_plantel')" disabled>
                                        </div>
                                    </div>
                        
                                    

                                    </div>
                                    
                                </div>

                                <hr>


                                <div class="form-group">
                                    
                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-label-group">
                                                <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_medico"
                                                    id="aspirante_documento_certificado_medico" value="6" onchange="check_preinscripcion(this,'file7');" unchecked>
                                                    Certificado Médico
                                                </label>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="form-label-group">
                                                <input type="file" name="file7" id="file7" onchange="validarArchivo(this,'status7','status_error7','boton7')" disabled/><input type="hidden" name="nombre_documento_certificado_medico" id="nombre_documento_certificado_medico"/><span class="badge badge-primary" id="enlace_certificado_medico"></span><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar7" value="0" max="100"></progress><span id="status7" class="status_upload"></span><span id="status_error7" class="status_upload_error"></span> <input  id="boton7" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file7','aspirante_documento_certificado_medico','progressBar7','status7','status_error7','nombre_documento_certificado_medico','cct_plantel')" disabled>
                                        </div>
                                    </div>
                        
                                    

                                    </div>
                                    
                                </div>


                                            

                                <input type="button" name="previous" class="previous action-button-previous" value="Anterior paso" /> <input type="submit" name="next" class="next action-button" value="Guardar cambios" />




                                            


                                        </form>

                                        </div> 
                                        
                                        
                                        
                                        


                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </fieldset>
                                    <!-- Termina fieldset para documentos solicitados-->

                                    <!--
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Payment Information</h2>
                                        </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="make_payment" class="next action-button" value="Confirm" />
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title text-center">Success !</h2> <br><br>
                                            
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5>You Have Successfully Signed Up</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>-->

                                    
                                    
                                    
                                </div><!--TErmina div de formulario paso a paso-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                

        <!-- fin cuerpo modal -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<input type="text" style="display:none" id="no_control_borrar">




<!-- Modal -->
<div class="modal fade" id="nuevasecundaria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar nueva secundaria</h5>
        <button type="button" class="close" onclick="cerrar_modal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                  title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_nuevasecundaria_cct" name="aspirante_nuevasecundaria_cct"
                  placeholder="CCT de Secundaria" style="color: #237087 ">
                <label for="aspirante_nuevasecundaria_cct">C C T</label>
              </div>
              <br>
            </div>
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" ppattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                  class="form-control text-uppercase" id="aspirante_nuevasecundaria_nombre"
                  name="aspirante_secundaria_nombre" placeholder="Nombre de Secundaria" style="color: #237087 ">
                <label for="aspirante_nuevasecundaria_nombre">Nombre de Secundaria</label>
              </div>
              <br>
            </div>

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="aspirante_nuevasecundaria_tipo_subsistema" 
                  id="aspirante_nuevasecundaria_tipo_subsistema" onchange="otro_secundaria();">
                  <option value="">Seleccione un tipo</option>
                  <option value="TELESECUNDARIA">Telesecundaria</option>
                  <option value="GENERAL">General</option>
                  <option value="PARTICULAR">Particular</option>
                  <option value="TÉCNICA">Técnica</option>
                  <option value="COMUNITARIA">Comunitaria</option>
                  <option value="OTRO" >Otro</option>
                </select>
                <span>Tipo de Subsistema</span>
              </label>
            </div>

            <div class="col-md-4" style="display: none" id="otro_secundaria_oculto">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                  title="El tipo de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_secundaria_tipo_otro" name="aspirante_secundaria_tipo_otro"
                  placeholder="Tipo de Secundaria" style="color: #237087 ">
                <label for="aspirante_secundaria_tipo_otro">Tipo de Secundaria</label>
              </div>
            </div>

          </div>
          <br>


          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="selector_estado_secundaria"
                onChange="cambio_estado(document.getElementById('selector_estado_secundaria'),document.getElementById('selector_municipio_secundaria'),document.getElementById('selector_localidad_secundaria'))"
                  id="selector_estado_secundaria">
                  <option value ="">Seleccione un estado</option>

                  <?php
                              foreach ($estados as $estado)
                              {
                                      echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                              }
                              ?>

                </select>
                <span>Estado</span>
              </label>
            </div>


            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="selector_municipio_secundaria"
                  onChange="cambio_municipio(document.getElementById('selector_municipio_secundaria'),document.getElementById('selector_localidad_secundaria'))"
                  id="selector_municipio_secundaria">
                  <option></option>


                </select>
                <span>Municipio</span>
              </label>
            </div>

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="selector_localidad_secundaria"
                  id="selector_localidad_secundaria">
                  <option></option>



                </select>
                <span>Localidad</span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="cerrar_modal()">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="insertar_secundaria()">Guardar</button>
      </div>
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="nuevobachillerato" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Agregar nuevo Bachillerato</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                id="aspirante_nuevobachillerato_cct" name="aspirante_nuevobachillerato_cct" style="color: #237087"
                placeholder="CCT de Bachillerato">
              <label for="aspirante_nuevobachillerato_cct">C C T</label>
            </div>
            <br>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" ppattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                class="form-control text-uppercase" id="aspirante_nuevobachillerato_nombre" style="color: #237087"
                name="aspirante_nuevobachillerato_nombre" placeholder="Nombre de Bachillerato">
              <label for="aspirante_nuevobachillerato_nombre">Nombre de Bachillerato</label>
            </div>
            <br>
          </div>

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="aspirante_nuevobachillerato_tipo_subsistema" 
                  id="aspirante_nuevobachillerato_tipo_subsistema" onchange="otro_secundaria();">
                <option value="">Seleccione un tipo</option>
                <option value="EDUCACIÓN PROFESIONAL TÉCNICA">Educación Profesional Técnica</option>
                <option value="BACHILLERATO GENERAL">Bachillerato General</option>
                <option value="BACHILLERATO TECNOLÓGICO">Bachillerato Tecnológico</option>
                <option value="OTRO">Otro</option>
              </select>
              <span>Tipo de Subsistema</span>
            </label>
          </div>

          <div class="col-md-4" style="display: none" id="otro_secundaria_oculto">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                  title="El tipo de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_secundaria_tipo_otro" name="aspirante_secundaria_tipo_otro"
                  placeholder="Tipo de Bachillerato" style="color: #237087">
                <label for="aspirante_secundaria_tipo_otro">Tipo de Bachillerato</label>
              </div>
            </div>
          

        </div>
        <br>

        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="selector_estado_bachillerato"
              onChange="cambio_estado(document.getElementById('selector_estado_bachillerato'),document.getElementById('selector_municipio_bachillerato'),document.getElementById('selector_localidad_bachillerato'))"
                  id="selector_estado_bachillerato">
                <option>Seleccione un estado</option>

                <?php
                            foreach ($estados as $estado)
                            {
                                    echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                            }
                            ?>

              </select>
              <span>Estado</span>
            </label>
          </div>


          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_bachillerato_municipio"
              onChange="cambio_municipio(document.getElementById('selector_municipio_bachillerato'),document.getElementById('selector_localidad_bachillerato'))"
                  id="selector_municipio_bachillerato">
                <option></option>


              </select>
              <span>Municipio</span>
            </label>
          </div>

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_bachillerato_localidad"
                id="selector_localidad_bachillerato">
                <option></option>



              </select>
              <span>Localidad</span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiar_modal_nueva_bachillerato()">Cancelar</button>
      <button type="button" class="btn btn-success" id="insertarsecundaria" onclick="insertar_bachillerato()">Guardar</button>
    </div>
  </div>
</div>
</div>

<!-- Modal -->


<!-- Empieza modal para eliminar-->
<div class="modal" id="modaleliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h2><strong>Editar datos de Aspirante</strong></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Termina modal para eliminar-->

<script>
cargar_anio_registro();



function elementoid(el) {
      return document.getElementById(el);
    }

function uploadFile(doc, iddoc, cargando, estado, estado_error,nombre_archivo,plantel) {
      var file = elementoid(doc).files[0];

      console.log("archivo: " + doc);

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();

      formdata.append("iddocumento", elementoid(iddoc).value);
      formdata.append("cct_plantel",plantel);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", function progressHandler(event) {
        //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
        var percent = (event.loaded / event.total) * 100;
        elementoid(cargando).value = Math.round(percent);
        elementoid(estado).innerHTML = Math.round(percent) + "% Cargando...espere.";

      }, false);
      ajax.addEventListener("load", function completeHandler(event) {
  
        var dato=JSON.parse(event.target.responseText);
        elementoid(nombre_archivo).value = dato.nombredoc;
        elementoid(estado).innerHTML = dato.status;

        elementoid(cargando).value = 0;

      }, false);
      ajax.addEventListener("error", function errorHandler(event) {
        elementoid(estado_error).innerHTML = "No se subió el archivo, vuelva a intentarlo.";
      }, false);
      ajax.addEventListener("abort", function abortHandler(event) {
        elementoid(estado_error).innerHTML = "Carga de archivo detenida.";
      }, false);
      ajax.open("POST", "<?php echo base_url();?>index.php/C_aspirante_preinscripcion/subir_doc");
      ajax.send(formdata);
      ajax.onloadstart = function(){
        $('#div_carga').show();
      }
      ajax.error = function (){
        console.log("error de conexion");
      }
      ajax.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(ajax.response));

        var datos = JSON.parse(ajax.response);

        if (datos.status_error !== undefined) {
          //elementoid(estado_error).innerHTML = datos.status_error;
        }

        



      };


    }

function validarArchivo(archivo, var_status, var_status_error, var_boton) {
      elementoid(var_status).innerHTML = "";
      elementoid(var_status_error).innerHTML = "";
      var fileName = archivo.files[0].name;
      var fileSize = archivo.files[0].size;
      var es_valido = false;
      //alert('peso '+fileSize+' extensión '+fileName);
      if (fileSize > 2097152) {

        elementoid(var_status_error).innerHTML = "El archivo no debe superar los 2 MB.";
        es_valido = true;

      } else {
        // recuperamos la extensión del archivo y validamos.
        var ext = fileName.split('.').pop();

        // console.log(ext);
        switch (ext) {
          case 'jpg':
          case 'jpeg':
          case 'png':
          case 'pdf': break;
          default:
            es_valido = true;
            elementoid(var_status_error).innerHTML = "Archivo con extensión no permitida.";

        }
      }

      document.getElementById(var_boton).disabled = es_valido;
    }




function check_preinscripcion(campo,campoArchivo ) {
  var opcion=1;
  var checkBox = document.getElementById(campo.name);
  var archivo = document.getElementById(campoArchivo);

  if (checkBox.checked == true) {
        archivo.disabled = false;
      }
      else {
        archivo.disabled = true;
      }






  switch (opcion) {
    case 1:

          if (document.getElementById("aspirante_documento_acta_nacimiento").checked && document.getElementById("aspirante_nacionalidad").value === "MEXICANA") {
            document.getElementById("aspirante_anio_nacimiento_registro").required = true;
            document.getElementById("aspirante_mes_nacimiento_registro").required = true;
            document.getElementById("aspirante_dia_nacimiento_registro").required = true;

          } else {
            document.getElementById("aspirante_anio_nacimiento_registro").required = false;
            document.getElementById("aspirante_mes_nacimiento_registro").required = false;
            document.getElementById("aspirante_dia_nacimiento_registro").required = false;
          }
      
    break;

    case 2:

          

    break;
    default:
      
  }
  
}




function limpiar_modal_nueva_bachillerato() {
  $('#aspirante_nuevobachillerato_cct').val('');
  $('#aspirante_nuevobachillerato_nombre').val('');
  $('#aspirante_nuevobachillerato_tipo_subsistema').val('');
  $('#aspirante_secundaria_tipo_otro').val('');
  $('#selector_estado_bachillerato').val('');
  $('#aspirante_bachillerato_municipio').val('');
  $('#aspirante_bachillerato_localidad').val('');
}

function cerrar_modal_bachillerato() {
  $('#aspirante_nuevobachillerato_cct').val('');
  $('#aspirante_nuevobachillerato_nombre').val('');
  $('#aspirante_nuevobachillerato_tipo_subsistema').val('');
  $('#aspirante_secundaria_tipo_otro').val('');
  $('#selector_estado_bachillerato').val('');
  $('#aspirante_bachillerato_municipio').val('');
  $('#aspirante_bachillerato_localidad').val('');
    
    $('#modalaspirante').modal().show();
    $('#nuevobachillerato').modal('toggle');
  }

function cerrar_modal() {
    $('#aspirante_nuevasecundaria_cct').val('');
    $('#aspirante_nuevasecundaria_nombre').val('');
    $('#aspirante_nuevasecundaria_tipo_subsistema').val('');
    $('#selector_estado_secundaria').val('');
    $('#selector_municipio_secundaria').val('');
    $('#selector_localidad_secundaria').val('');

    $('#modalaspirante').modal().show();
    $('#nuevasecundaria').modal('toggle');
  }


function insertar_bachillerato() {
  if(document.getElementById("aspirante_nuevobachillerato_cct").value === ''||document.getElementById("aspirante_nuevobachillerato_nombre").value === ''||document.getElementById("aspirante_nuevobachillerato_tipo_subsistema").value===''){
    Swal.fire({
          type: 'error',
          title: 'Bachillerato no agregado',
          confirmButtonText: 'Cerrar'

        })
  }else{

  let secundaria = "";
  secundaria = {
    "cct_escuela_procedencia": document.getElementById("aspirante_nuevobachillerato_cct").value.toUpperCase(),
    "nombre_escuela_procedencia": document.getElementById("aspirante_nuevobachillerato_nombre").value,
    "tipo_subsistema": document.getElementById("aspirante_nuevobachillerato_tipo_subsistema").value,
    "id_localidad_escuela_procedencia": parseInt(document.getElementById("selector_localidad_bachillerato").value),
    "tipo_escuela_procedencia": "BACHILLERATO"
  };

  document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevobachillerato_cct").value + '">'
  //console.log(secundaria);
  var xhr = new XMLHttpRequest();
  
  xhr.open("POST", '<?php echo base_url();?>index.php/c_escuela_procedencia/insert_escuela', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        Swal.fire({
          type: 'success',
          title: 'Bachillerato agregado correctamente',
          showConfirmButton: false,
          timer: 2500
        })
        $('#nuevobachillerato').modal('toggle');
        obtener_bachillerato(document.getElementById("aspirante_bachillerato_cct").value);
      } else {
        Swal.fire({
          type: 'error',
          title: 'Bachillerato no agregado',
          confirmButtonText: 'Cerrar'

        })
      }

    }
  }
  xhr.send(JSON.stringify(secundaria));

  }
}

function validaracta(){
  var fechaInicio = document.getElementById("aspirante_anio_nacimiento").value+"," +document.getElementById("aspirante_mes_nacimiento").value;
  if(document.getElementById("aspirante_dia_nacimiento").value.length =! 1){
  fechaInicio = fechaInicio + "," + document.getElementById("aspirante_dia_nacimiento").value
  }else{
    fechaInicio = fechaInicio + "," + 0 + document.getElementById("aspirante_dia_nacimiento").value
  }
  var fechaFin = document.getElementById("aspirante_anio_nacimiento_registro").value + "," +document.getElementById("aspirante_mes_nacimiento_registro").value;
  if(document.getElementById("aspirante_dia_nacimiento_registro").value.length =! 1){
  fechaFin = fechaFin + "," + document.getElementById("aspirante_dia_nacimiento_registro").value
  }else{
    fechaFin = fechaFin + "," + 0 + document.getElementById("aspirante_dia_nacimiento_registro").value
  }
  fechaInicio=new Date(fechaInicio).getTime();
fechaFin = new Date(fechaFin).getTime();

var diff = fechaFin - fechaInicio;
var resultado = diff/(1000*60*60*24);
if(resultado > 2193 && document.getElementById("aspirante_nacionalidad").value === "MEXICANA"){
console.log("Necesita acta de registro extemporaneo");

document.getElementById("necesita_carta_extemporaneo").value="si";

}else{
  console.log("No Necesita acta de registro extemporaneo");

  document.getElementById("necesita_carta_extemporaneo").value="no";

}

console.log(diff/(1000*60*60*24) );
}

function limpiar_modal_nueva_secundaria() {
  $('#aspirante_nuevasecundaria_cct').val('');
  $('#aspirante_nuevasecundaria_nombre').val('');
  $('#aspirante_nuevasecundaria_tipo_subsistema').val('');
  $('#selector_estado_secundaria').val('');
  $('#selector_municipio_secundaria').val('');
  $('#selector_localidad_secundaria').val('');
}


var ini_secundaria_cct = "";
var ini_bachillerato_cct = "";
$("#aspirante_secundaria_cct").change(function(){

  if ( $("#aspirante_secundaria_cct").val().toUpperCase() != ini_secundaria_cct ) {
    obtener_secundaria($("#aspirante_secundaria_cct").val().toUpperCase());
  }
});

function insertar_secundaria() {
    if(document.getElementById("aspirante_nuevasecundaria_cct").value === ''||document.getElementById("aspirante_nuevasecundaria_nombre").value === ''||document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value===''){
    Swal.fire({
          type: 'error',
          title: 'Bachillerato no agregado',
          confirmButtonText: 'Cerrar'

        })
   }else{
    let secundaria = "";
    secundaria = {
      "cct_escuela_procedencia": document.getElementById("aspirante_nuevasecundaria_cct").value.toUpperCase(),
      "nombre_escuela_procedencia": document.getElementById("aspirante_nuevasecundaria_nombre").value.toUpperCase(),
      "tipo_subsistema": document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value.toUpperCase(),
      "id_localidad_escuela_procedencia": parseInt(document.getElementById("selector_localidad_secundaria").value),
      "tipo_escuela_procedencia": "SECUNDARIA"
    };

    document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevasecundaria_cct").value + '">'
    //console.log(secundaria);
    var xhr = new XMLHttpRequest();
    
    xhr.open("POST", '<?php echo base_url();?>index.php/c_escuela_procedencia/insert_escuela', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            title: 'Secundaria agregada correctamente',
            showConfirmButton: false,
            timer: 2500
          })
          $('#nuevasecundaria').modal('toggle');

          

          $('#aspirante_nuevasecundaria_cct').val('');
          $('#aspirante_nuevasecundaria_nombre').val('');
          $('#aspirante_nuevasecundaria_tipo_subsistema').val('');
          $('#selector_estado_secundaria').val('');
          $('#selector_municipio_secundaria').val('');
          $('#selector_localidad_secundaria').val('');

          obtener_secundaria(document.getElementById("aspirante_secundaria_cct").value);
         
        } else {
          Swal.fire({
            type: 'error',
            title: 'Secundaria no agregada',
            confirmButtonText: 'Cerrar'

          })
        }

      }
    }
    xhr.send(JSON.stringify(secundaria));

  }

}




  cargar_anio();

  function cargar_datos_aspirante(e) {
    ini_secundaria_cct = "";
    ini_bachillerato_cct="";

    
    $(".previous").trigger("click");
    document.getElementById("nombre_secundaria_oculto").style.display = "none";
    document.getElementById("tipo_subsistema_oculto").style.display = "none";
    document.getElementById("promedio_procedencia_secundaria").disabled = true;
    document.getElementById("datos_alumno").reset();
    document.getElementById("datos_doc").reset();

    document.getElementById("selector_municipio_aspirante").innerHTML = "";
    document.getElementById("selector_localidad_aspirante").innerHTML = "";
    document.getElementById("aspirante_no_control").value = e.value;
    document.getElementById("aspirante_alergia").value = "";
    document.getElementById("aspirante_discapacidad").value = "";
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/get_aspirante?no_control=' + e.value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      $('#modalaspirante').modal().show();
      let datos = JSON.parse(xhr.response);
      console.log(datos);
      document.getElementById("aspirante_no_control").value = datos.estudiante[0].no_control;
      document.getElementById("id_tutor").value = datos.tutor[0].id_tutor;
      //datos personales
      document.getElementById("aspirante_nombre").value = datos.estudiante[0].nombre;
      document.getElementById("aspirante_apellido_paterno").value = datos.estudiante[0].primer_apellido;
      document.getElementById("aspirante_apellido_materno").value = datos.estudiante[0].segundo_apellido;
      document.getElementById("aspirante_curp").value = datos.estudiante[0].curp;
      document.getElementById("selector_estado_nacimiento_aspirante").value = datos.estudiante[1].id_estado_nacimiento;
      

      var anio = datos.estudiante[0].fecha_nacimiento.split("-")[0];
      var mes = datos.estudiante[0].fecha_nacimiento.split("-")[1];
      var dia = parseInt(datos.estudiante[0].fecha_nacimiento.split("-")[2]);
      dia = dia.toString();

      //datos registro fecha registro acta
      if(datos.estudiante[0].fecha_registro_nacimiento!=null){

      var anio_registro = datos.estudiante[0].fecha_registro_nacimiento.split("-")[0];
      var mes_registro = datos.estudiante[0].fecha_registro_nacimiento.split("-")[1];
      var dia_registro = parseInt(datos.estudiante[0].fecha_registro_nacimiento.split("-")[2]);
      dia_registro= dia_registro.toString();

      
      document.getElementById("aspirante_anio_nacimiento_registro").value = anio_registro;
      document.getElementById("aspirante_mes_nacimiento_registro").value = mes_registro;
      document.getElementById("aspirante_dia_nacimiento_registro").value =dia_registro;
      }

      //Fin datos registro fecha registro acta

      //console.log(anio,mes,dia.toString());
      //$('#aspirante_anio_nacimiento option[value="'+anio+'"]')
      document.getElementById("aspirante_anio_nacimiento").value = anio;
      document.getElementById("aspirante_mes_nacimiento").value = mes;
      document.getElementById("aspirante_dia_nacimiento").value = dia;
      //document.getElementById("aspirante_fecha_nacimiento").value = datos.estudiante[0].fecha_nacimiento;
      //-----------------------------------------
      document.getElementById("aspirante_telefono").value = datos.estudiante[0].telefono;
      document.getElementById("aspirante_correo").value = datos.estudiante[0].correo;
      document.getElementById("aspirante_sexo").value = datos.estudiante[0].sexo;
      document.getElementById("aspirante_lugar_nacimiento").value = datos.estudiante[0].lugar_nacimiento;
      document.getElementById("aspirante_nacionalidad").value = datos.estudiante[0].nacionalidad;
      //console.log(datos.expediente_medico);
      document.getElementById("tipo_sangre").value = datos.expediente_medico[2].valor;
      if (datos.expediente_medico[0].valor === "") {
        document.getElementById("aspirante_alergia_combo").value = "2";
        document.getElementById("a").style.display = "none";
      }
      //datos.datos_medicos_aspirante[0].alergia_medicamento === null
      else {
        document.getElementById("aspirante_alergia_combo").value = "1";
        document.getElementById("aspirante_alergia").value = datos.expediente_medico[0].valor;
        document.getElementById("a").style.display = "";
      }
      if (datos.expediente_medico[1].valor === "") {
        document.getElementById("aspirante_discapacidad_combo").value = "2";
        document.getElementById("b").style.display = "none";
      }
      else {
        document.getElementById("aspirante_discapacidad_combo").value = "1";
        document.getElementById("aspirante_discapacidad").value = datos.expediente_medico[1].valor;
        document.getElementById("b").style.display = "";
      }
      document.getElementById("aspirante_plantel").value = datos.estudiante[0].Plantel_cct_plantel;
      document.getElementById("aspirante_semestre").value = datos.estudiante[0].semestre_en_curso;
      //fin datos personales
      //direccion aspirante
      //llamada al api que regresa los ids de la direccion del estudiante
      var respuesta;
      let direccion = new XMLHttpRequest();
      direccion.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_estado_municipio_localidad_id_localidad?id_localidad=' + datos.estudiante[0].id_localidad, true);

      direccion.onloadstart = function () {
        $('#div_carga').show();
      }
      direccion.error = function () {
        console.log("error de conexion");
      }
      direccion.onload = function () {
        $('#div_carga').hide();
        var respuesta = JSON.parse(direccion.response);
        //cargar municipios
        let municipios = new XMLHttpRequest();
        municipios.open('GET', '<?php echo base_url();?>index.php/c_municipio/get_municipios_estado_html?id_estado=' + respuesta[0].id_estado, true);
        municipios.onload = function () {
          document.getElementById("selector_municipio_aspirante").innerHTML = municipios.responseText;
          document.getElementById("selector_municipio_aspirante").value = respuesta[0].id_municipio;
        };
        municipios.send(null);
        //fin cargar municipios
        //cargar localidades

        let localidades = new XMLHttpRequest();
        localidades.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_localidades_municipio_html?id_municipio=' + respuesta[0].id_municipio, true);
        localidades.onload = function () {
          document.getElementById("selector_localidad_aspirante").innerHTML = localidades.responseText;
          //seleccionar las opciones de la direccion del estudiante que habia registrado
          document.getElementById("selector_estado_aspirante").value = respuesta[0].id_estado;
          
          document.getElementById("selector_localidad_aspirante").value = respuesta[0].id_localidad;
        };
        localidades.send(null);

        //fin cargar localidades
      };
      direccion.send(null);

      //Comienza codigo para dirección de procedencia de aspirante
      tipo_procedencia=datos.estudiante[2].procedencia.tipo;

      console.log("tipo procedencia: "+tipo_procedencia);

        switch (tipo_procedencia) {
          case "igual":
            document.getElementById("aspirante_procedencia_combo").value="igual";
            document.getElementById("aspirante_procedencia_estado_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_municipio_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_localidad_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_extranjero_oculto").style.display = "none";
            //Declaraciones ejecutadas cuando el resultado de expresión coincide con el valor

            break;
          case "diferente":
            id_localidad_procedencia=datos.estudiante[2].procedencia.id_localidad;
            //Declaraciones ejecutadas cuando el resultado de expresión coincide con el valor
            document.getElementById("aspirante_procedencia_combo").value="diferente";
            document.getElementById("aspirante_procedencia_estado_oculto").style.display = "";
            document.getElementById("aspirante_procedencia_municipio_oculto").style.display = "";
            document.getElementById("aspirante_procedencia_localidad_oculto").style.display = "";
            document.getElementById("aspirante_procedencia_extranjero_oculto").style.display = "none";
            let direccion_procedencia = new XMLHttpRequest();
            direccion_procedencia.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_estado_municipio_localidad_id_localidad?id_localidad=' +id_localidad_procedencia, true);

            direccion_procedencia.onloadstart = function () {
              
            }
            direccion_procedencia.error = function () {
              console.log("error de conexion");
            }
            direccion_procedencia.onload = function () {
              //$('#div_carga').hide();
              var respuesta_procendencia = JSON.parse(direccion_procedencia.response);
              //cargar municipios
              let municipios = new XMLHttpRequest();
              municipios.open('GET', '<?php echo base_url();?>index.php/c_municipio/get_municipios_estado_html?id_estado=' + respuesta_procendencia[0].id_estado, true);
              municipios.onload = function () {
                document.getElementById("aspirante_procedencia_municipio").innerHTML = municipios.responseText;
                document.getElementById("aspirante_procedencia_municipio").value = respuesta_procendencia[0].id_municipio;
              };
              municipios.send(null);
              //fin cargar municipios
              //cargar localidades

              let localidades = new XMLHttpRequest();
              localidades.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_localidades_municipio_html?id_municipio=' + respuesta_procendencia[0].id_municipio, true);
              localidades.onload = function () {
                document.getElementById("aspirante_procedencia_localidad").innerHTML = localidades.responseText;
                //seleccionar las opciones de la direccion del estudiante que habia registrado
                document.getElementById("aspirante_procedencia_estado").value = respuesta_procendencia[0].id_estado;
                
                document.getElementById("aspirante_procedencia_localidad").value = respuesta_procendencia[0].id_localidad;
              };
              localidades.send(null);

              //fin cargar localidades
            };
            direccion_procedencia.send(null);


            break;
          case "extranjero":
            //Declaraciones ejecutadas cuando el resultado de expresión coincide con valor
            document.getElementById("aspirante_procedencia_combo").value="extranjero";
            document.getElementById("aspirante_procedencia_estado_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_municipio_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_localidad_oculto").style.display = "none";
            document.getElementById("aspirante_procedencia_extranjero_oculto").style.display = "";
            document.getElementById("aspirante_procedencia_extranjero").value = datos.estudiante[2].procedencia.localidad;
            break;
          default:
            //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
            break;
        }

      //TErmina codigo para dirección de procedencia de aspirante

      document.getElementById("aspirante_direccion_calle").value = datos.estudiante[0].calle;
      document.getElementById("aspirante_direccion_colonia").value = datos.estudiante[0].colonia;
      document.getElementById("aspirante_direccion_cp").value = datos.estudiante[0].cp;
      //fin direccion aspirante
      //datos tutor
      document.getElementById("aspirante_tutor_nombre").value = datos.tutor[0].nombre_tutor;
      document.getElementById("aspirante_tutor_apellido").value = datos.tutor[0].primer_apellido_tutor;
      document.getElementById("aspirante_tutor_apellidodos").value = datos.tutor[0].segundo_apellido_tutor;
      document.getElementById("aspirante_tutor_ocupacion").value = datos.tutor[0].ocupacion;
      //document.getElementById("aspirante_tutor_telefono").value = datos.tutor[0].telefono_tutor;
      document.getElementById("aspirante_tutor_telefono_comunidad").value = datos.tutor[0].telefono_comunidad;
      document.getElementById("aspirante_tutor_telefono").value=datos.tutor[0].telefono_tutor;
      document.getElementById("aspirante_tutor_prospera").value = datos.tutor[0].folio_programa_social_tutor;
      $parentesco = datos.tutor[0].parentesco;
      if ($parentesco !== "PADRE" && $parentesco !== "MADRE" && $parentesco !== "HERMANO/A" && $parentesco !== "TIO" && $parentesco !== "TIA" && $parentesco !== "ABUELO" && $parentesco !== "ABUELA") {
        document.getElementById("aspirante_tutor_parentesco").value = "otro";
        document.getElementById("aspirante_tutor_otro").value = $parentesco;
        document.getElementById("parentescootro").style.display = "";
      }
      else {
        document.getElementById("aspirante_tutor_parentesco").value = $parentesco;
        document.getElementById("aspirante_tutor_otro").value = "";
        document.getElementById("parentescootro").style.display = "none";
      }
      //fin datos tutor
      //datos lengua materna
      if (datos.lengua_materna[0].id_lengua === "0") {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").value = 0;
        document.getElementById("aspirante_lengua_habla").value = 0;
        document.getElementById("aspirante_lengua_escribe").value = 0;
        document.getElementById("aspirante_lengua_entiende").value = 0;
        document.getElementById("aspirante_lengua_traduce").value = 0;
      }
      else {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").disabled = false;
        document.getElementById("aspirante_lengua_lee").value = datos.lengua_materna[0].porcentaje;
        document.getElementById("aspirante_lengua_habla").disabled = false;
        document.getElementById("aspirante_lengua_habla").value = datos.lengua_materna[1].porcentaje;
        document.getElementById("aspirante_lengua_escribe").disabled = false;
        document.getElementById("aspirante_lengua_escribe").value = datos.lengua_materna[2].porcentaje;
        document.getElementById("aspirante_lengua_entiende").disabled = false;
        document.getElementById("aspirante_lengua_entiende").value = datos.lengua_materna[3].porcentaje;
        document.getElementById("aspirante_lengua_traduce").disabled = false;
        document.getElementById("aspirante_lengua_traduce").value = datos.lengua_materna[4].porcentaje;
      }

      document.getElementById("aspirante_etnia").value=datos.estudiante[0].etnia;
      //fin datos lengua materna
      //secundaria
      if (datos.estudiante[0].semestre_ingreso >1) {
        document.getElementById("bachillerato_oculto").style.display = "";
        cct_secundaria=datos.escuela_procedencia[0];

        if (typeof cct_secundaria !== 'undefined') {
              document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;
            $validar_cct=datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;

            if($validar_cct.length>0){
              document.getElementById("promedio_procedencia_secundaria").disabled = false;
            }
            document.getElementById("promedio_procedencia_secundaria").value = datos.escuela_procedencia[0].promedio_procedencia;
            ini_secundaria_cct = $("#aspirante_secundaria_cct").val();

        }

        cct_bachillerato=datos.escuela_procedencia[1];
        if (typeof cct_bachillerato !== 'undefined') { // devuelve true
          //se ejecutan estas instrucciones
          document.getElementById("aspirante_bachillerato_cct").value = datos.escuela_procedencia[1].Escuela_procedencia_cct_escuela_procedencia;
          ini_bachillerato_cct=$("#aspirante_bachillerato_cct").val();

        }

        

      } else {
        //document.getElementById("bachillerato_oculto").style.display = "none";
        document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;

        $validar_cct=datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;

        if($validar_cct.length>0){
          document.getElementById("promedio_procedencia_secundaria").disabled = false;
          document.getElementById("nombre_secundaria_oculto").style.display = "";
          document.getElementById("tipo_subsistema_oculto").style.display = "";
          obtener_secundaria(document.getElementById("aspirante_secundaria_cct").value);
          
        }
        document.getElementById("promedio_procedencia_secundaria").value = datos.escuela_procedencia[0].promedio_procedencia;

        ini_secundaria_cct = $("#aspirante_secundaria_cct").val();
        
      }

      for(x=0;x<datos.documentacion.length;x++){
          id_documento= parseInt(datos.documentacion[x].id_documento);
          id= parseInt(datos.documentacion[x].id_documentacion);
          ruta=datos.documentacion[x].ruta;

          
          
          switch (id_documento) {
          case 1:
            if(ruta!= null){
              document.getElementById("enlace_acta_nacimiento").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
              document.getElementById("aspirante_documento_acta_nacimiento").checked = true;
              document.getElementById("nombre_documento_acta_nacimiento").value=ruta;
              
            }
            else{
              document.getElementById("enlace_acta_nacimiento").innerHTML = '';
              document.getElementById("aspirante_documento_acta_nacimiento").checked = false;
              document.getElementById("nombre_documento_acta_nacimiento").value="";

            }
          
          break;

          case 2:
              if(ruta!= null){
                document.getElementById("enlace_curp").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
                document.getElementById("aspirante_documento_curp").checked = true;
                document.getElementById("nombre_documento_curp").value=ruta;
              }
              else{
                document.getElementById("enlace_curp").innerHTML = '';
                document.getElementById("aspirante_documento_curp").checked = false;
                document.getElementById("nombre_documento_curp").value="";

              }
          break;

          case 8:
            if(ruta!= null){
              document.getElementById("enlace_carta_extemporaneo").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
              document.getElementById("aspirante_documento_carta_extemporaneo").checked = true;
              document.getElementById("nombre_documento_carta_extemporaneo").value=ruta;
            }
            else{
              document.getElementById("enlace_carta_extemporaneo").innerHTML = '';
              document.getElementById("aspirante_documento_carta_extemporaneo").checked = false;
              document.getElementById("nombre_documento_carta_extemporaneo").value="";

            }
          break;

          case 3:
            if(ruta!= null){
              document.getElementById("enlace_certificado_secundaria").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
              document.getElementById("aspirante_documento_certificado_secundaria").checked = true;
              document.getElementById("nombre_documento_certificado_secundaria").value=ruta;
            }
            else{
              document.getElementById("enlace_certificado_secundaria").innerHTML = '';
              document.getElementById("aspirante_documento_certificado_secundaria").checked = false;
              document.getElementById("nombre_documento_certificado_secundaria").value="";

            }
          break;

          case 4:
            if(ruta!= null){
              document.getElementById("enlace_fotos").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
              document.getElementById("aspirante_documento_fotos").checked = true;
              document.getElementById("nombre_documento_fotos").value=ruta;
            }
            else{
              document.getElementById("enlace_fotos").innerHTML = '';
              document.getElementById("aspirante_documento_fotos").checked = false;
              document.getElementById("nombre_documento_fotos").value="";

            }
          break;

          case 102:
          if(ruta!= null){
            document.getElementById("enlace_carta_buena_conducta").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
            document.getElementById("aspirante_documento_carta_buena_conducta").checked = true;
            document.getElementById("nombre_documento_carta_buena_conducta").value=ruta;
          }
          else{
            document.getElementById("enlace_carta_buena_conducta").innerHTML = '';
            document.getElementById("aspirante_documento_carta_buena_conducta").checked = false;
            document.getElementById("nombre_documento_carta_buena_conducta").value="";

          }
          break;

          case 101:
          if(ruta!= null){
            document.getElementById("enlace_certificado_medico").innerHTML = '<a href="<?php echo base_url();?>index.php/C_aspirante_preinscripcion/descargar/'+id+'" class="enlace_descarga">Descargar archivo</a>';
            document.getElementById("aspirante_documento_certificado_medico").checked = true;
            document.getElementById("nombre_documento_certificado_medico").value=ruta;
          }
          else{
            document.getElementById("enlace_certificado_medico").innerHTML = '';
            document.getElementById("aspirante_documento_certificado_medico").checked = false;
            document.getElementById("nombre_documento_certificado_medico").value="";

          }
          break;

          default:
            //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
            break;
        }


      }

     

      
    }
    xhr.send(null);
    
    
    
    
    $('#modalaspirante').modal().show();

  }

  

  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/get_aspirantes_curp_plantel?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        nombre_completo=valor.primer_apellido + " " + valor.segundo_apellido + " " + valor.nombre;
        var fila = '<tr>';
        fila += '<td>';
        fila += nombre_completo;
        fila += '</td>';
        fila += '<td>';
        fila += valor.curp;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.matricula === null ? "" : valor.matricula;
        fila += '</td>';
        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';
        fila += '<td>';
        fila += valor.fecha_registro;
        fila += '</td>';
        fila += '<td>';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" onclick="cargar_datos_aspirante(this)" data-toggle="modal" data-target="#">Editar</button>';
        fila += '</td>';
        fila += '<td>';
        fila += '<button class="btn btn-lg btn-block btn-primary" type="button" value="' + valor.no_control + '" onclick="exportar_aspirante(this,\''+nombre_completo+'\')" data-toggle="modal" data-target="#">Editar</button>';
        fila += '</td>';
        fila += '<?php if ($this->session->userdata("user")["usuario"]!="" && $this->session->userdata("user")["rol"]=="ADMINISTRADOR"){?><td>';
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" onclick="eliminar_permanente(this,\''+nombre_completo+'\')" data-toggle="modal" data-target="#">Eliminar</button>';

        fila += '</td><?php }?>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      formato_tabla();
    };
    xhr.send(null);
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('busqueda_oculto').style.display = "";
  }

  function validar_secundaria(e) {
    return new Promise(function(resolve, reject) {
    var req = new XMLHttpRequest();
        req.open('GET', '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/get_escuela?cct=' + e);

        req.onload = function() {
          if (req.status == 200) {
                //resolve(JSON.parse(req.response));
                let secundaria = JSON.parse(req.response);
                if (secundaria.length == 1) {
                  resolve(1);
                }
          }
          else {
            reject();
          }
        };

        req.send();
    })
  }


  function obtener_secundaria(e) {
   var resultado=0;
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        resultado=1;
        console.log('Hola2: '+resultado);
        document.getElementById("nombre_secundaria_oculto").style.display = "";
        document.getElementById("aspirante_secundaria_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_secundaria_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
        document.getElementById("promedio_procedencia_secundaria").disabled = false;

      }
      else {
        document.getElementById("nombre_secundaria_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Esta secundaria no existe por favor agreguela:',
          showCancelButton: true,
          
          confirmButtonText: 'Agregar',
          cancelButtonText: 'Cancelar',
          
        }).then((result) => {
          if (result.value) {
            
            $('#nuevasecundaria').modal().show();
            limpiar_modal_nueva_secundaria();
            cct();

          }
        })
      }
    };

    xhr.send(null);
    return resultado;
  }

  function obtener_bachillerato(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        document.getElementById("nombre_bachillerato_oculto").style.display = "";
        document.getElementById("aspirante_bachillerato_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_bachillerato_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_bachillerato_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_bachillerato_tipo_subsistema").disabled = true;
        console.log("cct_ bachillerato"+secundaria[0].tipo_subsistema);
      }
      else {
        document.getElementById("nombre_bachillerato_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Este bachillerato no existe por favor agreguela:',
          showCancelButton: true,
          
          confirmButtonText: 'Agregar',
          cancelButtonText: 'Cancelar',
          
        }).then((result) => {
          if (result.value) {
            
            $('#nuevobachillerato').modal().show();
          cctbachillerato();

          }
        })
      }
    };

    xhr.send(null);
  }


  

  //var form = document.getElementById("formulario");



  var nombre_secundaria = document.getElementById('nombre_secundaria_oculto'); 
  var tipo_subsistema = document.getElementById('tipo_subsistema_oculto');
  

  /*form.onsubmit = function (e) {
    e.preventDefault();
    mensaje="";
    if ( $("#aspirante_secundaria_cct").val().toUpperCase() != ini_secundaria_cct && $("#tipo_subsistema_oculto").is(":hidden")) {
    obtener_secundaria($("#aspirante_secundaria_cct").val().toUpperCase());
  }
  else if($("#aspirante_bachillerato_cct").val().toUpperCase() != ini_bachillerato_cct && $("#tipo_subsistema_bachillerato_oculto").is(":hidden")){
    obtener_bachillerato($("#aspirante_bachillerato_cct").val().toUpperCase());
  }
  else{
      if (document.getElementById("aspirante_secundaria_cct").value === '' || document.getElementById("aspirante_bachillerato_cct").value === '') {
        
        if (document.getElementById("aspirante_secundaria_cct").value === ''){
          mensaje+="<p style='text-align:left;margin-left:30%'>-Secundaria.</p>";
        }

        if (document.getElementById("aspirante_bachillerato_cct").value === '' && document.getElementById("bachillerato_oculto").style.display == ""){
          mensaje+="<p style='text-align:left;margin-left:30%'>-Bachillerato.<p>";
          
        }
        
       

        if(mensaje!=''){
        console.log("vacio");
        swalWithBootstrapButtons.fire({
          type: 'warning',
          html: '<p>Esta tratando de actualizar un alumno sin: </p>'+mensaje,
          showCancelButton: true,
          confirmButtonText: 'Actualizar',
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            console.log("Entro a if")
            e.preventDefault();
            envioform(form);

          }
        })
        return false;
        }
        else {
            e.preventDefault();
            envioform(form);
          }
            
      } 

      else {
            e.preventDefault();
            envioform(form);
          }

 }


  }*/



  function envioform(form) {
    $('#modalaspirante').modal('toggle');
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/update_estudiante", true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            title: 'Actualizacion exitosa'
          });

        }
        else {
          Swal.fire({
            type: 'error',
            text: 'Ocurrio un error al actualizar los datos'
          });
          $('#modalaspirante').modal().show();
        }
      }
    }
    xhr.send(formdata);

  }


  

  function cerrar_modal() {
    $('#aspirante_nuevasecundaria_cct').val('');
    $('#aspirante_nuevasecundaria_nombre').val('');
    $('#aspirante_nuevasecundaria_tipo_subsistema').val('');
    $('#selector_estado_secundaria').val('');
    $('#selector_municipio_secundaria').val('');
    $('#selector_localidad_secundaria').val('');

    $('#modalaspirante').modal().show();
    $('#nuevasecundaria').modal('toggle');
  }
/*
delete from Grupo_estudiante where Estudiante_no_control='CSEIIO1910676';
delete from Datos_lengua_materna where Estudiante_no_control='CSEIIO1910676';
delete from Documentacion where Estudiante_no_control='CSEIIO1910676';
delete from Estudiante_escuela_procedencia where Estudiante_no_control='CSEIIO1910676';
delete from Estudiante_tutor where Estudiante_no_control='CSEIIO1910676';
delete from Expediente_medico where Estudiante_no_control='CSEIIO1910676';
delete from Friae_estudiante where Estudiante_no_control='CSEIIO1910676';
delete from Estudiante where no_control='CSEIIO1910676'


*/

function eliminar_permanente(e,nombre_alumno) {
    

  swalWithBootstrapButtons.fire({
          type: 'warning',
          html: '<p>Esta seguro de eliminar los datos de manera permanente de: </p><p style="font-weight: bold;">'+nombre_alumno+'</p><p>Esto ocacionará que sean eliminados sus datos de forma permanente.</p>',
          showCancelButton: true,
          showConfirmButton: true,
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {

                var xhr = new XMLHttpRequest();
                xhr.open("POST", '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/eliminar_bd', true);
                xhr.onloadstart = function () {
                  $('#div_carga').show();
                }
                xhr.error = function () {
                  console.log("error de conexion");
                }
                //Send the proper header information along with the request
                xhr.setRequestHeader("Content-Type", "application/json");

                xhr.onreadystatechange = function () { // Call a function when the state changes.
                  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    $('#div_carga').hide();
                    if (xhr.responseText.trim() === "si") {
                      Swal.fire({
                        type: 'success',
                        title: 'Actualizacion exitosa'
                      });

                      refrescar_tabla();
                      
                    } else {
                      Swal.fire({
                        type: 'error',
                        text: 'Ha ocurrido un error, contacte con el administrador'
                      });
                    }
                  }
                }
                    xhr.send(JSON.stringify({no_control:e.value})); 
            

          }
        })
     

  }


  function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }


</script>

<script>
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parents().eq(2);
next_fs = $(this).parents().eq(2).next();
formulario_actual=$(this).parent().attr('name');
console.log($(this).parent().attr('name'));



$('#'+formulario_actual).validate({
  errorClass: "invalid",
  
		submitHandler: function(form, event){


      if(formulario_actual!='datos_doc'){
          //Add Class Active

          var secundaria_cct=document.getElementById("aspirante_secundaria_cct").value;
          console.log("Tamaño: "+secundaria_cct.length);
          if(secundaria_cct.length>0){
            
            validar_secundaria(secundaria_cct).then(r =>{
              var nombre_secundaria=document.getElementById("aspirante_secundaria_nombre").value;
                    
                    if(nombre_secundaria.length>0 && r==1){

                          $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                          
                          //show the next fieldset
                          next_fs.show();
                          //hide the current fieldset with style
                          current_fs.animate({opacity: 0}, {
                          step: function(now) {
                          // for making fielset appear animation
                          opacity = 1 - now;
                          
                          current_fs.css({
                          'display': 'none',
                          'position': 'relative'
                          });
                          next_fs.css({'opacity': opacity});
                          },
                          duration: 600
                          });

                    }
                        
                      }).catch(() => {
                        //console.log('Algo salió mal');
                        return 0;
                        
                      });

                      
                      
                    
                    
         }
          else{
                  swalWithBootstrapButtons.fire({
                    type: 'warning',
                    text: 'No ha ingresado datos de Secundaria',
                    showCancelButton: true,
                    allowOutsideClick: false,
                    confirmButtonText: 'Registrar',
                    cancelButtonText: 'Cancelar',
                  }).then((result) => {
                    event.preventDefault();
                    if (result.value) {
                      console.log("Entro a if")
                      $('#nuevasecundaria').modal().show();
                      

                    }
                    
                  });
          }

          

      }

      else{
              $.ajax({ 
              url : "<?php echo base_url();?>index.php/C_aspirante_preinscripcion/update_aspirante", 
              type : 'POST', 
              data : $('#datos_alumno, #datos_doc').serialize(),
              beforeSend: function() {
                $('#div_carga').show();
                },
                complete: function(){
                  $('#div_carga').hide();
                },
              success : function(data) { 
                    var datos = JSON.parse(data);
                    console.log(datos);
                    var tipo=datos['respuesta'].tipo;
                          switch (tipo) {
                          case 'exito':
                            Swal.fire({
                              type: 'success',
                              allowOutsideClick: false,
                              title: 'Registro exitoso',
                              html: datos['respuesta'].descripcion,
                              confirmButtonText: "Aceptar"
                            }).then((result) => {
                              if (result.value) {
                                
                                
                                
                                

                              }
                              //aqui va si 
                            });
                            $('#modalaspirante').modal('toggle');
                            refrescar_tabla();

                            break;
                          case 'error':

                                Swal.fire({
                                  type: 'error',
                                  title: 'Error al ingresar datos',
                                  html:'<p style="text-align:left;margin-left:5%;font-weight: bold;">Verifique lo siguiente:</p><p style="text-align:left;margin-left:20%">- '+datos['respuesta'].descripcion+'.</p>',
                                  confirmButtonText: "Aceptar",
                                  showConfirmButton: true,
                                  
                                });
                            
                            break;

                          default:
                            console.log('Lo lamentamos');
                        }
                    

              } 
              }); 
      }
			
			return false;
         
		},
		errorPlacement: function(error, element) {
      
      console.log(element.parents().eq(1).get(0).tagName);
			error.appendTo(element.parents().eq(1).append());

      /*$(".error").css({
        'color': '#FF0000',
        'border-color': '#FF0000'

			});*/
      
      
    }
    
      
	});


});




$(".previous").click(function(){

current_fs = $(this).parents().eq(2);
previous_fs = $(this).parents().eq(2).prev();

console.log(current_fs);
console.log(previous_fs);

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});


$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

/*$(".submit").click(function(){
return false;
});*/

});




function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }


    function exportar_aspirante(e,nombre_alumno) {
    

    swalWithBootstrapButtons.fire({
            type: 'warning',
            html: '<p>Esta seguro de exportar los datos de: </p><p style="font-weight: bold;">'+nombre_alumno+'</p>',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Cancelar',
          }).then((result) => {
            if (result.value) {
  
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/exportar_id', true);
                  xhr.onloadstart = function () {
                    $('#div_carga').show();
                  }
                  xhr.error = function () {
                    console.log("error de conexion");
                  }
                  //Send the proper header information along with the request
                  xhr.setRequestHeader("Content-Type", "application/json");
  
                  xhr.onreadystatechange = function () { // Call a function when the state changes.
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                      $('#div_carga').hide();
                      if (xhr.responseText.trim() === "si") {
                        Swal.fire({
                          type: 'success',
                          title: 'Actualizacion exitosa'
                        });
  
                        refrescar_tabla();
                        
                      } else {
                        Swal.fire({
                          type: 'error',
                          text: 'Ha ocurrido un error, contacte con el administrador'
                        });
                      }
                    }
                  }
                      xhr.send(JSON.stringify({no_control:e.value})); 
              
  
            }
          })
       
  
    }

</script>


<style type="text/css">

.enlace_descarga{
  color: white;
}


input.invalid, textarea.invalid, select.invalid
{
    /*background-color: #ffdddd;*/
    border-color: #FF0000;
    
}

.invalid{
  color:#FF0000;
}

input.valid, textarea.valid, select.valid
{
    /*background-color: #ffdddd;*/
    border-color: #008000;
    
}




#grad1 {
    background-color: : #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

/*#msform fieldset .form-card {
    text-align: left;
    
}*/

.form-group{
    text-align: left;
    
}

/*#msform input,
#msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0
}*/

#msform .action-button {
    width: 160px;
    background: #1883ba;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
   padding: 10px 5px;
   margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}

#msform .action-button-previous {
    width: 160px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
}

#progressbar #account:before {
  font-family: 'Material Icons';
  content: "person";
}

#progressbar #personal:before {
  font-family: 'Material Icons';
  content: "folder";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}
</style>


