<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Postgresql',
<<<<<<< HEAD:app/config/config.php
//<<<<<<< HEAD
        'host'        => '192.168.10.158',
        'username'    => 'postgres',
        'password'    => 'miteleferico123',
/*=======
//<<<<<<< HEAD
        'host'        => '192.168.10.158',//localhost
        'username'    => 'postgres',//
        'password'    => 'miteleferico123',//
>>>>>>> db80774594067c1505034cca13f56757e3300c95*/
=======
<<<<<<< HEAD:app/config/config.php
        'host'        => '192.168.10.158',//localhost
        'username'    => 'postgres',//
        'password'    => 'miteleferico123',//
=======
        'host'        => 'localhost',
        'username'    => 'postgres',
        'password'    => '8209125',
>>>>>>> ca92e56d412460b7c7927d51f63207f732117dbc:app/config (copia)/config.php
>>>>>>> 42db72e6ac93905f60d9a0c57c8435320bf943d7:app/config (copia)/config.php
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
        //'t_pdf'        => __DIR__ . '/../../app/libs/fpdf/',
        'baseUri'        => '',
    )
));
