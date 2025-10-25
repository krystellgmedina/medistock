<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'cors'     => \App\Filters\Cors::class,
    ];

    public $globals = [
        'before' => [
            'cors',
            // 'csrf'   // <-- si deseas activar CSRF para web forms, actívalo aquí y maneja tokens en frontend
        ],
        'after' => [
            'toolbar',
        ],
    ];

    // ...existing code...
    // Eliminamos la aplicación automática de CSRF por método para que las llamadas AJAX funcionen
    public $methods = [
        // 'post' => ['csrf'],
        // 'put' => ['csrf'],
        // 'delete' => ['csrf']
    ];
}
