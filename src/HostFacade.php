<?php
namespace yykweb\host;
use houdunwang\framework\build\Facade;

class HostFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'Host';
    }
}