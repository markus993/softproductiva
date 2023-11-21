<?php

/**
 * Plugin Name:  Cotizador Tesla
 * Description:  Cotizador Tesla
 * Version:      1.0
 * Author:       Marco Mayor
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
  exit;
}

add_action('wp_ajax_crea_cotizacion_tesla', 'crea_cotizacion_tesla');
add_action('wp_ajax_nopriv_crea_cotizacion_tesla', 'crea_cotizacion_tesla');

function crea_cotizacion_tesla()
{
  $now = new DateTime('now', new DateTimeZone('America/Bogota'));
  $fecha = $now->format('Y-m-d H:i:s');
  $data = $_POST['data'];
  //var_dump($data);
  $nombres = $data[0]['value'];
  $apellidos = $data[1]['value'];
  $id = $data[3]['value'];
  $modelo = $data[5]['data-value'];
  $titulo = $id.' '.$nombres.' '.$apellidos.' '.$modelo.' '.$fecha;
  $cotizacion = array(
    'post_title' => $titulo,
    'post_content' => '',
    'post_status' => 'publish',
    'post_type' => 'cotizacion'
  );
  $cotizacion_id = wp_insert_post($cotizacion);

  update_post_meta($cotizacion_id, 'nombres', $nombres);
  update_post_meta($cotizacion_id, 'apellidos', $apellidos);
  update_post_meta($cotizacion_id, 'tipo_identificacion', $data[2]['value']);
  update_post_meta($cotizacion_id, 'correo_electronico', $data[4]['value']);
  update_post_meta($cotizacion_id, 'modelo', $data[5]['value']);
  update_post_meta($cotizacion_id, 'traccion', $data[6]['value']);
  update_post_meta($cotizacion_id, 'color', $data[7]['value']);
  update_post_meta($cotizacion_id, 'ruedas', $data[8]['value']);
  update_post_meta($cotizacion_id, 'interiores', $data[9]['value']);
  update_post_meta($cotizacion_id, 'identificacion', $id);
  update_post_meta($cotizacion_id, 'valor', $data[10]['value']);
  update_post_meta($cotizacion_id, 'json_data', json_encode($data, true));

  echo $cotizacion_id;

  wp_die(); // this is required to terminate immediately and return a proper response
}

function wpse255804_add_page_template($templates)
{
  $templates['cotizador-template.php'] = 'Cotizador Tesla';
  return $templates;
}
add_filter('theme_page_templates', 'wpse255804_add_page_template');

function wpse255804_redirect_page_template($template)
{
  $post = get_post();
  $page_template = get_post_meta($post->ID, '_wp_page_template', true);
  if ('cotizador-template.php' == basename($page_template))
    $template = WP_PLUGIN_DIR . '/cotizador/cotizador-template.php';
  return $template;
}
add_filter('page_template', 'wpse255804_redirect_page_template');
