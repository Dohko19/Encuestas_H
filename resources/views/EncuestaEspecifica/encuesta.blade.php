<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
		<title>Bmobile-Crear Encuestas</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="../../src/images/bmobilefront.jpg" rel='shortcut icon' type='image/x-icon'>
        <link rel="stylesheet" href="../../Libs/jquery-ui-1.11.4.custom/jquery-ui.css">
        <link href="../../Libs/Bootstrap/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../src/css/styleheaderandfooter.css">
        <link rel="stylesheet" type="text/css" href="./../../src/css/ProjectSalud/projectSalud.css">
        <link rel="stylesheet" href="../../src/css/font-awesome.min.css">
        <link rel="stylesheet" href="./../../Libs/bootstrap-table/dist/bootstrap-table.css" />
        <script type="text/javascript" src="../../Libs/jquery.1.9.3.js"></script>
        <script type="text/javascript" src="../../Libs/remote-list.min.js"></script>
        <script src="./../../Libs/Highcharts/highcharts.js"></script>
        <script src="./../../Libs/Highcharts/exporting.js"></script>
        <script src="./../../Libs/Highcharts/drilldown.js"></script>
        <script type="text/javascript" src="../../Libs/Bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../Libs/jquery-ui.js"></script>
        <script type="text/javascript" src="./../../src/js/Equipment/MultiNestedList.js"></script>
        <script type="text/javascript" src="./../../src/js/ProjectManagement/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="./../../Libs/bootstrap-table/dist/bootstrap-table.js"></script>
        <script type="text/javascript" src="./../../Libs/bootstrap-table/dist/locale/bootstrap-table-es-MX.min.js"></script>
        <script src="../../src/js/Login/closeInactive.js"></script>
		<script type="text/javascript" src="./../../src/js/Marketing/survey.js"></script>

		<script type="text/javascript">
	
			function RefrescaItem(){
				var ip = [];
				var i = 0;
				$('#guardar').attr('disabled','disabled'); //Deshabilito el Boton Guardar
				$('.iProduct').each(function(index, element) {
					i++;
					ip.push({ id_pro : $(this).val() });
				});
				// Si la lista de Items no es vacia Habilito el Boton Guardar
				if (i > 0) {
					$('#guardar').removeAttr('disabled','disabled');
				}
				var ipt=JSON.stringify(ip); //Convierto la Lista de Items a un JSON para procesarlo en tu controlador
				$('#ListaPro').val(encodeURIComponent(ipt));
			}
		   	function agregarItem() {
	
				var sel = $('#pro_id').find(':selected').val(); //Capturo el Value del Item
				var text = $('#pro_id').find(':selected').text();//Capturo el Nombre del Item- Texto dentro del Select
			   
				
				var sptext = text.split();
				
				var newtr = '<tr class="table"  data-id="'+sel+'">';
				newtr = newtr + '<td> <input  class="form-control" id="valor" name="valor" value="" required /></td>';
				newtr = newtr + '<td><input  class="form-control" id="descripcion" name="descripcion" value="" required /></td>';
				newtr = newtr + '<td><button type="button" class="btn btn-danger btn-xs remove-item"><i class="fa fa-times"></i></button></td></tr>';
				
				$('#ProSelected').append(newtr); //Agrego el Item al tbody de la Tabla con el id=ProSelected
				
				RefrescaItem();//Refresco Items
					
				$('.remove-item').off().click(function(e) {
					$(this).parent('td').parent('tr').remove(); //En accion elimino el Item de la Tabla
					if ($('#ProSelected tr.item').length == 0)
						$('#ProSelected .no-item').slideDown(300); 
					RefrescaItem();
				});        
			   $('.iProduct').off().change(function(e) {
					RefrescaItem();
			   });
			}


        </script>
        <style>
        .square {
            border-style:solid;
            border-width:2px;
            border-color:#0071c5;
            position: inherit;
            align-content: center;
            width: 100%;
            }

        .square:after {
            content: "";
            display: block;
            
        }

            
        </style>
	</head>
	
	<body>

		<br>
		<br>
		

		
			<div id="table_Encuestas" class="container">
				<p>
					<a class="btn btn-primary btn-md add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar </a>
				</p>
				<table id="table"  class="display table table-bordered table-hover table-stripe" cellspacing="0" width="95%" data-search="true" data-pagination="true">
					<thead>
						<tr>
							<th data-field="id" data-sortable="true">ID</th>
							<th data-field="nombre_encuesta" data-sortable="true">Nombre Encuesta</th>
							<th data-field="user" data-sortable="true">Nombre Usuario</th>
							<th data-field="version" data-sortable="true">Versión</th>
							<th data-field="disponible" data-sortable="true">Disponible</th>
							<th data-field="buttonShow"></th>
							<th data-field="buttonEdit"></th>
							<th data-field="buttonDelete"></th>
						</tr>
					</thead>
				</table>
			</div>
			<br>
			<br>
			<!--AGREGAR UN Encuesta-->
			<div id="formAdd" hidden>
				<a href="#" class="btn btn-primary btn-md_regresar">
					<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar
				</a>
				<h2>Crear encuesta</h2>
				<div style="background-color:white">
					<form action="../../controller/Marketing/InsertarEncuesta.php" method="post">
						<br>
						<!-- TIPO DE PREGUNTAS -->
						<div class="col-lg-2" style="background-color:white">
							<table  class="display table table-bordered table-hover table-stripe">
								<tr>
									<th align="center"><h3>Tipo de pregunta</h3></th>
								</tr>
								<tr>
									<td><select class="form-control" name="tipo_pregunta" id="tipo_pregunta">
										<option value="">Seleccione una opcion</option>
										<option value="1">Respuesta Larga</option>
										<option value="2">Respuesta Corta</option>
										<option value="3">Opción Múltiple</option>
										<option value="4">Opción Única</option>
										<option value="5">Valoración</option>
										<option value="6">Opción Múltiple con Respuesta Abierta</option>
										<option value="7">Opción Única con Respuesta Abierta</option>
										</select>
									</td>
								</tr>
							</table>
						</div>

						<!-- PREGUNTAS -->
						<div class="col-lg-8" style="background-color:white">
							<table class="table">
								<tr>
									<td class="table">
										<label for="">Nombre de la encuesta</label>
										<input type="text" class="form-control col-sm-6" name="descripcion_a" id="descripcion_a" placeholder="Nombre o descripcion de la encuesta...">
									</td>
									<td class="table">
									<br>
										<input type="button" id="ok_nombre_encuesta" class="btn btn-primary ok_nombre" value="OK" />
									</td>
								</tr>
							</table>
							<table class="table">
								<!-- ABIERTAS -->
								<tr id="trabiertas">
									<td class="form-control col-sm-6">
										<label for="">Preguntas Abiertas</label>
										<table class="table">
											<tr>
												<td>
													<button type="button" id="add_abierta" class="btn btn-primary add_abierta glyphicon glyphicon-plus"></button>
												</td>
												<td>
													<input type="text" class="form-control col-sm-10" name="abierta_des[]" id="abierta_des" placeholder="Planteamiento de la pregunta abierta...">
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- OPCION MULTIPLE -->
								<tr id="trmultiples"> 
									<td>
										<table class="table">
											<tr>
												<td class="form-control col-sm-6">
													<label for="">Preguntas de Opción Muliple</label>
													<table class="table">
														<tr>
															<td>
																<button type="button" id="agregar_pregunta" class="btn btn-primary add_pregunta glyphicon glyphicon-plus"></button>
															</td>
															<td>
																<input type="text" class="form-control col-sm-10" name="multiple_des" id="multiple_des" placeholder="Planteamiento de la pregunta multiple...">
															</td>
														</tr>
														<tr>
															<th>Valores</th>
														</tr>
														<tr>
															<td>
																<button type="button" id="add_opcion_multiple" class="btn btn-primary add_opcion_multiple glyphicon glyphicon-plus"></button>
															</td>
															<td><input type="text" class="form-control col-sm-3"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- OPCION UNICA -->
								<tr id="trunica"> 
									<td>
										<table class="table">
											<tr>
												<td class="form-control col-sm-6">
													<label for="">Preguntas de Opción Única</label>
													<table class="table">
														<tr>
															<td>
																<button type="button" id="agregar_pregunta" class="btn btn-primary add_pregunta glyphicon glyphicon-plus"></button>
															</td>
															<td>
																<input type="text" class="form-control col-sm-10" name="multiple_des" id="multiple_des" placeholder="Planteamiento de la pregunta opcion unica...">
															</td>
														</tr>
														<tr>
															<th>Valores</th>
														</tr>
														<tr>
															<td>
																<button type="button" id="add_opcion_multiple" class="btn btn-primary add_opcion_multiple glyphicon glyphicon-plus"></button>
															</td>
															<td><input type="text" class="form-control col-sm-3"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- RANKING -->
								<tr id="trranking"> 
									<td>
										<table class="table">
											<tr>
												<td class="form-control col-sm-6">
													<label for="">Preguntas de Ranking</label>
													<table class="table">
														<tr>
															<td>
																<button type="button" id="agregar_pregunta" class="btn btn-primary add_pregunta glyphicon glyphicon-plus"></button>
															</td>
															<td>
																<input type="text" class="form-control col-sm-10" name="multiple_des" id="multiple_des" placeholder="Planteamiento de la pregunta Ranking...">
															</td>
														</tr>
														<tr>
															<th>Valores</th>
														</tr>
														<tr>
															<td>
																<button type="button" id="add_opcion_multiple" class="btn btn-primary add_opcion_multiple glyphicon glyphicon-plus"></button>
															</td>
															<td><input type="text" class="form-control col-sm-3"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<!-- ESCALA -->
								<tr id="trescala"> 
									<td>
										<table class="table">
											<tr>
												<td class="form-control col-sm-6">
													<label for="">Preguntas de Escala</label>
													<table class="table">
														<tr>
															<td>
																<button type="button" id="agregar_pregunta" class="btn btn-primary add_pregunta glyphicon glyphicon-plus"></button>
															</td>
															<td>
																<input type="text" class="form-control col-sm-10" name="multiple_des" id="multiple_des" placeholder="Planteamiento de la pregunta Escala...">
															</td>
														</tr>
														<tr>
															<th>Valores</th>
														</tr>
														<tr>
															<td>
																<button type="button" id="add_opcion_multiple" class="btn btn-primary add_opcion_multiple glyphicon glyphicon-plus"></button>
															</td>
															<td><input type="text" class="form-control col-sm-3"></td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
									
							</table>
						</div>

						<!-- SECCIONES -->
						<div class="col-lg-2" style="background-color:white">
							<table class="display table table-bordered table-hover table-stripe">
								<tr>
									<th><h3 align="center">Secciones</h3></th>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 1</td>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 2</td>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 3</td>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 4</td>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 5</td>
								</tr>
								<tr>
									<td align="center"><label for=""></label>SECCION 5</td>
								</tr>
							</table>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						</div>
						<div class="container">
							<button type="submit" id="guardar" name= "guardar" class="btn btn-lg btn-primary pull-right">Guardar</button>
						</div>
					</form>
				</div>
			</div>
					
			<!--EDITAR INFORMACION DE UN Encuesta-->
			<div class="container" id="formEdit" hidden style="background-color:white">
				<div class="row">
					<div class="col-md-12">
						<a href="knowledgeBase_View.html" class="btn btn-success btn-md">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar
						</a>
					</div>
				</div>
				<br>
				<from target="_blank">
					<h2>Editar Encuesta</h2>
					<div class="form-group">
						<label for="cm">Descripción o Nombre de la Encuesta</label>
						<div class="input-group">
							<span class="input-group-addon"></span>
							<input type="text" class="form-control" name="descripcion_e" id="descripcion_e">
						</div>
					</div>
					<div class="form-group square">
                        <button type="button" class="btn btn-info glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></button>
                        <h3>Preguntas de tipo Abiertas</h3>
                        <table id="tabla_a"></table>
                    </div>

                    <div class="form-group square">
                        <button type="button" class="btn btn-info glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></button>
                        <h3>Preguntas de tipo Elección Única</h3>
                        <table id="tabla_eu"></table>
                    </div>

                    <div class="form-group square">
                        <button type="button" class="btn btn-info glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></button>
                        <h3>Preguntas de tipo Elección Multiple</h3>
                        <table id="tabla_em"></table>
                    </div>
                    <div class="form-group square">
                        <button type="button" class="btn btn-info glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></button>
                        <h3>Preguntas de tipo Ranking</h3>
                        <table id="tabla_r"></table>
                    </div>
                    <div class="form-group square">
                        <button type="button" class="btn btn-info glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"></button>
                        <h3>Preguntas de tipo Escala</h3>
                        <table id="tabla_e"></table>
                    </div>
					<div class="form-group">
						<label for="sm">Planteamiento de la pregunta</label>
						<input type="text" name="plateamiento" id="planteamiento" class="form-control" placeholder="Planteamiento de la pregunta...">
					</div>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="agregarItem()">Agregar</button>
					  <input type="" id="ListaPro" name="ListaPro" value="" required />
					<table id="TablaPro" class="table">
						<thead>
							<tr>
								<th>Valor</th>
								<th>Descripcion</th>
							</tr>
						</thead>
						<tbody id="ProSelected"><!--Ingreso un id al tbody-->
							<tr>
						 
							</tr>
						</tbody>
					</table>
					<div class="form-group">
						<button type="submit" id="guardar" name= "guardar" class="btn btn-lg btn-primary pull-right">Guardar</button>
					</div>
				</from>
			</div>
	
			<!--VER INFORMACION de Encuesta-->
	
			<div class="container" id="formShow" hidden>
				<div class="row">
					<div class="col-md-12">
						<a href="knowledgeBase_View.html" class="btn btn-success btn-md">
							<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar
						</a>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col-md-12">
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-briefcase">
										</span> Ver Encuesta</a>
									</h4>
								</div>
								<!--div id="collapseTwo" class="panel-collapse collapse"-->
								<div id="collapseTwo" class="panel-collapse">
									<div class="panel-body">
										<div class="form-group">
											<label for="cs">ID Encuesta</label>
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" class="form-control" name="id_ver" id="id_ver" readonly="" size="10">
											</div>
										</div>
										<div class="form-group">
											<label for="cm">Descripción de Encuesta</label>
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" class="form-control" name="descripcion_ver" id="descripcion_ver" readonly="">
											</div>
										</div>
										<div class="form-group">
											<label for="color" class="col-sm-2 control-label">Color</label>
											<select name="color_ver" class="form-control" id="color_ver" disabled>
												<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
												<option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
												<option style="color:#008000;" value="#008000">&#9724; Verde</option>						  
												<option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
												<option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
												<option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
												<option style="color:#000;" value="#000">&#9724; Negro</option>
												<option style="color:#A349A4;" value="#A349A4">&#9724; Morado</option>
											</select>
										</div>
	
										<div class="form-group">
											<label for="cs">Fecha de Inicio</label>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												<input type="date" class="form-control" name="fecha_inicio_ver" id="fecha_inicio_ver" readonly="">
											</div>
										</div>
										<div class="form-group">
											<label for="cs">Fecha de Termino</label>
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
												<input type="date" class="form-control" name="fecha_final_ver" id="fecha_final_ver" readonly="">
											</div>
										</div>
	
										<div class="form-group">
											<label for="cm">Tipo de Encuesta</label>
											<div class="input-group">
												<span class="input-group-addon"></span>
												<input type="text" class="form-control" name="tipo_Encuesta_ver" id="tipo_Encuesta_ver" readonly="">
											</div>
										</div>
	
										<div class="form-group">
											<label for="sm">Encuesta de pago</label>
											<div class="input-group">
												<span class="input-group-addon">$</span>
												<input type="text" class="form-control" name="pago_Encuesta_ver" id="pago_Encuesta_ver" readonly="">
											</div>
										</div>
	
										<div class="form-group">
											<label for="color" class="col-sm-2 control-label">Área</label>
											<select name="area_ver" class="form-control" id="area_ver" disabled>
												<option value="1">Movilidad</option>
												<option value="2">Infraestructura</option>
												<option value="3">Servicio y apoyo</option>						  
												<option value="4">Implant</option>
											</select>
										</div>
	
										<div class="form-group">
											<label for="sm">URL</label>
											<div class="input-group">
											<a><span id="url_ver"></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
	

	</body>

        
        <div class="pie1">
			<div class="pie col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				2015 Dispositivos Moviles  S.A de C.V Todos los derechos reservados 
				<a  class="politicas" href="http://www.scanda.com.mx/scanda/pdf/CartaLFPDPPScanda.pdf">Politicas de privacidad</a>
			</div>
		</div>
	</body>
</html>



