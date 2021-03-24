<?php

$sqls = [];

$sqls[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'multipurpose`';

foreach($sqls as $sql)
    if(!DB::getInstance()->execute($sql))
        return false;