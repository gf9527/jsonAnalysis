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
					<?php if($realName != ''){?>
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
	<!--警告框开始-->
	<div class="row clearfix" id="waraning" style="display: none">
		<div class="col-md-12 column">
			<div class="alert alert-dismissable alert-danger" id="waraningtext">
			</div>
		</div>
	</div>
	<!--警告框结束-->
	<!--添加分类开始-->
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form class="form-horizontal" name="typeform" id="typeform" action="<?php echo $this->config->item('base_url').'/jiekou/Interfacetype/doadd';?>" method="post">
				<div class="form-group">
					<label class="col-sm-1 control-label">添加分类</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="typeName" name="typeName"/>
					</div>
					<button type="submit" class="btn btn-primary" onclick="javascript:return checkButton()">确认添加</button>
					<button type="button" class="btn btn-default" style="float: right;margin-right: 20px" onclick="javascript:return show_div()">显示隐藏</button>
				</div>

			</form>
		</div>
	</div>
	<script type="text/javascript">
		function checkButton()
		{
			var typeName = $('#typeName').val();
			if(typeName == '')
			{
				waraning('<strong>错误：</strong>  分类不能为空');return false;
			}

			$('#typeform').submit(function (){
				$(this).serialize();
			});
		}

		function waraning(a)
		{
			$('#waraningtext').html(a);
			$('#waraning').show();
			window.scrollTo(0,0);
		}
		function show_div(){
			var obj_div=document.getElementById("typetable");
			obj_div.style.display=(obj_div.style.display=='none')?'block':'none';
		}
	</script>

	<div class="row clearfix" style="padding-top: 30px; display: none" id="typetable">
		<div class="col-md-12 column">
			<table class="table table-striped">
				<thead>
				<tr>
					<th align="center">
						分类ID
					</th>
					<th align="center">
						分类名称
					</th>
					<th align="center">
						操作
					</th>
				</tr>
				</thead>
				<tbody>
				<?php if(!empty($list)) foreach($list as $k=>$v){?>
					<tr class="info">
						<td>
							<?php echo $v['tId'];?>
						</td>
						<td>
							<?php echo $v['typeName'];?>
						</td>
						<td>
							<a href="<?php echo $this->config->item('base_url').'/jiekou/Index/paramlist/'.$v['tId'];?>" class="btn btn-primary">查看详情</a>
						</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
	</div>
	<!--添加分类结束-->
	<div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table">
				<thead>
				<tr>
					<th>
						接口Id
					</th>
					<th>
						接口名称
					</th>
					<th>
						接口地址
					</th>
					<th>
						是否需要登录
					</th>
					<th>
						操作
					</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($jielist as $k=>$v){?>
				<tr>
					<td>
						<?php echo $v['jId'];?>
					</td>
					<td>
						<?php echo $v['interfaceName'];?>
					</td>
					<td>
						<?php echo $v['interfaceUrl'];?>
					</td>
					<td>
						<?php echo $v['isLogin'] == 1 ? '该接口需要登录操作' : '无需登录';?>
					</td>
					<td>
						<a href="<?php echo $this->config->item('base_url').'/jiekou/Index/readInfo/'.$v['jId'];?>">调试接口</a>
						<a href="<?php echo $this->config->item('base_url').'/jiekou/Index/deleteJiekou/'.$v['jId'];?>">删除接口</a>
					</td>
				</tr>
				<?php }?>
				</tbody>
			</table>
		</div>

	</div>
</div>
</body>
</html>