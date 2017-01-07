<?php
namespace yykweb\host\build;
use houdunwang\log\Log;

class Base
{
    protected $config = [ ];

    //初始配置
    public function config( $config ) {
        $this->config = $config;
    }

    //开始请求
    /**
     * @param $api_type
     * @param $api_data
     * @return \SimpleXMLElement|string
     */
    public function get( $api_type,$api_data,$order_id) {
        //构造要请求的参数数组，无需改动//获取API接口请求配置项
        $data = [
            "api_url"       => $this->config['api_url'],
            "api_user"      => $this->config['api_user'],
            "api_pass"      => $this->config['api_pass']
        ];
        $api = '';
        switch($api_type)
        {
            case 'add':
                $api = "vhost\r\nadd\r\n";
                break;
            case 'mod':
                $api = "vhost\r\nmod\r\n";
                break;
            case 'renewal':
                $api = "vhost\r\nrenewal\r\n";
                break;
            case 'paytest':
                $api = "vhost\r\npaytest\r\n";
                break;
            case 'set':
                $api = "vhost\r\nset\r\n";
                break;
            case 'get':
                $api = "vhost\r\nget\r\n";
                break;
        }
        //数组拼接字符串
        $api .= $this->create_string($api_data)."."."\r\n";
        //建立请求
        $md5 = md5($data['api_user'].$data['api_pass'].substr($api,0,10));
        $post_url = $data['api_url']."?userid=".$data['api_user']."&versig=".$md5."&strCmd=".urlencode($api);
        $return = file_get_contents($post_url);
        $xml = simplexml_load_string($return);
        if($xml->returncode != '200')
        {
            Log::write("Error:".iconv( "UTF-8", "gb2312//IGNORE" , $xml->returnmsg)."\t".iconv("UTF-8","gb2312//IGNORE","订单号：").$order_id."\r\n",Log::ERROR);
            return "提交失败！请联系管理员！";
        }
        return json_decode(json_encode(simplexml_load_string($return)),TRUE);
    }

    //数组转字符串
    private function create_string($para)
    {
        $arg  = "";
        while (list ($key, $val) = each ($para)) {
            $arg.=trim($key).":".trim($val)."\r\n";
        }
        //去掉最后一个&字符
        //$arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        //if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;
    }
}