<?php

return [

    'supportedLocales' => [
        
        'en'          => ['name' => 'English',                'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        
        'es'          => ['name' => 'Spanish',                'script' => 'Latn', 'native' => 'español', 'regional' => 'es_ES'],
        
    ],

    'useAcceptLanguageHeader' => true,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => [],

    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped'],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
