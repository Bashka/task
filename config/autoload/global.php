<?php
return [
  'db' => [
    'driver'         => 'Pdo',
    'dsn'            => 'mysql:dbname=zf2;host=localhost',
    'driver_options' => [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
    ],
  ],
  'service_manager' => [
    'factories' => [
      'ZendDbAdapterAdapter'
      => 'Zend\Db\Adapter\AdapterServiceFactory',
    ],
  ],
];
