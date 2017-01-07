<?php
namespace yykweb\host;
use houdunwang\framework\build\Provider;

class HostProvider extends Provider
{
    //延迟加载
    public $defer = true;

    public function boot() {
    }

    public function register() {
        $this->app->single( 'Host', function (  ) {
            return new Host(  );
        } );
    }
}