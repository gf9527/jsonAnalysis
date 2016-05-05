<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>返回数据页面</title>
    <link href="<?php echo $this->config->item('base_url').'/public/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/login/js/jquery-1.7.2.min.js">
    </script>
</head>
<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="<?php echo $this->config->item('base_url').'/jiekou/Index/index';?>">API调试</a>
                </div>
                <?php
                $realName = $this->session->userdata('realName');
                ?>
                <ul class="nav navbar-nav" style="float: right">
                    <?php if(isset($realName)){?>
                        <li>
                            <a href="#" style="color: #003399;font-size: 18px"><?php echo $realName;?></a>
                        </li>
                    <?php }?>
                    <li>
                        <a href="<?php echo $this->config->item('base_url').'/jiekou/Index/paramlist';?>">接口列表</a>
                    </li>
                    <?php if(isset($realName)){?>
                        <li>
                            <a href="<?php echo $this->config->item('base_url').'/jiekou/Login/loginOut';?>" class="btn btn-danger">注销</a>
                        </li>
                    <?php }else{?>
                        <li>
                            <a href="<?php echo $this->config->item('base_url').'/jiekou/Login/index';?>" style="color: red">登录</a>
                        </li>
                    <?php }?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12 column">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">接口名称：</label>
                    <div class="col-sm-10">
                        <?php echo $info['interfaceName'];?>
                        <?php echo $this->session->userdata('userName');?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">接口Url：</label>
                    <div class="col-sm-10">
                        <?php echo $newurl;?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否需要登录参数：</label>
                    <div class="col-sm-10">
                        <?php echo ($info['isLogin']==1)? '是' : '否';?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">参数详情：</label>
                    <?php
                    foreach($jsonlist as $k=>$v)
                    {?>
                    <div class="col-sm-10">
                        <?php
                        echo $k.':&nbsp;'.$v ;
                        ?>
                    </div>
                    <?php }?>

                </div>
            </form>
        </div>

    </div>
    <HR style="border:3px double #987cb9; width='80%';color=#987cb9; SIZE=3">
    <div class="row clearfix" style="padd   ing-top: 30px">
        <div class="col-md-12 column">
            <label class="col-sm-2 control-label">JSON数据：</label>
            <blockquote>
                <p>
                    <?php var_dump(json_encode($returnData));?>
                </p>
            </blockquote>
            <label class="col-sm-2 control-label">数组格式：</label>
            <blockquote>
                <p>
                    <?php
                    $returnData = json_decode($returnData);
                    $arr =(array)$returnData;
                    var_dump($arr);
                    ?>
                </p>
            </blockquote>
        </div>
    </div>
</div>
</body>
</html>