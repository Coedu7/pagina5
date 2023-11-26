<?php

define("host", 'localhost');//localhost
define("user", 'root');//id21392514_admin
define("pass", "");//admiN12.
define("db", "concesionario");//id21392514_concesionario

$conec = mysqli_connect(host, user, pass, db);

if(!$conec){
    echo 'Error: ';
}else{
    //  echo 'conectado';
}

?>