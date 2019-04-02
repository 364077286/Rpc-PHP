# Rpc-PHP<br/>
rpc &amp; php<br/>

php构建Rpc自定义服务(rpclog)<br/>
实现远程过程调用<br/>
<br/>
├── logs                          <br/>
│   └── rpc.2019_03_27.txt        //生成当天日志文件<br/>
├── nohup.out                     <br/>
├── RpcClient.php                 //客户端<br/>
├── RpcServer.php                 //rpc服务端<br/>
└── service                       //自定义服务文件夹<br/>
│   └── Logs.php                  //自定义rpclog类<br/>
<br/>
<br/>
> nohub php RpcServer.php &     //开启服务端<br/>
> php RpcClient.php             //测试<br/>
