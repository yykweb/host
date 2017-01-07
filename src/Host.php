<?php namespace yykweb\host;
use houdunwang\config\Config;
use yykweb\host\build\Base;
class Host
{
	protected $link;
	//更改缓存驱动
	protected function driver() {
		$this->link = new Base();
		$this->link->config( Config::get( 'west' ) );
		return $this;
	}


	public function __call( $method, $params ) {
		if ( is_null( $this->link ) ) {
			$this->driver();
		}
		if ( method_exists( $this->link, $method ) ) {
			return call_user_func_array( [ $this->link, $method ], $params );
		}
	}

	public static function __callStatic( $name, $arguments ) {
		return call_user_func_array( [ new static(), $name ], $arguments );
	}
}