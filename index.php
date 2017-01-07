<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-01-07
 * Time: 15:28
 */
require 'vendor/autoload.php';

$data = array(
    "entityname"=>"vhost",
    "producttype"=>"b002",
    "years"=>"1",
    "ftpuser"=>"westdemo",
    "ftppassword"=>"password1000000022008555",
    "paytype"=>"1",
    "domain"=>'',
    "room"=>"11",
    "osver"=>"widnows2003",
    "iptype"=>"0",
    "ppricetemp"=>"198"
);

$type = array(

);

//$data = array(
//    "entityname"=>"domain-check",
//    "domainname"=>"test",
//    "suffix"=>".com,.cn"
//);

print_r(\yykweb\host\Host::get("add",$data,'201701070001'));