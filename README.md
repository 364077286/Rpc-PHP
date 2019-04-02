# Rpc-PHP
rpc &amp; php

php构建Rpc自定义服务(rpclog)
实现远程过程调用

├── logs                          <br/><br/>
│   └── rpc.2019_03_27.txt        //生成当天日志文件<br/>
├── nohup.out                     <br/>
├── RpcClient.php                 //客户端
├── RpcServer.php                 //rpc服务端
└── service                       //自定义服务文件夹
    └── Logs.php                  //自定义rpclog类


> nohub php RpcServer.php &     //开启服务端
> php RpcClient.php             //测试
