<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de asesores</a>
      </li>
      <li class="breadcrumb-item active">Seleccione que desea hacer</li>
    </ol>    



    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[0-9]{4}" title="El formato es de 4 dígitos numéricos" class="form-control text-uppercase"
                  id="asesor_num_empleado_busqueda" placeholder="No. de Empleado" style="color: #237087" onblur="ponerCeros(this)">
                <label for="asesor_num_empleado_busqueda">No. de Empleado</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="asesor_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="asesor_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="asesor_plantel_busqueda" name="asesor_plantel_busqueda">
                  

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

        


    <div class="card">
      <div class="card-body">

        
      <div class="row justify-content-end">
        

         <div class="col-2"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal_buscar_importar"
                    id="importar_asesor" onclick="reset_modal_importar()" data-dismiss="modal" disabled>Agregar Asesor</button>
         </div>
  		</div>
<br>

      <table class="table table-hover" id="tabla_completa" style="width: 100%">
          
          <thead class="thead-light">
            <tr>
            
              <th scope="col" class="col-md-1">Nombre Completo</th>
              <th scope="col" class="col-md-1">No. Empleado</th>
              <th scope="col" class="col-md-1">CCT procedencia</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">Puesto de trabajo</th>
              
              <th scope="col" class="col-md-1">Editar</th>
              <th scope="col" class="col-md-1">Eliminar</th>
            </tr>
          </thead>



            <tbody id="tabla_asesor">
                      
                      
            </tbody>
      </table>



      </div>
    </div>


  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<!-- Inicia modal para importar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modal_buscar_importar">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buscar Asesor para Agregar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
      
       <div class="modal-body">

       <form id="buscar_importar_asesor">
       <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
                
          <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[0-9]{4}" title="El formato es de 4 dígitos numéricos" class="form-control text-uppercase"
                  id="asesor_num_empleado_busqueda_importar" placeholder="No. de Empleado" style="color: #237087" name="asesor_num_empleado_busqueda_importar" onblur="ponerCeros(this)">
                <label for="asesor_num_empleado_busqueda_importar">No. de Empleado</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" name="asesor_curp_busqueda_importar" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="asesor_curp_busqueda_importar" placeholder="CURP" style="color: #237087">
                <label for="asesor_curp_busqueda_importar">CURP</label>
              </div>
            </div>
            <div class="col-md-4">
              <button type='submit' class="btn btn-success btn-lg btn-block" id="btn_buscar_importar"
                onclick=''>Buscar</button>
            </div>
          </div>
        </div>        
        
      </div>
    </div>
    </form>

           <table class="table table-hover" id="tabla_completa_importar" style="width: 100%">
          
                      <thead class="thead-light">
                        <tr>
                        
                        <th scope="col" class="col-md-1">Nombre Completo</th>
                        <th scope="col" class="col-md-1">No. de Empleado</th>
              <th scope="col" class="col-md-1">CCT procedencia</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">Puesto de trabajo</th>
              
              <th scope="col" class="col-md-1">Agregar</th>
                        </tr>
                      </thead>



                        <tbody id="tabla_importar">

                                  
                        </tbody>
        </table>

           
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      
    </div>
  </div>
</div>

<!--Termina modal para importar asesor-->

<!-- Inicia modal para agregar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modal_agregar">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Nuevo Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregar_asesor">
      
       <div class="modal-body">

       <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[0-9]{4}" title="El formato es de 4 dígitos numéricos" class="form-control text-uppercase"
                  id="num_empleado_asesor" name="num_empleado_asesor" placeholder="CURP" style="color: #237087" onblur="ponerCeros(this)" required>
                <label for="num_empleado_asesor">No. de Empleado</label>
              </div>
            </div>
          </div>
        </div>
       
       
           <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
                    class="form-control text-uppercase" id="asesor_nombre" name="asesor_nombre"
                    onchange="valida(this)" placeholder="Nombre(s)" style="color: #237087">
                  <label for="asesor_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
                    class="form-control text-uppercase" id="asesor_apellido_paterno" onchange="valida(this)"
                    name="asesor_apellido_paterno" placeholder="Apellido Paterno" style="color: #237087" >
                  <label for="asesor_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="asesor_apellido_materno" onchange="valida(this)"
                    name="asesor_apellido_materno" placeholder="Apellido Materno" style="color: #237087" >
                  <label for="asesor_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row">
            
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                    id="asesor_curp" name="asesor_curp" placeholder="CURP" style="color: #237087" required >
                  <label for="asesor_curp">CURP</label>
                </div>
              </div>

              
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{13}" title="Faltan datos" class="form-control text-uppercase"
                    id="asesor_rfc" name="asesor_rfc" placeholder="RFC" style="color: #237087" required >
                  <label for="asesor_rfc">RFC</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
                    class="form-control text-uppercase" id="asesor_nss" name="asesor_nss"
                    placeholder="Numero de Seguro Social" style="color: #237087 ">
                  <label for="asesor_nss">NSS (IMSS)</label>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">
            <div class="col-md-2">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="asesor_sexo" required name="asesor_sexo">
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <span>Sexo</span>
                </label>
              </div>

            	<div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_puesto"
                  onChange="obtener_categoria_x_puesto()"
                    id="asesor_puesto" required >
                    <option value="">Seleccione el puesto</option>

                          <?php
                            foreach ($puestos_trabajo as $p)
                            {
                              echo '<option value="'.$p->id_puesto.'">'.$p->nombre_puesto.'</option>';
                            }
                            ?>
                  </select>
                  <span>Puesto</span>
                </label>
              </div>
              
              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_categoria" id="asesor_categoria" required >
                    <option value="">Seleccione la categoria</option>
                  </select>
                  <span>Categoría</span>
                </label>
              </div>
          
          </div>
          </div>
          
          <div class="form-group">
            <div class="row">

              <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="date" title="Faltan datos" class="form-control text-uppercase"
                      id="asesor_fecha_ingreso" name="asesor_fecha_ingreso" placeholder="Fecha " style="color: #237087" required >
                    <label for="asesor_fecha_ingreso">Fecha de Ingreso al CSEIIO</label>
                  </div>
                </div>
            	
              
              <div class="col-md-9">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_plantel"
                    onChange=""
                    id="asesor_plantel" required >
                    <option value="">Seleccione el plantel</option>

                    <?php
                      foreach ($planteles as $plantel)
                      {
                        echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>
                  </select>
                  <span>Plantel CCT</span>
                </label>
              </div>
          
          </div>
          </div>
          
          
          
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para agregar asesor-->


<!-- Inicia modal para importar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modal_importar">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importar Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_importar_asesor" method="post">
      <input type="hidden" title="Faltan datos" class="form-control text-uppercase"
                    id="import_id_asesor" name="import_id_asesor">
      
       <div class="modal-body">

       <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[0-9]{4}" title="El formato es de 4 dígitos numéricos" class="form-control text-uppercase"
                  id="import_num_empleado_asesor" name="import_num_empleado_asesor" placeholder="CURP" style="color: #237087" onblur="ponerCeros(this)" required>
                <label for="import_num_empleado_asesor">No. de Empleado</label>
              </div>
            </div>
          </div>
        </div>


       <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
                    class="form-control text-uppercase" id="import_asesor_nombre" name="import_asesor_nombre"
                    onchange="valida(this)" placeholder="Nombre(s)" style="color: #237087">
                  <label for="import_asesor_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
                    class="form-control text-uppercase" id="import_asesor_apellido_paterno" onchange="valida(this)"
                    name="import_asesor_apellido_paterno" placeholder="Apellido Paterno" style="color: #237087" >
                  <label for="import_asesor_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="import_asesor_apellido_materno" onchange="valida(this)"
                    name="import_asesor_apellido_materno" placeholder="Apellido Materno" style="color: #237087" >
                  <label for="import_asesor_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row">
            
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                    id="import_asesor_curp" name="import_asesor_curp" placeholder="CURP" style="color: #237087" required >
                  <label for="import_asesor_curp">CURP</label>
                </div>
              </div>

              
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{13}" title="Faltan datos" class="form-control text-uppercase"
                    id="import_asesor_rfc" name="import_asesor_rfc" placeholder="RFC" style="color: #237087" required >
                  <label for="import_asesor_rfc">RFC</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
                    class="form-control text-uppercase" id="import_asesor_nss" name="import_asesor_nss"
                    placeholder="Numero de Seguro Social" style="color: #237087 ">
                  <label for="import_asesor_nss">NSS (IMSS)</label>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="import_asesor_sexo" required name="import_asesor_sexo">
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <span>Sexo</span>
                </label>
              </div>
            	<div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="import_asesor_puesto"
                  onChange="obtener_categoria_x_puesto_importar(this)"
                    id="import_asesor_puesto" required >
                    <option value="">Seleccione el puesto</option>

                          <?php
                            foreach ($puestos_trabajo as $p)
                            {
                              echo '<option value="'.$p->id_puesto.'">'.$p->nombre_puesto.'</option>';
                            }
                            ?>
                  </select>
                  <span>Puesto</span>
                </label>
              </div>
              
              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="import_asesor_categoria" id="import_asesor_categoria" required >
                    <option value="">Seleccione la categoria</option>
                  </select>
                  <span>Categoría</span>
                </label>
              </div>
          
          </div>
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="date" title="Faltan datos" class="form-control text-uppercase"
                      id="import_asesor_fecha_ingreso" name="import_asesor_fecha_ingreso" placeholder="Fecha " style="color: #237087" required >
                    <label for="import_asesor_fecha_ingreso">Fecha de Ingreso al CSEIIO</label>
                  </div>
                </div>
              
              <div class="col-md-9">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="import_asesor_plantel"
                    onChange=""
                    id="import_asesor_plantel" required >
                    <option value="">Seleccione el plantel</option>

                    <?php
                      foreach ($planteles as $plantel)
                      {
                        echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>
                  </select>
                  <span>Plantel CCT</span>
                </label>
              </div>
          
          </div>
          </div>
          
            
           

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para importar asesor-->

<!-- Inicia modal para modificar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modal_modificar_asesor">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modificar_asesor">

      <input type="hidden" id="modificar_asesor_id" name="modificar_asesor_id">

      
       <div class="modal-body">

       <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[0-9]{4}" title="El formato es de 4 dígitos numéricos" class="form-control text-uppercase"
                  id="modificar_num_empleado_asesor" name="modificar_num_empleado_asesor" placeholder="CURP" style="color: #237087" onblur="ponerCeros(this)" required>
                <label for="modificar_num_empleado_asesor">No. de Empleado</label>
              </div>
            </div>
          </div>
        </div>
       
        
           <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
                    class="form-control text-uppercase" id="modificar_asesor_nombre" name="modificar_asesor_nombre"
                    onchange="valida(this)" placeholder="Nombre(s)" style="color: #237087">
                  <label for="modificar_asesor_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
                    class="form-control text-uppercase" id="modificar_asesor_apellido_paterno" onchange="valida(this)"
                    name="modificar_asesor_apellido_paterno" placeholder="Apellido Paterno" style="color: #237087" >
                  <label for="modificar_asesor_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="modificar_asesor_apellido_materno" onchange="valida(this)"
                    name="modificar_asesor_apellido_materno" placeholder="Apellido Materno" style="color: #237087" >
                  <label for="modificar_asesor_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row">
            
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                    id="modificar_asesor_curp" name="modificar_asesor_curp" placeholder="CURP" style="color: #237087" required >
                  <label for="modificar_asesor_curp">CURP</label>
                </div>
              </div>

              
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{13}" title="Faltan datos" class="form-control text-uppercase"
                    id="modificar_asesor_rfc" name="modificar_asesor_rfc" placeholder="RFC" style="color: #237087" required >
                  <label for="modificar_asesor_rfc">RFC</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
                    class="form-control text-uppercase" id="modificar_asesor_nss" name="modificar_asesor_nss"
                    placeholder="Numero de Seguro Social" style="color: #237087 ">
                  <label for="modificar_asesor_nss">NSS (IMSS)</label>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">
            <div class="col-md-2">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="modificar_asesor_sexo" required name="modificar_asesor_sexo">
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <span>Sexo</span>
                </label>
              </div>
            	<div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="modificar_asesor_puesto"
                  onChange="obtener_categoria_x_puesto_modificar(this)"
                    id="modificar_asesor_puesto" required >
                    <option value="">Seleccione el puesto</option>

                          <?php
                            foreach ($puestos_trabajo as $p)
                            {
                              echo '<option value="'.$p->id_puesto.'">'.$p->nombre_puesto.'</option>';
                            }
                            ?>
                  </select>
                  <span>Puesto</span>
                </label>
              </div>
              
              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="modificar_asesor_categoria" id="modificar_asesor_categoria" required >
                    <option value="">Seleccione la categoria</option>
                  </select>
                  <span>Categoría</span>
                </label>
              </div>
          
          </div>
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="date" title="Faltan datos" class="form-control text-uppercase"
                      id="modificar_asesor_fecha_ingreso" name="modificar_asesor_fecha_ingreso" placeholder="Fecha " style="color: #237087" required >
                    <label for="modificar_asesor_fecha_ingreso">Fecha de Ingreso al CSEIIO</label>
                  </div>
                </div>
              
              <div class="col-md-9">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="modificar_asesor_plantel"
                    onChange=""
                    id="modificar_asesor_plantel" required >
                    <option value="">Seleccione el plantel</option>

                    <?php
                      foreach ($planteles as $plantel)
                      {
                        echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>
                  </select>
                  <span>Plantel CCT</span>
                </label>
              </div>
          
          </div>
          </div>
          
          
          
          
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para modificar asesor-->




<script>
function ponerCeros(num) {
  if(num.value==0){
    num.value="";
  }
  else{
    
    while (num.value.length<4)
    num.value = '0'+num.value;

  }
  
}

function cargar_datos_modal_importar(e){
  document.getElementById("form_importar_asesor").reset();
  
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_asesor/get_asesor?id='+e.value, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos personales
        
        document.getElementById("import_id_asesor").value = datos.id_asesor;
        document.getElementById("import_asesor_nombre").value = datos.nombre;
        document.getElementById("import_asesor_apellido_paterno").value = datos.primer_apellido;
        document.getElementById("import_asesor_apellido_materno").value = datos.segundo_apellido;
        document.getElementById("import_asesor_curp").value = datos.curp;
        document.getElementById("import_asesor_rfc").value = datos.rfc;
        document.getElementById("import_asesor_nss").value = datos.nss;
        //document.getElementById("import_asesor_modalidad").value = datos.modalidad;
        //document.getElementById("import_asesor_plantel").value = datos.Plantel_cct_plantel;
        document.getElementById("import_asesor_fecha_ingreso").value = datos.fecha_ingreso;
        document.getElementById("import_asesor_puesto").value = datos.id_puesto;

        num_empleado=datos.num_empleado;
        if(num_empleado === null){
            num_empleado="";
        }
        else{
            while (num_empleado.length<4){
              num_empleado= '0'+num_empleado;
            }

        }

        
        
    
        document.getElementById("import_num_empleado_asesor").value =num_empleado ;
        var sexo=datos.sexo;
        if(sexo === null){
          document.getElementById("import_asesor_sexo").value ="";
        
        }
        else{
          document.getElementById("import_asesor_sexo").value =datos.sexo;
        }
         
        
        

        var xhr_puesto = new XMLHttpRequest();
  
  
        import_asesor_categoria.innerHTML = "";
        xhr_puesto.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_categoria_x_puesto?id_puesto=' + datos.id_puesto, true);
        xhr_puesto.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr_puesto.error = function () {
          console.log("error de conexion");
        }
        xhr_puesto.onload = function () {
          $('#div_carga').hide();

          if(JSON.parse(xhr_puesto.response).length>0){
            var lista="";
                  
                  JSON.parse(xhr_puesto.response).forEach(function(valor){
                      lista+="<option value='"+valor.id_categoria+"'>"+valor.nombre_categoria+"</option>"
                  });
                  import_asesor_categoria.innerHTML=lista;
                  document.getElementById("import_asesor_categoria").value = datos.id_categoria;

                  
                } 
        };
        xhr_puesto.send(null);
       
        
      }

      xhr.send(null);
}

function reset_modal_importar(){
  document.getElementById("form_importar_asesor").reset();
  document.getElementById("buscar_importar_asesor").reset();
  document.getElementById("asesor_curp_busqueda_importar").value="";
  borrar_formato_tabla_importar();
  document.getElementById("tabla_importar").innerHTML = "";
}

var form_modificar = document.getElementById("modificar_asesor");

form_modificar.onsubmit = function (e) {
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    var formdata = new FormData(form_modificar);
  xhr.open("POST", "<?php echo base_url();?>index.php/c_asesor/modificar", true);
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        Swal.fire({
          type: 'success',
          title: 'Los datos se han actualizado correctamente',
          showConfirmButton: false,
          timer: 2500
        });
                $('#modal_modificar_asesor').modal('hide');
                  $(document).scrollTop(0);
                  //location.reload(); 
                  refrescar_tabla();
        
      }
     

      else {
        Swal.fire({
          type: 'error',
          title: 'Ha ocurrido un error',
          html:'<p style="text-align:left">Verifique lo siguiente:</p> <p style="text-align:left;margin-left:15%"> -El No. de Empleado y la CURP pertenezca al Asesor o Asesora.</p><p style="text-align:left;margin-left:15%"> -Los datos ingresados esten correctos.</p>',
          showConfirmButton: true,
          confirmButtonText: "Aceptar"
        });
      }
    }
  }
  xhr.send(formdata);

  }




function cargar_datos_modificar(e) {
  
  document.getElementById("modificar_asesor").reset();
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_asesor/get_asesor?id='+e.value, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos personales
        
        document.getElementById("modificar_asesor_id").value = datos.id_asesor;
        document.getElementById("modificar_asesor_nombre").value = datos.nombre;
        document.getElementById("modificar_asesor_apellido_paterno").value = datos.primer_apellido;
        document.getElementById("modificar_asesor_apellido_materno").value = datos.segundo_apellido;
        document.getElementById("modificar_asesor_curp").value = datos.curp;
        document.getElementById("modificar_asesor_rfc").value = datos.rfc;
        document.getElementById("modificar_asesor_nss").value = datos.nss;
        //document.getElementById("modificar_asesor_modalidad").value = datos.modalidad;
        document.getElementById("modificar_asesor_plantel").value = datos.Plantel_cct_plantel;
        document.getElementById("modificar_asesor_fecha_ingreso").value = datos.fecha_ingreso;
        document.getElementById("modificar_asesor_puesto").value = datos.id_puesto;


        num_empleado=datos.num_empleado;
        if(num_empleado === null){
            num_empleado="";
        }
        else{
            while (num_empleado.length<4){
              num_empleado= '0'+num_empleado;
            }

        }
        document.getElementById("modificar_num_empleado_asesor").value = num_empleado;
        

        var sexo=datos.sexo;
        if(sexo === null){
          document.getElementById("modificar_asesor_sexo").value ="";
        
        }
        else{
          document.getElementById("modificar_asesor_sexo").value =datos.sexo;
        }
        
        

        var xhr_puesto = new XMLHttpRequest();
  
  
        modificar_asesor_categoria.innerHTML = "";
        xhr_puesto.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_categoria_x_puesto?id_puesto=' + datos.id_puesto, true);
        xhr_puesto.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr_puesto.error = function () {
          console.log("error de conexion");
        }
        xhr_puesto.onload = function () {
          $('#div_carga').hide();

          if(JSON.parse(xhr_puesto.response).length>0){
            var lista="";
                  
                  JSON.parse(xhr_puesto.response).forEach(function(valor){
                      lista+="<option value='"+valor.id_categoria+"'>"+valor.nombre_categoria+"</option>"
                  });
                  modificar_asesor_categoria.innerHTML=lista;
                  document.getElementById("modificar_asesor_categoria").value = datos.id_categoria;

                  
                } 
        };
        xhr_puesto.send(null);
       
        
      }

      xhr.send(null);
    

}



function obtener_categoria_x_puesto_modificar(id_puesto) {


  var xhr = new XMLHttpRequest();
  
  
  modificar_asesor_categoria.innerHTML = "";
  xhr.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_categoria_x_puesto?id_puesto=' + id_puesto.value, true);
  xhr.onloadstart = function () {
    $('#div_carga').show();
  }
  xhr.error = function () {
    console.log("error de conexion");
  }
  xhr.onload = function () {
    $('#div_carga').hide();

    if(JSON.parse(xhr.response).length>0){
      var lista="";
            
            JSON.parse(xhr.response).forEach(function(valor){
                lista+="<option value='"+valor.id_categoria+"'>"+valor.nombre_categoria+"</option>"
            });
            modificar_asesor_categoria.innerHTML=lista;
            

            
          } 
  };
  xhr.send(null);

}


function obtener_categoria_x_puesto_importar(id_puesto) {


var xhr = new XMLHttpRequest();


import_asesor_categoria.innerHTML = "";
xhr.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_categoria_x_puesto?id_puesto=' + id_puesto.value, true);
xhr.onloadstart = function () {
  $('#div_carga').show();
}
xhr.error = function () {
  console.log("error de conexion");
}
xhr.onload = function () {
  $('#div_carga').hide();

  if(JSON.parse(xhr.response).length>0){
    var lista="";
          
          JSON.parse(xhr.response).forEach(function(valor){
              lista+="<option value='"+valor.id_categoria+"'>"+valor.nombre_categoria+"</option>"
          });
          import_asesor_categoria.innerHTML=lista;
          

          
        } 
};
xhr.send(null);

}



var form_importar = document.getElementById("form_importar_asesor");

form_importar.onsubmit = function (e) {
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    var formdata = new FormData(form_importar);
  xhr.open("POST", "<?php echo base_url();?>index.php/c_asesor/importar", true);
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        
        Swal.fire({
          type: 'success',
          title: 'Registro exitoso',
          allowOutsideClick: false,
          confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              //location.reload();
              $('#modal_importar').modal('hide');
              refrescar_tabla();
            }
            //aqui va si cancla
          }); 
      }

      else {
        Swal.fire({
          type: 'error',
          title: 'Ha ocurrido un error',
          html:'<p style="text-align:left">Verifique lo siguiente:</p> <p style="text-align:left;margin-left:15%"> -El No. de Empleado y la CURP pertenezca al Asesor o Asesora.</p><p style="text-align:left;margin-left:15%"> -Los datos ingresados esten correctos.</p>',
          showConfirmButton: true,
          confirmButtonText: "Aceptar"
        });
      }
    }
  }
  xhr.send(formdata);

  }




var form_buscar_importar = document.getElementById("buscar_importar_asesor");

form_buscar_importar.onsubmit = function (e) {
    e.preventDefault();
  borrar_formato_tabla_importar();
        document.getElementById("tabla_importar").innerHTML = "";
        var curp = document.getElementById("asesor_curp_busqueda_importar").value;
        var num_empleado = document.getElementById("asesor_num_empleado_busqueda_importar").value;
  
  var xhr_verificar = new XMLHttpRequest();

  xhr_verificar.open('GET', '<?php echo base_url();?>index.php/c_asesor/existe_asesor_x_curp?curp='+curp+'&num='+num_empleado, true);
  xhr_verificar.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr_verificar.error = function () {
        console.log("error de conexion");
      }
      xhr_verificar.onload = function () {
        $('#div_carga').hide();
        
        console.log(JSON.parse(xhr_verificar.response));
        let datos = JSON.parse(xhr_verificar.response);
        if (datos.tipo == "baja") {
          //Ejecutar si existe asesor
              

        var query = 'curp='+curp+'&num='+num_empleado;
        var xhr = new XMLHttpRequest();
          xhr.open('GET', '<?php echo base_url();?>index.php/C_asesor/buscar_asesor_baja_x_curp?'+query, true);
          xhr.onloadstart = function(){
            $('#div_carga').show();
          }
          xhr.error = function (){
            console.log("error de conexion");
          }
          xhr.onload = function(){
            $('#div_carga').hide();
            //console.log(JSON.parse(xhr.response));
            let datos = JSON.parse(xhr.response);
            //datos de materia
            JSON.parse(xhr.response).forEach(function (valor, indice) {

              var nombre_completo=valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre;

              var num_empleado=valor.num_empleado;

              console.log(valor);
              var fila = '<tr>';

              

              fila += '<td>';
              fila += valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre;
              fila += '</td>';

              if(num_empleado == null){
                num_empleado='';
              }
              else{
                while (num_empleado.length<4){
                  num_empleado= '0'+num_empleado;
                }

            }

              fila += '<td>';
              fila += num_empleado;
              fila += '</td>';

              fila += '<td>';
              fila += valor.Plantel_cct_plantel;
              fila += '</td>';

              fila += '<td>';
              fila += valor.curp;
              fila += '</td>';

              fila += '<td>';
              fila += valor.nombre_categoria;
              fila += '</td>';

              fila += '<td>';
              fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="'+valor.id_asesor+'" onclick="cargar_datos_modal_importar(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_importar" data-dismiss="modal">Agregar</button>';
              fila += '</td>';





              fila += '</tr>';

              document.getElementById("tabla_importar").innerHTML += fila;
            });

            formato_tabla_importar();
          }

          xhr.send(null);

          
          //Fin si existe asesor
        } 
        else {
          var mensaje="";
            if(datos.tipo=="alta"){
                mensaje=datos.respuesta;
                Swal.fire({
                  type: 'info',
                  scrollbarPadding:false,
                  html: mensaje,
                  showConfirmButton: true,
                  confirmButtonText: 'Aceptar'
                });
              
            }
            else if(datos.tipo=="no_existe"){
              //Empieza no existe asesor
                swalWithBootstrapButtons.fire({
                    type: 'info',
                    html: 'El Asesor con CURP <span style="font-weight:bold;text-transform:uppercase">'+curp+'</span> y número de empleado <span style="text-transform:uppercase;font-weight:bold">'+num_empleado+'</span> no existe en la base de datos <br>¿Desea dar de alta?',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    showCancelButton: 'true',
                    cancelButtonText: 'Cancelar'
                  }).then((result) => {
                    if (result.value) {
                      reset_form_asesor();
                      
                      if(num_empleado ==""){
                          num_empleado="";
                      }
                      else{
                          while (num_empleado.length<4){
                            num_empleado= '0'+num_empleado;
                          }

                      }
                      document.getElementById("num_empleado_asesor").value=num_empleado;
                      document.getElementById("asesor_curp").value=curp;
                      $('#modal_agregar').modal('toggle');
                      $('#modal_buscar_importar').modal('hide');
                  
                  }
                  });
              

              //TErmina no existe asesor
          }

          else if(datos.tipo=="datos_vacios"){
            mensaje=datos.respuesta;
                Swal.fire({
                  type: 'info',
                  scrollbarPadding:false,
                  html: mensaje,
                  showConfirmButton: true,
                  confirmButtonText: 'Aceptar'
                });
          }
            
            

        }
      };
      xhr_verificar.send(null);

      
    }



    function formato_tabla_importar() {
  $('#tabla_completa_importar').DataTable({
    //"order": [[ 0, 'desc' ]],
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ ",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "No se encontraron resultados",
      "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
      "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
      "sInfoFiltered": "(filtrado de un total de _MAX_ )",
      "sInfoPostFix": "",
      "sSearch": "Buscar específico:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}



function buscar() {
    document.getElementById("asesor_plantel_busqueda").disabled = true;
    document.getElementById("asesor_curp_busqueda").disabled = true;
    document.getElementById("asesor_num_empleado_busqueda").disabled = true;
    
    document.getElementById("tabla_asesor").innerHTML = "";
    var curp = document.getElementById("asesor_curp_busqueda").value;
    var plantel = document.getElementById("asesor_plantel_busqueda").value;
    var num_empleado = document.getElementById("asesor_num_empleado_busqueda").value;

    var query = 'curp=' + curp + '&cct_plantel=' + plantel+'&num='+num_empleado;
    var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_asesor/buscar_asesores_activos_plantel?'+query, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        //console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos de materia
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          console.log(valor);
          var fila = '<tr>';

          var num_empleado=valor.num_empleado;

          fila += '<td>';
          fila += valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre;
          fila += '</td>';

          if(num_empleado == null){
                num_empleado='';
              }

              else{
                while (num_empleado.length<4){
                  num_empleado= '0'+num_empleado;
                }

            }

          fila += '<td>';
          fila += num_empleado;
          fila += '</td>';

          fila += '<td>';
          fila += valor.Plantel_cct_plantel;
          fila += '</td>';

          fila += '<td>';
          fila += valor.curp;
          fila += '</td>';

          fila += '<td>';
          fila += valor.nombre_categoria;
          fila += '</td>';

          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="'+valor.id_asesor+'" onclick="cargar_datos_modificar(this)" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#modal_modificar_asesor">Editar</button>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="'+valor.id_asesor+'" onclick="eliminar_asesor(this)" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#modal_eliminar_asesor">Eliminar</button>';
          fila += '</td>';




          fila += '</tr>';

          document.getElementById("tabla_asesor").innerHTML += fila;
        });

        formato_tabla();
      }

      xhr.send(null);
	  
	  limpiarbusqueda();

    
    document.getElementById("importar_asesor").disabled = false;
    }
	
	
	function limpiarbusqueda(){
    document.getElementById("asesor_curp_busqueda").disabled = true;
    document.getElementById("asesor_plantel_busqueda").disabled = true;
    document.getElementById("asesor_num_empleado_busqueda").disabled = true;
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
  }


  
  
  function obtener_categoria_x_puesto() {

if (document.getElementById("asesor_puesto").value === "") {
  asesor_categoria.innerHTML = "";
  var option = document.createElement("option");
      option.text = "Seleccione la categoria";
      option.value = "";
      asesor_categoria.add(option);
  
} else {
  var xhr = new XMLHttpRequest();
  var id_puesto = document.getElementById("asesor_puesto").value;

  asesor_categoria.innerHTML = "";
  xhr.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_categoria_x_puesto?id_puesto=' + id_puesto, true);
  xhr.onloadstart = function () {
    $('#div_carga').show();
  }
  xhr.error = function () {
    console.log("error de conexion");
  }
  xhr.onload = function () {
    $('#div_carga').hide();

    if(JSON.parse(xhr.response).length>0){
      var lista="";
            
            JSON.parse(xhr.response).forEach(function(valor){
                lista+="<option value='"+valor.id_categoria+"'>"+valor.nombre_categoria+"</option>"
            });
            asesor_categoria.innerHTML=lista;
            
          } 
  };
  xhr.send(null);
}
}


var form = document.getElementById("agregar_asesor");

form.onsubmit = function (e) {
    e.preventDefault();
    var xhr = new XMLHttpRequest();
    var formdata = new FormData(form);
  xhr.open("POST", "<?php echo base_url();?>index.php/c_asesor/alta", true);
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        $('#modal_agregar').modal('toggle');
        Swal.fire({
          type: 'success',
          title: 'Registro exitoso',
          allowOutsideClick: false,
          confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              //location.reload();
              refrescar_tabla();
            }
            //aqui va si cancla
          }); 
      }
     else if(xhr.responseText.trim() === "existe_curp"){
            Swal.fire({
              type: 'error',
              title: 'El asesor ya se encuentra registrado en la base de datos, contacte con el administrador',
              showConfirmButton: false,
              timer: 2500
            });

      }

      else {
        Swal.fire({
          type: 'error',
          title: 'Ha ocurrido un error',
          html:'<p style="text-align:left">Verifique lo siguiente:</p> <p style="text-align:left;margin-left:15%"> -El No. de Empleado y la CURP pertenezca al Asesor o Asesora.</p><p style="text-align:left;margin-left:15%"> -Los datos ingresados esten correctos.</p>',
          showConfirmButton: true,
          confirmButtonText: "Aceptar"
        });
      }
    }
  }
  xhr.send(formdata);

  }

  function eliminar_asesor(valor) {
    var id_asesor=valor.value;

    var datos = new Array();

        dato={idasesor:id_asesor};

          datos.push(dato);
        

    var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/C_asesor/eliminar', true);
    
    swalWithBootstrapButtons.fire({
          type: 'info',
          text: '¿Está seguro de dar de baja al asesor?',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false,
          showCancelButton: 'true',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {
          //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }
        xhr.onreadystatechange = function () { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            $('#div_carga').hide();
            if (xhr.responseText.trim() === "si") {
              console.log(xhr.response);
              swalWithBootstrapButtons.fire({
                type: 'success',
                text: 'El asesor ha sido dado de baja correctamente',
                allowOutsideClick: false,
                confirmButtonText: 'Aceptar'
              }).then((result) => {
                if (result.value) {
                  //aqui va el aceptar
                  $(document).scrollTop(0);
                  //location.reload(); 
                  refrescar_tabla();

                  
                }
                //aqui va si cancela
              });
            } else {
              Swal.fire({
                type: 'error',
                text: 'No es posible dar de baja al asesor, vuelva a intentarlo.'
              });
            }
          }
        }
        xhr.send(JSON.stringify(datos));
        console.log(datos);
        
        }
        });



  }

  function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

function borrar_formato_tabla_importar(){
      $("#tabla_completa_importar").dataTable().fnDestroy();
      
    }

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }

    function reset_form_asesor() {
      document.getElementById("agregar_asesor").reset();
      asesor_categoria.innerHTML = "";
  var option = document.createElement("option");
      option.text = "Seleccione la categoria";
      option.value = "";
      asesor_categoria.add(option);

    }
</script>