$db['default'] = array(
    'dsn'   => 'pgsql:host=db;port=5432;dbname=employeedb',
    'hostname' => 'db',
    'username' => 'postgres',
    'password' => 'postgres',
    'database' => 'employeedb',
    'dbdriver' => 'pdo',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
