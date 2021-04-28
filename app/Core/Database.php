<?php


namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{

    public $capsule;
    public $schema;

    public function __construct()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
          'driver'    => 'mysql',
          'host'      => $_ENV['DB_HOST'] ?? '127.0.0.1',
          'port'      => $_ENV['DB_PORT'] ?? '3306',
          'database'  => $_ENV['DB_NAME'] ?? 'mvc',
          'username'  => $_ENV['DB_USER'] ?? 'root',
          'password'  => $_ENV['DB_PASSWORD'] ?? '',
          'charset'   => 'utf8',
          'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->bootEloquent();
        $this->capsule->setAsGlobal();
        $this->schema = $this->capsule->schema();
   }
}