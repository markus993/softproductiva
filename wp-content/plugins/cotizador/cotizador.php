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

  $data = array();

  foreach ($_POST as $key => $value) {
    $data[] = $value;
  }
  $nombres = $data[1];
  $apellidos = $data[2];
  $id = $data[4];
  $modelo = $data[8];
  $titulo = $id . ' ' . $nombres . ' ' . $apellidos . ' ' . $modelo . ' ' . $fecha;
  $cotizacion = array(
    'post_title' => $titulo,
    'post_content' => '',
    'post_status' => 'private',
    'post_type' => 'cotizacion'
  );
  $cotizacion_id = wp_insert_post($cotizacion);

  // CAMPOS
  update_field('nombres', $nombres, $cotizacion_id);
  update_field('apellidos', $apellidos, $cotizacion_id);
  update_field('tipo_identificacion', $data[3], $cotizacion_id);
  update_field('identificacion', $id, $cotizacion_id);
  update_field('direccion', $data[5], $cotizacion_id);
  update_field('correo_electronico', $data[6], $cotizacion_id);
  update_field('observaciones', $data[7], $cotizacion_id);
  update_field('modelo', $modelo, $cotizacion_id);
  update_field('traccion', $data[9], $cotizacion_id);
  update_field('color', $data[10], $cotizacion_id);
  update_field('ruedas', $data[11], $cotizacion_id);
  update_field('interiores', $data[12], $cotizacion_id);
  update_field('valor', $data[13], $cotizacion_id);
  update_field('json_data', json_encode($data, true), $cotizacion_id);

  // ANEXOS
  if (!empty($_FILES['adjuntos']['name'][0])) {
    $files = $_FILES['adjuntos'];
    foreach ($files['name'] as $key => $file) {
      $array_file = array(
        'name' => $files['name'][$key],
        'full_path' => $files['full_path'][$key],
        'type' => $files['type'][$key],
        'tmp_name' => $files['tmp_name'][$key],
        'error' => $files['error'][$key],
        'size' => $files['size'][$key],
      );
      $upload = wp_handle_upload(
        $array_file,
        array('test_form' => false)
      );
      $attachment_id = wp_insert_attachment(
        array(
          'guid' => $upload['url'],
          'post_mime_type' => $upload['type'],
          'post_title' => basename($upload['file']),
          'post_content' => '',
          'post_status' => 'inherit',
        ),
        $upload['file'],
        $cotizacion_id
      );
      wp_update_attachment_metadata(
        $attachment_id,
        wp_generate_attachment_metadata($attachment_id, $upload['file'])
      );
      add_post_meta($cotizacion_id, 'anexos', $attachment_id);
    }
  }
  $response = array(
    'success'=> true,
    'ID'=> $cotizacion_id,
  );
  echo json_encode($response);
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
