<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Postgresql',
<<<<<<< HEAD:app/config/config.php
        'host'        => '192.168.10.158',//localhost
        'username'    => 'postgres',//
        'password'    => 'miteleferico123',//
=======
        'host'        => 'localhost',
        'username'    => 'postgres',
        'password'    => '8209125',
>>>>>>> ca92e56d412460b7c7927d51f63207f732117dbc:app/config (copia)/config.php
        'dbname'      => 'bd_rrhh',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        'baseUri'        => '   ',
        // Cargar librería fpdf
        'fpdf'        => __DIR__ . '/../../app/libs/fpdf/',
        'baseUri'        => '',
    )
));
