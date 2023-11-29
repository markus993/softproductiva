<?php
/**
 *Template Name: Cotizador Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package teczilla
 */
function custom_files()
{
	wp_enqueue_style('bootstrap4', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css');
	wp_enqueue_script('boot2', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array('jquery'), '', true);
	wp_enqueue_script('boot3', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-validate-min', WP_PLUGIN_URL . '/cotizador/js/jquery.validate.min.js', array('jquery'));
	wp_enqueue_script('jquery-validate-min', WP_PLUGIN_URL . '/cotizador/js/additional-methods.min.js', array('jquery'));
	wp_enqueue_script('jquery-multiple-file', WP_PLUGIN_URL . '/cotizador/js/jquery.MultiFile.js', array('jquery'));
	wp_enqueue_script('jquery-modal-min', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', array('jquery'));
	wp_enqueue_style('jquery-modal-min', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', array(), '1.0', true);
	wp_register_script('cotizador', WP_PLUGIN_URL . '/cotizador/js/custom.js', array('jquery'), '1.0');
	wp_enqueue_script('cotizador');
	wp_localize_script(
		'cotizador',
		'custom_js',
		array(
			'ajax_url' => admin_url('admin-ajax.php')
		)
	);
}
add_action('admin_enqueue_scripts', 'custom_files');
add_action('wp_enqueue_scripts', 'custom_files');

get_header();

$valores = get_field('valores', 1310);
//$valores = get_field('valores', 197);
$valores = json_decode($valores, TRUE);

function optionPrint($value, $text)
{
	if ($value == 0)
		$valor = 'Incluido';
	else
		$valor = 'COP $' . number_format($value, 0, '.', ',');
	return '<option data-value="' . $value . '" value="' . $text . ' (' . $valor . ')">' . $text . ' (' . $valor . ')</option>';
}

?>
<div class="section blog section-xx">
	<div class="container">
		<div class="row gutter-vr-40px">
			<div class="col-md-12">
				<div class="">
					<form id="fg-form" action="#" method="POST" novalidate="novalidate"
						data-fv-no-icon="true" class="form-horizontal has-validator">
						<input id="action" name="action" type="hidden"
							value="crea_cotizacion_tesla">
						<div class="row mb-6">
							<label for="nombres" class="col-sm-5 col-form-label">Nombres <sup
									class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="nombres" name="nombres" type="text" value=""
									required="required" class="form-control ">
							</div>
						</div>
						<div class="row mb-6">
							<label for="apellidos" class="col-sm-5 col-form-label">Apellidos
								<sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="apellidos" name="apellidos" type="text" value=""
									required="required" class="form-control ">
							</div>
						</div>
						<div class="row mb-6">
							<label for="tipo-identificacion"
								class="col-sm-5 col-form-label">Tipo identificación <sup
									class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<select id="tipo-identificacion" name="tipo-identificacion"
									class="form-select" required="required">
									<option value="cedula-ciudadania">Cedula de ciudadanía
									</option>
									<option value="cedula-extranjeria">Cedula de extranjeria
									</option>
								</select>
							</div>
						</div>
						<div class="row mb-6">
							<label for="identificacion"
								class="col-sm-5 col-form-label">identificación <sup
									class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="identificacion" name="identificacion" type="text"
									value="" required="required" class="form-control">
							</div>
						</div>
						<div class="row mb-6">
							<label for="direccion" class="col-sm-5 col-form-label">Dirección
								<sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="direccion" name="direccion" type="text" value=""
									required="required" class="form-control ">
							</div>
						</div>
						<div class="row mb-6">
							<label for="correo" class="col-sm-5 col-form-label">Correo E. <sup
									class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="correo" name="correo" type="email" value=""
									required="required" class="form-control ">
							</div>
						</div>


						<div class="row mb-6">
							<label for="adjuntos" class="col-sm-5 col-form-label">Anexos
							</label>
							<div class="col-sm-6">
								<input id="adjuntos" name="adjuntos[]" type="file" value=""
									class="form-control" multiple
									accept=".doc,.docx,.png,.jpg,.jpeg,.pdf,.xls,.xlsx">
								<div id="file-list"></div>
								<div class="fv-plugins-message-container invalid-feedback">
									Archivo doc, docx, png, jpg, jpeg, pdf, xls o xlsx
								</div>
							</div>
						</div>


						<div class="row mb-6">
							<label for="observaciones"
								class="col-sm-5 col-form-label">Observaciones
							</label>
							<div class="col-sm-6">
								<textarea id="observaciones" name="observaciones" rows="4"
									cols="50"></textarea>
							</div>
						</div>
						<div class="row mb-6">
							<label for="modelo" class="col-sm-5 col-form-label">Modelo <sup
									class="text-danger">* </sup></label>
							<div class="col-sm-6">
								<select id="modelo" name="modelo" class="form-select"
									required="required">
									<option value="">Selecciona...</option>
									<option data-value="modelo-s" value="Modelo S">Modelo S
									</option>
									<option data-value="modelo-3" value="Modelo 3">Modelo 3
									</option>
									<option data-value="modelo-x" value="Modelo X">Modelo X
									</option>
									<option data-value="modelo-y" value="Modelo Y">Modelo Y
									</option>
								</select>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo"
							data-show-values="Modelo S" data-inverse="">
							<h2>Modelo S</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-s"
									class="col-sm-5 col-form-label">Tracción <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-s" name="traccion-modelo-s"
										required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-s']['traccion'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-s"
									class="col-sm-5 col-form-label">Color <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-s" name="color-modelo-s"
										required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-s']['color'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-s"
									class="col-sm-5 col-form-label">Ruedas <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-s" name="ruedas-modelo-s"
										required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-s']['ruedas'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-s"
									class="col-sm-5 col-form-label">Interiores <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-s" name="interiores-modelo-s"
										required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-s']['interiores'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo"
							data-show-values="Modelo 3" data-inverse="">
							<h2>Modelo 3</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-3"
									class="col-sm-5 col-form-label">Traccion <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-3" name="traccion-modelo-3"
										class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-3']['traccion'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-3"
									class="col-sm-5 col-form-label">Color <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-3" name="color-modelo-3"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-3']['color'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-3"
									class="col-sm-5 col-form-label">Ruedas <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-3" name="ruedas-modelo-3"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-3']['ruedas'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-3"
									class="col-sm-5 col-form-label">Interiores <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-3" name="interiores-modelo-3"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-3']['interiores'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo"
							data-show-values="Modelo X" data-inverse="">
							<h2>Modelo X</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-x"
									class="col-sm-5 col-form-label">Tracción <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-x" name="traccion-modelo-x"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-x']['traccion'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-x"
									class="col-sm-5 col-form-label">Color <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-x" name="color-modelo-x"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-x']['color'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-x"
									class="col-sm-5 col-form-label">Ruedas <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-x" name="ruedas-modelo-x"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-x']['ruedas'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-x"
									class="col-sm-5 col-form-label">Interiores <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-x" name="interiores-modelo-x"
										required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-x']['interiores'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo"
							data-show-values="Modelo Y" data-inverse="">
							<h2>Modelo Y</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-y"
									class="col-sm-5 col-form-label">Tracción <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-y" name="traccion-modelo-y"
										class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-y']['traccion'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-y"
									class="col-sm-5 col-form-label">Color <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-y" name="color-modelo-y"
										class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-y']['color'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-y"
									class="col-sm-5 col-form-label">Ruedas <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-y" name="ruedas-modelo-y"
										class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-y']['ruedas'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-y"
									class="col-sm-5 col-form-label">Interiores <sup
										class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-y" name="interiores-modelo-y"
										class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<?php
										foreach ($valores['modelo-y']['interiores'] as $text => $value) {
											echo optionPrint($value, $text);
										}
										?>
									</select>
								</div>
							</div>

							<!-- <div class="row mb-6">
								<label for="disposicion-modelo-y" class="col-sm-5 col-form-label">Disposición de los asientos <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="disposicion-modelo-y" name="disposicion-modelo-y" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Interior de cinco plazas">Interior de cinco plazas</option>
										<option data-value="0" value="Interior de siete asientos">Interior de siete asientos</option>
									</select>
								</div>
							</div>
							!-->
						</div>
						<div class="row text-center">
							<div class="col-sm-12">
								<label for="valor-modelo" class="col-sm-5 col-form-label">Valor
									Total:
								</label>
								<div class="col-sm-12">
									<input id="total" name="total" type="text" value="" disabled
										class="text-center form-control ">
								</div>
							</div>
							<div class="col-sm-12">
								<input type="submit" id="submit" name="submit" value="Guardar"
									class="btn btn-success col-sm-5">
								</input>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmacionModal" data-backdrop="static"
	tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="confirmacionModalLabel">Guardado</h5>
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Cotizacion almacenada exitosamente
			</div>
			<div class="modal-footer">
				<button id="close" type="button" class="btn btn-secondary"
					data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>

</script>
<style>
	.gutter-vr-40px {
		padding: 60px;
		font-size: 1.1em;
	}

	.modelo-wrapper {
		padding-top: 50px;
		padding-left: 20px;
	}

	input,
	select,
	textarea {
		width: 100%;
	}

	input.error,
	select.error {
		border: 2px solid red;
		background-color: #ffffd5;
		margin: 0;
		color: red;
	}

	.fv-plugins-message-container {
		font-size: 0.5em;
	}

	select,
	input,
	textarea {
		max-width: 100%;
		margin: 0px 0px 10px 0px;
	}
</style>
<?php get_footer(); ?>

