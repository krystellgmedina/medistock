<?php
namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    public $default = [
        'DSN'      => '',
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => '',
        'DBDriver' => 'Postgre',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 5432,
    ];

    public function __construct()
    {
        parent::__construct();

        // Check for DATABASE_URL (Railway)
        if ($url = getenv('DATABASE_URL')) {
            $db = parse_url($url);
            
            $this->default['hostname'] = $db['host'] ?? '';
            $this->default['username'] = $db['user'] ?? '';
            $this->default['password'] = $db['pass'] ?? '';
            $this->default['database'] = ltrim($db['path'] ?? '', '/');
            $this->default['port'] = $db['port'] ?? 5432;
        }
    }
}
