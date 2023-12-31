<?php

if (!defined('BASEPATH')) EXIT("No direct script access allowed");

if (!function_exists('common_viewloader')) 
{
    function common_viewloader($viewfilepath = '', $param = array(),$title='')
    {
        $CI = &get_instance();
        $data = array();
        $data['title'] = $title;
        $CI->load->view('common/header');
        $CI->load->view('common/sidebar');

        if ($viewfilepath != '') 
        {
            $CI->load->view($viewfilepath, $param);
        }

        $CI->load->view('common/footer');
    }
}

if (!function_exists('pr')) 
{
    function pr($display_data = array()) 
    {
        if (!empty($display_data)) 
        {
            echo "<pre>";

            print_r($display_data);

            echo "</pre>";
        }
    }
}

?>