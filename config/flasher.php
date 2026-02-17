<?php

return array(
    
    'default' => 'flasher',

    'root_script' => array(
        'cdn' => 'https://cdn.jsdelivr.net/npm/@flasher/flasher@1.3.2/dist/flasher.min.js',
        'local' => '/vendor/flasher/flasher.min.js',
    ),

    'styles' => array(
        'cdn' => 'https://cdn.jsdelivr.net/npm/@flasher/flasher@1.3.2/dist/flasher.min.css',
        'local' => '/vendor/flasher/flasher.min.css',
    ),

    'use_cdn' => true,

    'auto_translate' => true,

    'auto_render' => true,

    'flash_bag' => array(
        
        'enabled' => true,

        'mapping' => array(
            'success' => array('success'),
            'error' => array('error', 'danger'),
            'warning' => array('warning', 'alarm'),
            'info' => array('info', 'notice', 'alert'),
        ),
    ),

    'filter_criteria' => array(
        'limit' => 5, 
    ),
);
