<?php

/*return         [
    'class' => 'apaoww\oci8\Oci8DbConnection',
    'dsn' => 'oci8:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=192.168.0.14)(PORT=1521))(CONNECT_DATA=(SID=orcl)));charset=AL32UTF8;', // Oracle
    'username' => 'CARPOOLNOW',
    'password' => 'ILikeCarpools',
    'attributes' => [
        PDO::ATTR_STRINGIFY_FETCHES => true,
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_PERSISTENT => true
    ]

];*/

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=carpoolnowdb',
    'username' => 'carpoolnowdb',
    'password' => 'Duip34jitjit-',
    'charset' => 'utf8',
];
