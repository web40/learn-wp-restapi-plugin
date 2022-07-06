<?php 
/**
* Plugin Name: Learn WP Rest Api
* Plugin URI: http://yourdomain.com
* Description: Learn wp rest api
* Version: 1.0.0
* Author: Kenneth
* Author URI: http://yourdomain.com
* License: GPL2
*/?>
<?php
function my_endpoint_func($data){
    $parameters = $data->get_url_params();
    $get_option = get_option('c_url');
    if(!$get_option){
        return new WP_Error('option not found','Option does not exist',array(
            'status'=>404
        ));
    }

    return $get_option;
}
add_option('cv_url','mycvurlink');
function register_options_endpoint(){
    register_rest_route('my-profile/v1','/options/(?P<path>[\S]+)',array(
        'methods'=>'GET',
        'callback'=>'my_endpoint_func',
        'permission_callback'=>'__return_true',

    ));
}
add_action('rest_api_init','register_options_endpoint');
?>