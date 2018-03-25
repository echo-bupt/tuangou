<?php if(!defined('HDPHP_PATH'))exit;
return array (
  'adname' => 
  array (
    'field' => 'adname',
    'type' => 'varchar(20)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'password' => 
  array (
    'field' => 'password',
    'type' => 'varchar(40)',
    'null' => 'NO',
    'key' => false,
    'default' => NULL,
    'extra' => '',
  ),
  'uid' => 
  array (
    'field' => 'uid',
    'type' => 'int(10)',
    'null' => 'NO',
    'key' => true,
    'default' => NULL,
    'extra' => '',
  ),
);
?>