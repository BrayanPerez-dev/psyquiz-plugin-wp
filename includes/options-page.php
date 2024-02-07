<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'load_carbon_fiedls');
add_action('carbon_fields_register_fields', 'crb_attach_theme_options');


function load_carbon_fiedls()
{
    \Carbon_Fields\Carbon_Fields::boot();
}
function crb_attach_theme_options()
{
    Container::make('theme_options', __('Psyquiz'))
    ->set_icon('dashicons-feedback')
        ->add_fields(array(
            Field::make('checkbox', 'psyquiz_plugin_active', __('Activo'))        
        ));
}
