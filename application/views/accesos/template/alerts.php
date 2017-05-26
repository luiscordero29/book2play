<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    if (!empty($alert['success'])) {
        foreach ($alert['success'] as $key => $value) {                           
            echo '<div class="alert alert-success">'.$value.'</div>';
        }
    }
    if (!empty($alert['info'])) {
        foreach ($alert['info'] as $key => $value) {                           
            echo '<div class="alert alert-info">'.$value.'</div>';
        }
    } 
    if (!empty($alert['warning'])) {
        foreach ($alert['warning'] as $key => $value) {                           
            echo '<div class="alert alert-warning">'.$value.'</div>';
        }
    } 
    if (!empty($alert['danger'])) {
        foreach ($alert['danger'] as $key => $value) {                           
            echo '<div class="alert alert-danger">'.$value.'</div>';
        }
    } 
?>