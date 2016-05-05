<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>主页</title>
    <link href="<?php echo $this->config->item('base_url').'/public/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/login/js/jquery-1.7.2.min.js">
    </script>
    <style>
        body{
            background: #f1f1f1;
        }
    </style>
</head>
<body>
<div class="container">
    <!--导航开始-->
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
                    <?php if($realName!=''){?>
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
    <!--导航结束-->

    <HR style="border:3px double #987cb9; width='80%';color=#987cb9; SIZE=3">
    <!--添加接口开始-->
    <div class="row clearfix" style="margin-top: 20px">
        <div class="col-md-12 column">
            <form id="form2" name="form2" method="post" action="<?php echo $this->config->item('base_url').'/jiekou/Index/dataHandle';?>">
                <div class="form-group">
                    <label for="exampleInput">接口名称<i>*</i></label>
                    <input type="text" class="form-control" id="interfaceName" name="interfaceName" style="width: 20%" placeholder="请输入接口名称"/>
                </div>
                <div class="form-group">
                    <label for="exampleInput">接口地址<i>*</i></label>
                    <input type="text" class="form-control" id="interfaceUrl"name="interfaceUrl" style="width: 60%" placeholder="参考格式：bwww.bl.com/admincp/Mainuser   请以？结尾，以便参数拼接"/>
                </div>
                <div class="form-group">
                    <label for="exampleInput">是否需要登录<i>*</i></label>
                    <select name="isLogin" class="form-control" style="width: 20%">
                        <option value="0">无需登陆</option>
                        <option value="1">必须登陆</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInput">所属分类<i>*</i></label>
                    <select name="tId" class="form-control" style="width: 20%">
                        <?php if(!empty($list)) foreach($list as $v){?>
                        <option value="<?php echo $v['tId']?>"><?php echo $v['typeName']?></option>
                        <?php }?>
                    </select>
                </div>
                <HR style="border:3px double #987cb9; width='80%';color=#987cb9; SIZE=3">
                <div style=" float: right;margin-top: 20px; ">
            <button type="button" id="addOneRow" class="btn btn-success" style="">新增参数</button>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>
                        参数名<i>*</i>
                    </th>
                    <th>
                        参数值<i>*</i>
                    </th>
                    <th>
                        操作<i>*</i>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="text" id="name" name="paramName[]" class="form-control" style="width: 200px" placeholder="请输入准确的参数名！"/>
                    </td>
                    <td>
                        <input type="text" id="name" name="paramValue[]" class="form-control" style="width: 200px" placeholder="请输入准确的参数值！"/>
                    </td>
                    <td>
                        <input type="button" class="delOneRow btn btn-danger"value="删除" />
                    </td>
                </tr>
                </tbody>
            </table>
                <div style=" float: right;margin-top: 20px; ">
                    <button type="submit" class="btn btn-primary" >提交参数</button>
                </div>
            </form>
        </div>
    </div>
    <!--添加结束-->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#addOneRow").click(function() {
            var tempTr =$("tbody").find("tr:first").clone(true);
            $("tr:last").after(tempTr);
            $("tr:last > td > #name").val("");//新添加行name为空
            $("tr:last > td > #address").val("");//新添加行address为空
        });
        $(".delOneRow").click(function() {
            if ($("tr").length < 2) {
                alert("至少保留一行!");
            } else {
                if (confirm("确认删除?")) {
                    $(this).parent().parent().remove();
                }
            }
        });
    });
</script>
</body>
</html>