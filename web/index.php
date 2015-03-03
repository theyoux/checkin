<?php
use Csanquer\Silex\PdoServiceProvider\Provider\PdoServiceProvider;

require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application(); 

$app->register(
    // you can customize services and options prefix with the provider first argument (default = 'pdo')
    new PdoServiceProvider('pdo'),
    array(
        'pdo.server'   => array(
            // PDO driver to use among : mysql, pgsql , oracle, mssql, sqlite, dblib
            'driver'   => 'mysql',
            'host'     => 'localhost',
            'dbname'   => 'checkin',
            'port'     => 3306,
            'user'     => 'root',
            'password' => '',
        ),
        // optional PDO attributes used in PDO constructor 4th argument driver_options
        // some PDO attributes can be used only as PDO driver_options
        // see http://www.php.net/manual/fr/pdo.construct.php
        'pdo.options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
        ),
        // optional PDO attributes set with PDO::setAttribute
        // see http://www.php.net/manual/fr/pdo.setattribute.php
        'pdo.attributes' => array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ),
    )
);

$app['pdo']->query('show tabsdfles');
$app->get('/hello/{name}', function($name) use($app) { 
    return 'Hello '.$app->escape($name); 
}); 

$app->run(); 
