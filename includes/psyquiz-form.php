<?php

use bussines\Quiz;

include MY_PLUGIN_PATH . '/includes/bussines/Quiz.php';

add_shortcode('psyquiz', 'show_psyquiz_form');
add_action('rest_api_init', 'create_rest_endpoint');
add_action('rest_api_init', 'create_rest_endpoint_save');
add_action('init', 'create_submissions_page');
add_action('add_meta_boxes', 'create_meta_boxes');
add_filter('manage_submission_posts_columns', 'custom_submission_columns');
add_filter('manage_submission_posts_custom_column', 'fill_submission_columns', 10, 2);
add_action('admin_init','setup_search');

function setup_search(){
    global $typenow;
    if($typenow === 'submission'){
        add_filter('posts_search', 'submission_search_override', 10, 2);
 
    }
}

function submission_search_override($search,$query){
    global $wpdb;

    if ($query->is_main_query() && !empty($query->query['s'])) {
        $sql    = "
          or exists (
              select * from {$wpdb->postmeta} where post_id={$wpdb->posts}.ID
              and meta_key in ('name','email','form','score')
              and meta_value like %s
          )
      ";
        $like   = '%' . $wpdb->esc_like($query->query['s']) . '%';
        $search = preg_replace(
              "#\({$wpdb->posts}.post_title LIKE [^)]+\)\K#",
              $wpdb->prepare($sql, $like),
              $search
        );
  }

  return $search;
}
function fill_submission_columns($column, $post_id)
{
    switch ($column) {
        case 'name':
            echo esc_html(get_post_meta($post_id, 'name', true));
            break;
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'score':
            echo esc_html(get_post_meta($post_id, 'score', true));
            break;
        case 'form':
            echo esc_html(get_post_meta($post_id, 'form', true));
            break;
        default:
            echo esc_html(get_post_meta($post_id, 'name', true));
            break;
    }
}

function custom_submission_columns($columns)
{
    $columns = array(
        'cb' => $columns['cb'],
        'name' => __('Name', 'psyquiz-plugin'),
        'email' => __('Email', 'psyquiz-plugin'),
        'score' => __('Resultado', 'psyquiz-plugin'),
        'form' => __('Formulario', 'psyquiz-plugin'),
    );
    return $columns;
}

function create_meta_boxes()
{
    add_meta_box('custom_contact_form', 'Test Psicologico', 'display_submission', 'submission');
}

function display_submission()
{
    $post_metas = get_post_meta(get_the_ID());
    unset($post_metas['_edit_lock']);
    echo '<ul>';

    foreach ($post_metas as $key => $value) {
        echo '<li><strong>' . $key . '</strong>:<br /> ' . $value[0] . '</li>';
    }
    echo '</ul>';
}

function create_submissions_page(): void
{
    $args = [
        'public' => true,
        'has_archive' => true,
        'labels' => [
            'name' => 'Test Psicologicos',
            'singular_name' => 'Test Psicologico'
        ],
        'capability_type' => 'post',
        'capabilities' => ['create_posts' => 'do_not_allow'],
        'map_meta_cap' => true,
        'supports' => false
    ];
    register_post_type('submission', $args);
}
function show_psyquiz_form($atts)
{
    $atts = shortcode_atts(
        array(
            'type' => 'ESCALA_DEPRESION_BECK',
        ),
        $atts,
        'psyquiz'
    );

    // Acceder a los parámetros
    $type = $atts['type'];

    ob_start(); // Inicia el almacenamiento en búfer de salida
    include MY_PLUGIN_PATH . '/includes/templates/psyquiz-form-template.php';
    $content = ob_get_clean(); // Obtiene y limpia el contenido del búfer de salida

    // Envuelve el contenido en un div
    $output = '<div class="container">' . $content . '</div>';
    enqueue_psyquiz_script($type);
    return $output;
}


function create_rest_endpoint()
{
    register_rest_route('v1/psyquiz-form', 'submit', array(
        'methods' => 'POST',
        'callback' => 'handle_enquiry'
    ));
}


function handle_enquiry($data)
{
    $params = $data->get_params();
    if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {
        return new WP_REST_Response('Data not sent', 422);
    }

    unset($params['_wpnonce']);
    unset($params['_wp_http_referrer']);
    $response_data = array();
    $scoreResult = 0;
    $textScore = '';
    if ($params['form_type'] === 'ESCALA_DEPRESION_BECK') {

        foreach ($params['scores'] as $key => $value) {
            $scoreResult += $value;
        }

        if ($scoreResult >= 1 && $scoreResult <= 10) {
            $textScore = 'Estos altibajos son considerados normales';
        }
        if ($scoreResult >= 11 && $scoreResult <= 16) {
            $textScore = 'Leve perturbación del estado de animo';
        }
        if ($scoreResult >= 17 && $scoreResult <= 20) {
            $textScore = 'Estados de depresion intermitentes';
        }
        if ($scoreResult >= 21 && $scoreResult <= 30) {
            $textScore = 'Depresion moderada';
        }
        if ($scoreResult >= 31 && $scoreResult <= 40) {
            $textScore = 'Depresion grave';
        }
        if ($scoreResult > 40) {
            $textScore = 'Depresion extrema ';
        }

        $response_data = array('textScore' => $textScore);
    } else {
        foreach ($params['scores'] as $key => $value) {
            $scoreResult += $value;
        }

        if ($scoreResult >= 0 && $scoreResult <= 4) {
            $textScore = 'Ausencia o grado minimo de ansiedad';
        }
        if ($scoreResult >= 5 && $scoreResult <= 10) {
            $textScore = 'Ansiedad limite';
        }
        if ($scoreResult >= 11 && $scoreResult <= 20) {
            $textScore = 'Ansiedad leve';
        }
        if ($scoreResult >= 21 && $scoreResult <= 30) {
            $textScore = 'Ansiedad moderada';
        }
        if ($scoreResult >= 31 && $scoreResult <= 50) {
            $textScore = 'Ansiedad intensa';
        }
        if ($scoreResult > 51) {
            $textScore = 'Ansiedad extremadamente intensa o estado de panico';
        }
        $response_data = array('textScore' => $textScore);
    }

    wp_send_json_success($response_data);
}
function create_rest_endpoint_save()
{
    register_rest_route('v1/psyquiz-form', 'save', array(
        'methods' => 'POST',
        'callback' => 'handle_enquiry_save'
    ));
}

function handle_enquiry_save($data)
{
    $params = $data->get_params();
    if (!wp_verify_nonce($params['_wpnonce'], 'wp_rest')) {
        return new WP_REST_Response('Data not sent', 422);
    }

    unset($params['_wpnonce']);
    unset($params['_wp_http_referrer']);

    $postarr = [
        'post_title' => $params['name'],
        'post_type' => 'submission',
    ];

    $post_id = wp_insert_post($postarr);
    foreach ($params as $label => $value) {
        add_post_meta($post_id, $label, sanitize_text_field( $value ));
    }
    return new WP_REST_Response('Informacion gurdada', 200);
}
function enqueue_psyquiz_script($type)
{
    // Asegúrate de que estás en la página donde se muestra el shortcode 'psyquiz'

    if (is_page() || is_single()) {
        // Registra tu script personalizado

        // Obtén los datos antes de encolar el script
        $quiz = new Quiz($type);
        $statements = $quiz->get_statements();
        if ($type === 'ESCALA_DEPRESION_BECK') {
          
            echo '<script type="text/javascript">';
            echo 'var quizData = ' . json_encode(array(
                'form_title' => 'ESCALA DE DEPRESION DE BECK',
                'statements' => $statements,
                'form_type' => $type,
            )) . ';';
            echo '</script>';
        }

        if ($type === 'ANSIEDAD_DE_BURNS') {
           
            echo '<script type="text/javascript">';
            echo 'var quizData = ' . json_encode(array(
                'form_title' => 'CUESTIONARIO DE ANSIEDAD DE BURNS',
                'statements' => $statements,
                'form_type' => $type,
            )) . ';';
            echo '</script>';
        }
        // Encola el script después de haber localizado los datos
    }
}
