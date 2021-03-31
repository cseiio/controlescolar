<div id="content-wrapper">

  <div class="container-fluid">

<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Inscripción en línea</strong></h2>
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
                                  <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                      <a>Nueva Preinscripción</a>
                                    </li>
                                    <li class="breadcrumb-item active">Rellene todos los campos</li>
                                    <div class=" col-md-4 text-right" style="font-weight:bold"> Ciclo escolar:
                                      <?php
                                        echo ($ciclo_escolar[0]->nombre_ciclo_escolar);
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
                                        <input type="file" name="file" id="file" onchange="validarArchivo(this,'status','status_error','boton')" disabled/><input type="hidden" name="nombre_documento_acta_nacimiento" id="nombre_documento_acta_nacimiento"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar" value="0" max="100"></progress><span id="status" class="status_upload"></span><span id="status_error" class="status_upload_error"></span> <input  id="boton" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file','aspirante_documento_acta_nacimiento','progressBar','status','status_error','nombre_documento_acta_nacimiento','cct_plantel')" disabled>
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
                                        <input type="file" name="file2" id="file2" onchange="validarArchivo(this,'status2','status_error2','boton2')" disabled/><input type="hidden" name="nombre_documento_carta_extemporaneo" id="nombre_documento_carta_extemporaneo"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar2" value="0" max="100"></progress><span id="status2" class="status_upload"></span><span id="status_error2" class="status_upload_error"></span> <input  id="boton2" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file2','aspirante_documento_carta_extemporaneo','progressBar2','status2','status_error2','nombre_documento_carta_extemporaneo','cct_plantel')" disabled>
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
                                        <input type="file" name="file3" id="file3" onchange="validarArchivo(this,'status3','status_error3','boton3')" disabled/><input type="hidden" name="nombre_documento_curp" id="nombre_documento_curp"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar3" value="0" max="100"></progress><span id="status3" class="status_upload"></span><span id="status_error3" class="status_upload_error"></span> <input  id="boton3" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file3','aspirante_documento_curp','progressBar3','status3','status_error3','nombre_documento_curp','cct_plantel')" disabled>
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
                                        <input type="file" name="file4" id="file4" onchange="validarArchivo(this,'status4','status_error4','boton4')" disabled/><input type="hidden" name="nombre_documento_certificado_secundaria" id="nombre_documento_certificado_secundaria"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar4" value="0" max="100"></progress><span id="status4" class="status_upload"></span><span id="status_error4" class="status_upload_error"></span> <input  id="boton4" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file4','aspirante_documento_certificado_secundaria','progressBar4','status4','status_error4','nombre_documento_certificado_secundaria','cct_plantel')" disabled>
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
                                        <input type="file" name="file5" id="file5" onchange="validarArchivo(this,'status5','status_error5','boton5')" disabled/><input type="hidden" name="nombre_documento_fotos" id="nombre_documento_fotos"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar5" value="0" max="100"></progress><span id="status5" class="status_upload"></span><span id="status_error5" class="status_upload_error"></span> <input  id="boton5" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file5','aspirante_documento_fotos','progressBar5','status5','status_error5','nombre_documento_fotos','cct_plantel')" disabled>
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
                                        <input type="file" name="file6" id="file6" onchange="validarArchivo(this,'status6','status_error6','boton6')" disabled/><input type="hidden" name="nombre_documento_carta_buena_conducta" id="nombre_documento_carta_buena_conducta"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar6" value="0" max="100"></progress><span id="status6" class="status_upload"></span><span id="status_error6" class="status_upload_error"></span> <input  id="boton6" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file6','aspirante_documento_carta_buena_conducta','progressBar6','status6','status_error6','nombre_documento_carta_buena_conducta','cct_plantel')" disabled>
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
                                        <input type="file" name="file7" id="file7" onchange="validarArchivo(this,'status7','status_error7','boton7')" disabled/><input type="hidden" name="nombre_documento_certificado_medico" id="nombre_documento_certificado_medico"/><br><span class="badge badge-danger">* Subir archivo menor a 2 MB en formato PDF, JPG o PNG.</span><progress id="progressBar7" value="0" max="100"></progress><span id="status7" class="status_upload"></span><span id="status_error7" class="status_upload_error"></span> <input  id="boton7" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile('file7','aspirante_documento_certificado_medico','progressBar7','status7','status_error7','nombre_documento_certificado_medico','cct_plantel')" disabled>
                                </div>
                              </div>
                  
                              

                            </div>
                            
                          </div>


                                    

                          <input type="button" name="previous" class="previous action-button-previous" value="Anterior paso" /> <input type="submit" name="next" class="next action-button" value="Siguiente paso" />




                                    


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


</div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->





<!-- Modal -->
<div class="modal fade" id="nuevasecundaria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar nueva secundaria</h5>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrarmodal()">Cancelar</button>
        <button type="button" class="btn btn-success" onclick="insertar_secundaria()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!--Empieza modal carga-->
<div class="modal" tabindex="-1" role="dialog" id="modal_carga">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
      <div class="text-center">
            <span style='font-size: 18px;font-weight: bold;'>Generando ficha de inscripción...</span>
              <img  class="img-fluid" src="<?php echo base_url();?>assets/img/loading2.gif"/>
        </div>
      </div>

    </div>
  </div>
</div>

<script>




function validaracta_preinscripcion(){
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

        document.getElementById("id_carta_registro").style = "display:";
        document.getElementById("aspirante_documento_carta_extemporaneo").value="8";
        document.getElementById("aspirante_documento_carta_extemporaneo").checked = false;
        }else{
          console.log("No Necesita acta de registro extemporaneo");
          document.getElementById("id_carta_registro").style = "display: none";
          document.getElementById("aspirante_documento_carta_extemporaneo").value="7";
          document.getElementById("aspirante_documento_carta_extemporaneo").checked = true;
        }

        console.log(diff/(1000*60*60*24) );
}

function elementoid(el) {
      return document.getElementById(el);
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



</script>



<script>



  cargar_anio();
  cargar_anio_registro();
  function obtener_secundaria(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/get_escuela?cct=' + e, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);



      if (secundaria.length == 1) {
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
          text: 'Esta secundaria no existe porfavor agreguela:',
          showCancelButton: true,
          confirmButtonText: 'Agregar',
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            $('#nuevasecundaria').modal().show();
            cct();

          }
        })
      }
    };

    xhr.send(null);

  }





  /*function form_aspirante(){
  
     
     alert("Hola mundo");
}*/




 
  /*var form = document.getElementById("msform1");
  form.onsubmit = function (e) {
    if (document.getElementById("aspirante_secundaria_cct").value === '') {
      console.log("vacio");
      swalWithBootstrapButtons.fire({
        type: 'warning',
        text: 'Esta tratando de agregar un alumno sin Secundaria',
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: 'Registrar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.value) {
          console.log("Entro a if")
          e.preventDefault();
          envioform(form);

        }
      })
      return false;
    } else {
      e.preventDefault();
      envioform(form);
    }


  }*/

  function envioform(form) {
    bPreguntar = false;
    var formdata = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/registrar_datos_estudiante", true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
    xhr.onreadystatechange = function () {
      //console.log(xhr.response);
      
      //console.log(xhr.response);
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        console.log(xhr.responseText);
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            allowOutsideClick: false,
            title: 'Registro exitoso',
            confirmButtonText: "Aceptar"
          }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              location.reload();//-----------------------------------------------------------------------------------
            }
            //aqui va si 
          }); 
        }

        else {
          Swal.fire({
            type: 'error',
            title: 'Error al ingresar datos del aspirante',
            html:'<p style="text-align:left;margin-left:5%;font-weight: bold;">Verifique lo siguiente:</p><p style="text-align:left;margin-left:20%">- Pueda ser que La CURP se haya dado de alta con anterioridad.</p><p style="text-align:left;margin-left:20%">- Ha ingresado el CCT de la secundaria de procedencia, pero no ha presionado el botón "Buscar Secundaria."</p><p style="text-align:left;margin-left:20%">- No ha rellenado los campos obligatorios.</p>',
            confirmButtonText: "Aceptar",
            showConfirmButton: true,
            
          });
        }
      }
      
    }
    xhr.send(formdata);

  }

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
    
    xhr.open("POST", '<?php echo base_url();?>index.php/C_aspirante_preinscripcion/insert_escuela', true);
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



/*var bPreguntar = true;
window.onbeforeunload = preguntarAntesDeSalir;
function preguntarAntesDeSalir()
{
  if (bPreguntar)
    return "¿Seguro que quieres salir?";
}*/
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
                    obtener_secundaria(secundaria_cct);
                    var nombre_secundaria=document.getElementById("aspirante_secundaria_nombre").value;

                    if(nombre_secundaria.length>0){

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
              url : "<?php echo base_url();?>index.php/C_aspirante_preinscripcion/agregar_aspirante", 
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
                    //console.log(datos['respuesta'].tipo);
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
                                //aqui va el aceptar
                                imprimir_ficha(datos['respuesta'].id);
                                /*$(document).scrollTop(0);
                                location.reload();//-----------------------------------------------------------------------------------*/
                                
                                

                              }
                              //aqui va si 
                            });

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



function imprimir_ficha(id){

  window.addEventListener('beforeunload', (event) => {
           // event.preventDefault();
           // Google Chrome requires returnValue to be set.
            //event.returnValue = '';
            
            $('#modal_carga').modal({backdrop: 'static', keyboard: false,show:true})
        });

window.open('<?php echo base_url();?>index.php/c_aspirante_preinscripcion/generar_formato_inscripcion?id='+id, '_self');



}



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



</script>

<style type="text/css">
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
    width: 120px;
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
    width: 120px;
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