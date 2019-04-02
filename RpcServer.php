<?php
class RpcServer {
    protected $serv = null;
 
    public function __construct($host, $port, $path) {
        //创建一个tcp socket服务
        $this->serv = stream_socket_server("tcp://{$host}:{$port}", $errno, $errstr);
        if (!$this->serv) {
            exit("{$errno} : {$errstr} \n");
        }
        //判断我们的RPC服务目录是否存在
        // exit(__DIR__);
        $realPath = realpath(__DIR__ . $path);
        if ($realPath === false || !file_exists($realPath)) {
            exit("{$path} error \n");
        }
 
        while (true) {
            $client = stream_socket_accept($this->serv);
            if ($client) {
                //这里为了简单，我们一次性读取
                $buf = fread($client, 3024);
                //解析客户端发送过来的协议
                //注意win客户端使用 ';\r\n/i’  linux使用 ';\n/i'
                $classRet = preg_match('/Rpc-Class:\s(.*);\n/i', $buf, $class);
                $methodRet = preg_match('/Rpc-Method:\s(.*);\n/i', $buf, $method);
                $paramsRet = preg_match('/Rpc-Params:\s(.*);\n/i', $buf, $params);
                
                if($classRet && $methodRet) {
                   
                    $class = ucfirst($class[1]);
                    $file = $realPath . '/' . $class . '.php';
                    //判断文件是否存在，如果有，则引入文件
                    if(file_exists($file)) {
                        require_once $file;
                        //实例化类，并调用客户端指定的方法
                        $obj = new $class();
                        $data = $params[1] == '[""]' ? $obj->$method[1]() : $obj->$method[1]($params[1]);
                        //把运行后的结果返回给客户端
                        fwrite($client, $data);
                    }
                } else {
                    fwrite($client, 'class or method error');
                }
                //关闭客户端
                fclose($client);
            }
        }
    }
 
    public function __destruct() {
        fclose($this->serv);
    }
}
 
new RpcServer('0.0.0.0', 19001, '/service');
