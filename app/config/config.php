<?php
$option=1;
switch($option){
<<<<<<< HEAD
    case 1:$HOST="192.168.100.116";$USERNAME="user_rrhh";$PASSWORD="pass_rrhh";$DBNAME="bd_rrhh";break;
    case 2:$HOST="192.168.10.158";$USERNAME="user_rrhh";$PASSWORD="pass_rrhh";$DBNAME="bd_rrhh";break;
    case 3:$HOST="localhost";$USERNAME="oasisuser";$PASSWORD="oasispass";$DBNAME="bd_rrhh_pub";break;
=======
    case 1:$HOST="localhost";$USERNAME="user_rrhh";$PASSWORD="pass_rrhh";$DBNAME="bd_rrhh";break;
    /*case 1:$HOST="192.168.10.8";$USERNAME="user_rrhh";$PASSWORD="pass_rrhh";$DBNAME="bd_rrhh";break;*/
    case 2:$HOST="192.168.10.158";$USERNAME="user_rrhh";$PASSWORD="pass_rrhh";$DBNAME="bd_rrhh";break;
    case 3:$HOST="localhost";$USERNAME="oasisuser";$PASSWORD="oasispass";$DBNAME="bd_rrhh_proof";break;
>>>>>>> 37e04569f085281bcf2a1c97faf404466c75efa6
    default:$HOST="localhost";$USERNAME="oasisuser";$PASSWORD="oasispass";$DBNAME="bd_rrhh";
}
return new \Phalcon\Config(array(
   'database' => array(
        'adapter'     => 'Postgresql',
        'host'        => $HOST,
        'username'    => $USERNAME,
        'password'    => $PASSWORD,
        'dbname'      => $DBNAME
    ),
    'biometrico' => array(
        'adapter'     => 'Twm\Db\Adapter\Pdo\Mssql',
        'host'		=> '192.168.10.40',
        'username'	=> 'sa',
        'password'	=> 'Sistemas2015',
        'dbname'	=> 'asistencia',
        'pdoType'       => 'dblib',
        'dialectClass'	=> 'Twm\Db\Dialect\Mssql'
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
        // Cargar librería PHP Mailer
        'phpmailer'        => __DIR__ . '/../../app/libs/phpmailer/',
        'qrlib'        => __DIR__ . '/../../app/libs/qrlib/',
        //'t_pdf'        => __DIR__ . '/../../app/libs/fpdf/',
        'baseUri'        => '',
    )
));