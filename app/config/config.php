<?php

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Postgresql',
<<<<<<< HEAD
        'host'        => '192.168.10.158',
        'username'    => 'postgres',
        'password'    => 'miteleferico123',
=======
        'host'        => 'localhost',//192.168.10.158
        'username'    => 'user_rrhh',//postgres
        'password'    => 'pass_rrhh',//miteleferico123
>>>>>>> 9f964e2a2971495c96965c1ce02162c78f48af0e
        'dbname'      => 'bd_rrhh',
    ),
    'application' => array(
        'controllersDir' => __DIR__ . '/../../app/controllers/',
        'modelsDir'      => __DIR__ . '/../../app/models/',
        'viewsDir'       => __DIR__ . '/../../app/views/',
        'pluginsDir'     => __DIR__ . '/../../app/plugins/',
        'libraryDir'     => __DIR__ . '/../../app/library/',
        'cacheDir'       => __DIR__ . '/../../app/cache/',
        // Cargar librería fpdf
        'fpdf'        => __DIR__ . '/../../app/libs/fpdf/',
        'baseUri'        => '',
    )
));
