<?php
return [
  'debug' => true,

  'DebugKit' => [
    'safeTld' => [
    ],
  ],

  'App' => [
    'fullBaseUrl' => sprintf('http://%s', env('VIRTUAL_HOST')),
    'contact' => [
      'googleFormUrl' => '',
    ],
  ],

  'Security' => [
    'salt' => 'securitysalt',
  ],

  'Twitter' => [
    'meta' => [
      'site' => '',
    ],
  ],

  'Datasources' => [
    'default' => [
      'host' => 'mysql-server',
      'username' => 'root',
      'password' => env('MYSQL_ROOT_PASSWORD'),
      'database' => 'novis_hub',
      'log' => true,
    ],
  ],

  'Session' => [
    'defaults' => 'cake',
    'timeout' => 525600,
    'ini' => [
      'session.cookie_lifetime' => 31536000,
    ],
  ],
];

