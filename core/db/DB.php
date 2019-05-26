<?php

namespace core\db;

class DB
{
    const MAIN    = 'main';
    const NOTMAIN = 'notmain';

    public static function getconfig($name):array
    {
        if(in_array($name,[self::MAIN,self::NOTMAIN])){
            return self::$name();
        }
        else{
            return self::main();
        }

    }

    public static function main(): array
    {
        return [
            'driver'   => 'pdo_mysql',
            'user'     => 'buh',
            'password' => 'buh',
            'dbname'   => 'main',
        ];
    }

    public static function notmain():array
    {
        return [
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => 'root',
            'dbname'   => 'notmain',
        ];
    }

}