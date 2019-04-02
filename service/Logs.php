<?php
class Logs {
    public function addLog($params = '') {
        $params = is_array($params) ? json_encode($params) : $params;
        //要创建的两个文件
    $TxtFileName = __DIR__.'/../logs/rpc.'.date('Y_m_d').'.txt';
    //return $TxtFileName;
    $oper = 'a+'; // 'w+'覆盖文件  'a+' 追加文件
    //以读写方式打写指定文件，如果文件不存则创建
    if( ($TxtRes=fopen ($TxtFileName,$oper)) === FALSE){
        echo("创建可写文件：".$TxtFileName."失败");
        return false;
    }

    if($params) {
        $content  = print_r($params, true);//要写进文件的内容
        $content =  $content.'  【'.date('Y-m-d H:i:s')."】\r\n";
    } else {
        $content = 'non-params'."  【".date('Y-m-d H:i:s')."】\r\n";
    }
    if(!fwrite ($TxtRes,$content)){ //将信息写入文件
        //echo ("尝试向文件".$TxtFileName."写入".$content."失败！");
        fclose($TxtRes);
        return false;
    }
    //echo ("尝试向文件".$TxtFileName."写入".$StrConents."成功！");
    fclose ($TxtRes); //关闭指针
    return true;
    }
}

