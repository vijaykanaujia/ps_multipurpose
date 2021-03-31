<?php

class ModelCrud extends ObjectModel
{
    public static $definition = [
        'table'     => 'multipurpose',
        'primary'   => 'id',
        'multilang' => true,        
        'fields'    => [
            'id'           => ['type' => self::TYPE_INT, 'validate' => 'isInt'],
            'name'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => true],
            'enail'        => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => true],            
            'avatar_url'   => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => true],
        ],
    ];

    public $id;
    public $name;
    public $email;
    public $avatar_url;    
}
