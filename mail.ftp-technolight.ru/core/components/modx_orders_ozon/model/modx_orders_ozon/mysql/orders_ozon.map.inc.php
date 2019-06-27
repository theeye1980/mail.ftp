<?php
$xpdo_meta_map['orders_ozon']= array (
  'package' => 'modx_orders_ozon',
  'version' => '1.1',
  'table' => 'modx_orders_ozon',
  'extends' => 'xPDOSimpleObject',
  'tableMeta' => 
  array (
    'engine' => 'MyISAM',
  ),
  'fields' => 
  array (
    'ozon_id' => 0,
    'goods_xml_up' => 0,
    'prices_up' => 0,
    'stocks_up' => 0,
    'update_page' => 0,
    'tester' => 0,
  ),
  'fieldMeta' => 
  array (
    'ozon_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'goods_xml_up' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'prices_up' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'stocks_up' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'update_page' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'tester' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
);
