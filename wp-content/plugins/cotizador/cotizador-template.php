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
	wp_enqueue_script('jquery-validate-min', WP_PLUGIN_URL  . '/cotizador/js/jquery.validate.min.js', array('jquery'));
	wp_enqueue_script('jquery-validate-min', WP_PLUGIN_URL  . '/cotizador/js/additional-methods.min.js', array('jquery'));
	wp_register_script('cotizador', WP_PLUGIN_URL  . '/cotizador/js/custom.js', array('jquery'), '1.0');
	wp_enqueue_script('cotizador');
	wp_localize_script('cotizador', 'custom_js', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));
}
add_action('admin_enqueue_scripts', 'custom_files');
add_action('wp_enqueue_scripts', 'custom_files');

get_header();

$teczilla_header_show_single_page =  get_theme_mod( 'teczilla_header_show_single_page', 0 );
if($teczilla_header_show_single_page==0){
	teczilla_breadcrumbs();
}
?>
<div class="section blog section-xx">
	<div class="container">
		<div class="row gutter-vr-40px">
			<div class="col-md-6">
				<div class="">
					<form id="fg-form" action="#" method="POST" novalidate="novalidate" data-fv-no-icon="true" class="form-horizontal has-validator">
						<div class="row mb-6">
							<label for="nombres" class="col-sm-5 col-form-label">Nombres <sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="nombres" name="nombres" type="text" value="" required="required" class="form-control ">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						</div>
						<div class="row mb-6">
							<label for="apellidos" class="col-sm-5 col-form-label">Apellidos <sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="apellidos" name="apellidos" type="text" value="" required="required" class="form-control ">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						</div>
						<div class="row mb-6">
							<label for="tipo-identificacion" class="col-sm-5 col-form-label">Tipo identificación <sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<select id="tipo-identificacion" name="tipo-identificacion" class="form-select" required="required">
									<option value="cedula-ciudadania">Cedula de ciudadanía</option>
									<option value="cedula-extranjeria">Cedula de extranjeria</option>
								</select>
							</div>
						</div>
						<div class="row mb-6">
							<label for="identificacion" class="col-sm-5 col-form-label">identificación <sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="identificacion" name="identificacion" type="text" value="" required="required" class="form-control">
							</div>
						</div>
						<div class="row mb-6">
							<label for="correo" class="col-sm-5 col-form-label">Correo E. <sup class="text-danger">* </sup>
							</label>
							<div class="col-sm-6">
								<input id="correo" name="correo" type="email" value="" required="required" class="form-control ">
								<div class="fv-plugins-message-container invalid-feedback"></div>
							</div>
						</div>
						<div class="row mb-6">
							<label for="modelo" class="col-sm-5 col-form-label">Modelo <sup class="text-danger">* </sup></label>
							<div class="col-sm-6">
								<select id="modelo" name="modelo" class="form-select" required="required">
									<option value="">Selecciona...</option>
									<option data-value="modelo-s" value="Modelo S">Modelo S</option>
									<option data-value="modelo-3" value="Modelo 3">Modelo 3</option>
									<option data-value="modelo-x" value="Modelo X">Modelo X</option>
									<option data-value="modelo-y" value="Modelo Y">Modelo Y</option>
								</select>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo" data-show-values="Modelo S" data-inverse="">
							<h2>Modelo S</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-s" class="col-sm-5 col-form-label">Tracción <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-s" name="traccion-modelo-s" required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="74990" value="Tracción a las cuatro ruedas con doble motor">Tracción a las cuatro ruedas con doble motor (USD $74,990)</option>
										<option data-value="89990" value="Tracción a las cuatro ruedas con triple motor">Tracción a las cuatro ruedas con triple motor (USD $89,990)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-s" class="col-sm-5 col-form-label">Color <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-s" name="color-modelo-s" required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Blanco perla multicapa">Blanco perla multicapa (Incluido)</option>
										<option data-value="0" value="Negro sólido">Negro sólido (Incluido)</option>
										<option data-value="0" value="Azul profundo metalizado">Azul profundo metalizado (Incluido)</option>
										<option data-value="0" value="Gris sigilo">Gris sigilo (Incluido)</option>
										<option data-value="0" value="Rojo Ultra">Rojo Ultra (Incluido)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-s" class="col-sm-5 col-form-label">Ruedas <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-s" name="ruedas-modelo-s" required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Ruedas Tempest de 19 pulgadas">Ruedas Tempest de 19 pulgadas (Incluido)</option>
										<option data-value="4500" value="Ruedas Arachnid de 21 pulgadas">Ruedas Arachnid de 21 pulgadas (USD $4,500)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-s" class="col-sm-5 col-form-label">Interiores <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-s" name="interiores-modelo-s" required="required" class="form-select ">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Todo negro">Todo negro (Incluido)</option>
										<option data-value="2000" value="Blanco y negro">Blanco y negro (USD $2,000)</option>
										<option data-value="2000" value="Crema">Crema (USD $2,500)</option>0
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo" data-show-values="Modelo 3" data-inverse="">
							<h2>Modelo 3</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-3" class="col-sm-5 col-form-label">Traccion <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-3" name="traccion-modelo-3" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="38990" value="Tracción trasera">Tracción trasera (USD $38,990)</option>
										<optgroup label="Largo alcance">
											<option data-value="45990" value="Tracción a las cuatro ruedas LA">Tracción a las cuatro ruedas (USD $45,990)</option>
										</optgroup>
										<optgroup label="Alto rendimiento">
											<option data-value="50990" value="Tracción a las cuatro ruedas AR">Tracción a las cuatro ruedas (USD $50,990)</option>
										</optgroup>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-3" class="col-sm-5 col-form-label">Color <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-3" name="color-modelo-3" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Plata medianoche metalizado">Plata medianoche metalizado (Incluido)</option>
										<option data-value="1000" value="Blanco perla multicapa">Blanco perla multicapa (USD $1,000)</option>
										<option data-value="1000" value="Azul profundo metalizado">Azul profundo metalizado (USD $1,000)</option>
										<option data-value="1500" value="Negro sólido">Negro sólido (USD $1,500)</option>
										<option data-value="2000" value="Rojo multicapa">Rojo multicapa (USD $2,000)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-3" class="col-sm-5 col-form-label">Ruedas <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-3" name="ruedas-modelo-3" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Ruedas Aero de 18 pulgadas">Ruedas Aero de 18 pulgadas (Incluido)</option>
										<option data-value="1500" value="Ruedas Deportivas de 19 pulgadas">Ruedas Deportivas de 19 pulgadas (USD $1,500)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-3" class="col-sm-5 col-form-label">Interiores <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-3" name="interiores-modelo-3" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Todo negro">Todo negro (Incluido)</option>
										<option data-value="1000" value="Blanco y negro">Blanco y negro (USD $1,000)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo" data-show-values="Modelo X" data-inverse="">
							<h2>Modelo X</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-x" class="col-sm-5 col-form-label">Tracción <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-x" name="traccion-modelo-x" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="79990" value="Tracción a las cuatro ruedas con doble motor">Tracción a las cuatro ruedas con doble motor (USD $79,990)</option>
										<option data-value="94990" value="Tracción a las cuatro ruedas con triple motor">Tracción a las cuatro ruedas con triple motor (USD $94,990)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-x" class="col-sm-5 col-form-label">Color <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-x" name="color-modelo-x" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Blanco perla multicapa">Blanco perla multicapa (Incluido)</option>
										<option data-value="0" value="Negro sólido">Negro sólido (Incluido)</option>
										<option data-value="0" value="Azul profundo metalizado">Azul profundo metalizado (Incluido)</option>
										<option data-value="0" value="Gris sigilo">Gris sigilo (Incluido)</option>
										<option data-value="0" value="Rojo Ultra">Rojo Ultra (Incluido)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-x" class="col-sm-5 col-form-label">Ruedas <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-x" name="ruedas-modelo-x" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Ruedas Cyberstream de 20 pulgadas">Ruedas Cyberstream de 20 pulgadas (Incluido)</option>
										<option data-value="5500" value="Ruedas Turbine de 22 pulgadas">Ruedas Turbine de 22 pulgadas ($5,500)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-x" class="col-sm-5 col-form-label">Interiores <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-x" name="interiores-modelo-x" required="required" class="form-select " disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Todo negro">Todo negro (Incluido)</option>
										<option data-value="2000" value="Blanco y negro">Blanco y negro ($2,000)</option>
										<option data-value="2000" value="Crema">Crema ($2,000)</option>
									</select>
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
						</div>

						<div class="modelo-wrapper" data-parent="modelo" data-show-values="Modelo Y" data-inverse="">
							<h2>Modelo Y</h2>
							<div class="row mb-6">
								<label for="traccion-modelo-y" class="col-sm-5 col-form-label">Tracción <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="traccion-modelo-y" name="traccion-modelo-y" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="43990" value="Tracción trasera">Tracción trasera (USD $43,990)</option>
										<optgroup label="Largo alcance">
											<option data-value="48990" value="Tracción a las cuatro ruedas LA">Tracción a las cuatro ruedas (USD $48,990)</option>
										</optgroup>
										<optgroup label="Alto rendimiento">
											<option data-value=52490" value="Tracción a las cuatro ruedas AR">Tracción a las cuatro ruedas (USD $52,490)</option>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="color-modelo-y" class="col-sm-5 col-form-label">Color <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="color-modelo-y" name="color-modelo-y" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Plata medianoche metalizado">Plata medianoche metalizado (Incluido)</option>
										<option data-value="1000" value="Blanco perla multicapa">Blanco perla multicapa (USD $1,000)</option>
										<option data-value="1000" value="Azul profundo metalizado">Azul profundo metalizado (USD $1,000)</option>
										<option data-value="2000" value="Negro sólido">Negro sólido (USD $2,000)</option>
										<option data-value="2000" value="Rojo multicapa">Rojo multicapa (USD $2,000)</option>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="ruedas-modelo-y" class="col-sm-5 col-form-label">Ruedas <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="ruedas-modelo-y" name="ruedas-modelo-y" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Ruedas Gemini de 19 pulgadas">Ruedas Gemini de 19 pulgadas (Incluido)</option>
										<option data-value="2000" value="Ruedas Induction de 20 pulgadas">Ruedas Induction de 20 pulgadas (USD $2,000)</option>
									</select>
								</div>
							</div>
							<div class="row mb-6">
								<label for="interiores-modelo-y" class="col-sm-5 col-form-label">Interiores <sup class="text-danger">* </sup>
								</label>
								<div class="col-sm-6">
									<select id="interiores-modelo-y" name="interiores-modelo-y" class="form-select" disabled="">
										<option data-value="0" value="">Selecciona...</option>
										<option data-value="0" value="Todo negro">Todo negro (Incluido)</option>
										<option data-value="1000" value="Blanco y negro">Blanco y negro (USD $1,000)</option>
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
								<label for="valor-modelo" class="col-sm-5 col-form-label">Valor Total:
								</label>
								<div class="col-sm-12">
									<input id="total" name="total" type="text" value="" disabled class="text-center form-control ">
									<div class="fv-plugins-message-container invalid-feedback"></div>
								</div>
							</div>
							<div class="col-sm-12">
								<button type="submit" id="submit" name="submit" value="" class="btn btn-success col-sm-5">
									Guardar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

</script>
<style>
	.gutter-vr-40px{
		padding: 60px;
		font-size: 1.5em;
	}
	.modelo-wrapper{
		padding-top: 50px;
		padding-left: 20px;
	}
	input, select, textarea{
		width: 100%;
	}
	input.error, select.error{
		border: 2px solid red;
		background-color: #ffffd5;
		margin: 0;
		color: red;
	}
</style>
<?php get_footer();?>
