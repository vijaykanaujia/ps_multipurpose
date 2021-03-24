<?php

$sqls = [];

$sqls[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'multipurpose`(
    `id` INT(10) AUTO_INCREMENT PRIMARY KEY, `name` TEXT NOT NULL, `email` VARCHAR(255) NOT NULL, `avatar_url` TEXT
) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8';

foreach($sqls as $sql)
    if(!DB::getInstance()->execute($sql))
        return false;

