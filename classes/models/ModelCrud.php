<?php

class ModelCrud extends ObjectModel
{
    public $id;
    public $name;
    public $email;
    public $avatar_url;

    public static $definition = [
        'table'     => 'multipurpose',
        'primary'   => 'id',
        'multilang' => false,
        'fields'    => [
            'id'           => ['type' => self::TYPE_INT, 'validate' => 'isInt'],
            'name'         => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => false],
            'email'        => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => false],
            'avatar_url'   => ['type' => self::TYPE_STRING, 'db_type' => 'varchar(255)', 'lang' => false],
        ],
    ];

    public static $img_dir = _PS_IMG_DIR_ . 'multipurpose';

    /**
     * override add function of ObjectModel
     */
    public function add($autoDate = true, $nullValues = true)
    {
        return parent::add($autoDate, $nullValues);
    }

    /**
     * override delete function of ObjectModel
     */
    public function delete()
    {
        return parent::delete();
    }
}
