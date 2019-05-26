<?php
// bootstrap.php
use core\db\DB;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";
require_once "core/db/DB.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;

$dbs = [
    'main'     => __DIR__ . "/../core/entity/main",
    'notmain'  => __DIR__ . "/../core/entity/notmain",
];
$db_name = 'main';
foreach ($argv as $key => $arg){
    if(strpos($arg, 'db:') === false){continue;}
    $data_db = explode(':',$arg);
    $db_name = $data_db[1];
    if($data_db[0] == 'db' && !empty($db_name)){
        if(in_array($db_name,array_keys($dbs))){
            unset($GLOBALS['argv'][$key]);
            $GLOBALS['argc'] = $GLOBALS['argc']-1;
            unset($_SERVER['argv'][$key]);
            $_SERVER['argc'] = $_SERVER['argc']-1;
        }
        else{
            throw new Exception("Not exist db:".$db_name);
        }
    }
}

$paths = $dbs[$db_name] ?? $dbs['main'];
$config = Setup::createAnnotationMetadataConfiguration(array($paths), $isDevMode);


// obtaining the entity manager
$em = EntityManager::create( DB::getconfig($db_name), $config);