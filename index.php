<?php


use core\db\DB;
use core\main\Product;
use core\main\Store;
use core\notmain\User;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
require_once "config/bootstrap.php";
require_once "vendor/autoload.php";
require_once "core/entity/main/Product.php";
require_once "core/entity/main/Store.php";
require_once "core/entity/notmain/User.php";

echo "\n--------SCRIPT START-------------------------------------------------------------------------\n";

$action = $argv[1];
if(empty($action)){
    echo "\n-------action not finde----------------------------------------------------------------------\n";
}
else{

    $enyitys = [
        'Product' => [ 'class' => Product::class, 'paths' => _DIR__ . "/../core/entity/main",    'db' =>DB::MAIN    ],
        'Store'   => [ 'class' => Store::class,   'paths' => _DIR__ . "/../core/entity/main",    'db' =>DB::MAIN    ],
        'User'    => [ 'class' => User::class,    'paths' => _DIR__ . "/../core/entity/notmain", 'db' =>DB::NOTMAIN ],
    ];
    $action  = explode(':',$action);
    $what    = $action[0];
    $who     = $action[1];
    $id      = $action[2];

    if(!isset($enyitys[$who])){throw new Exception(" -- not exist entity - {$who} --\n");}
    $config = Setup::createAnnotationMetadataConfiguration(array($enyitys[$who]['paths']),true);
    $em     = EntityManager::create( DB::getconfig($enyitys[$who]['db']), $config);
    if(!empty($id)){  $entity = $em->find($enyitys[$who]['class'], $id);  }

    switch ($what) {
        case 'delete':
            $em->remove($entity);
            $em->flush();
            break;
        case 'edit':
            $edit = $argv[2];
            $edit = explode(':',$edit);
            foreach ($edit as $item){
                $fild= explode('=',$item);
                $nameSet = "set".($fild[0]);
                $entity->$nameSet($fild[1]);
            }
            $em->persist($entity);
            $em->flush();
            break;
        case 'add':
            $class= $enyitys[$who]['class'];
            $entity = new $class();
            $edit = $argv[2];
            $edit = explode(':',$edit);
            foreach ($edit as $item){
                $fild= explode('=',$item);
                $nameSet = "set".($fild[0]);
                $entity->$nameSet($fild[1]);
            }
            $em->persist($entity);
            $em->flush();
            break;
        case 'print':
            $entity = $em->getRepository($enyitys[$what]['class'])->findBy(['id'=>$id]);
            if (empty($entity)) {  echo "No  found.\n"; }
            else{ var_dump($entity); echo "\n";}
            break;
        case 'print_all':
            $entity = $em->getRepository($enyitys[$who]['class'])->findAll();
            var_dump($entity); echo "\n";
            break;
        default:
            echo "\n\e[0;31;42-------action not finde------------------------------------------------------------------";
    }


}



echo "\n-------SCRIPT DONE---------------------------------------------------------------------------";

