<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>主页</title>
	<link href="<?php echo $this->config->item('base_url').'/public/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
	<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/login/js/jquery-1.7.2.min.js">
	</script>
	<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>/public/bootstrap/jquery-1.10.1.min.js">
	</script>
	<style>
		body{
			background: #f1f1f1;
		}
		*{margin:0;padding:0;}
		pre {outline: 1px solid #ccc; padding: 5px; margin: 5px;line-height:15px;}
		.string { color: green;float:left;}
		.number { color: darkorange;float:left; }
		.boolean { color: blue; float:left;}
		.null { color: magenta; float:left;}
		.key { color: red;float:left; }
	</style>
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
					<li>
						<a href="<?php echo $this->config->item('base_url').'/jiekou/Index/paramlist';?>">接口列表</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form id="form2" name="form2" method="post" action="<?php echo $this->config->item('base_url').'/jiekou/Index/update';?>">
				<div class="form-group">
					<label for="exampleInput">接口名称<i>*</i></label>
					<input type="text" class="form-control" id="interfaceName" value="<?php echo !empty($info['interfaceName']) ? $info['interfaceName'] : '';;?>" name="interfaceName" style="width: 20%" placeholder="请输入接口名称"/>
				</div>
				<div class="form-group">
					<label for="exampleInput">接口地址<i>*</i></label>
					<input type="text" class="form-control" value="<?php echo !empty($info['interfaceUrl']) ? $info['interfaceUrl'] : '';;?>" id="interfaceUrl"name="interfaceUrl" style="width: 60%" placeholder="参考格式：bwww.bl.com/admincp/Mainuser?   请以？结尾，以便参数拼接"/>
					<input type="hidden" id="jId" name="jId" value="<?php echo $info['jId']?>">
				</div>
				<div class="form-group">
					<label for="exampleInput">是否需要登录<i>*</i></label>
					<select name="isLogin" class="form-control" style="width: 20%">
						<option value="0" <?php if($info['isLogin'] == 0){echo 'selected';}?>>无需登陆</option>
						<option value="1" <?php if($info['isLogin'] == 2){echo 'selected';}?>>必须登陆</option>
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
					</tr>
					</thead>
					<tbody>
					<?php
					$paramlist = json_decode($info['paramlist']);
					$paramlist = (array)$paramlist;
					if(!empty($paramlist))
					foreach($paramlist as $k=>$v)
					{
					?>
					<tr>
						<td>
							<input type="text" id="name" name="paramName[]" class="form-control" value="<?php echo !empty($k) ? $k : '';?>" style="width: 200px" placeholder="请输入准确的参数名！"/>
						</td>
						<td>
							<input type="text" id="name" name="paramValue[]" class="form-control" value="<?php echo !empty($v) ? $v : '';?>" style="width: 200px" placeholder="请输入准确的参数值！"/>
						</td>
					</tr>
					<?php }?>
					<?php if(!empty($sessiondata)){?>
					<thead>
					<tr>
						<th align="center" style="color: red">
							<h3><strong>用户SESSION参数：</strong><i>如果有不需要的参数请您清空文本内的参数与对应参数值</i></h3>
						</th>
					</tr>
					</thead>
					<?php
						foreach($sessiondata as $k=>$v)
						{
							?>
							<tr>
								<td>
									<input type="text" id="name" name="paramName[]" class="form-control" value="<?php echo !empty($k) ? $k : '';?>" style="width: 200px" placeholder="请输入准确的参数名！"/>
								</td>
								<td>
									<input type="text" id="name" name="paramValue[]" class="form-control" value="<?php echo !empty($v) ? $v : '';?>" style="width: 200px" placeholder="请输入准确的参数值！"/>
								</td>
							</tr>
						<?php }?>
					</tbody>
					<?php }?>
				</table>
				<div style=" float: right;margin-top: 20px; ">
					<button type="submit" class="btn btn-primary" >提交更改</button>
				</div>
			</form>
		</div>
	</div>
	<HR style="border:3px double #987cb9; width='80%';color=#987cb9; SIZE=3">
	<div class="row clearfix">
		<div class="col-md-12 column" style="text-align: center">
			<?php if(!empty($sessiondata)){?>

			<a class="btn active btn-lg btn-primary" href="<?php echo $this->config->item('base_url').'/jiekou/Login/loginOut';?>" style="color: floralwhite">切换用户</a>&nbsp;&nbsp;
			<?php }else{?>
			<a class="btn active btn-lg btn-primary" href="<?php echo $this->config->item('base_url').'/jiekou/Login/index';?>" style="color: floralwhite">登录测试</a>&nbsp;&nbsp;
			<?php }?>
			<a href="<?php echo $this->config->item('base_url').'/jiekou/Index/jiekouInfo/'.$info['jId']?>" class="btn active btn-lg btn-success"style="color: floralwhite">免登调试</a>
			<?php if(isset($newUrl) && $newUrl != ''){?>
			<a class="btn active btn-lg btn-primary" href="<?php echo !empty($newUrl) ? $newUrl : '';?>" target="_blank">请求URL</a>
			<?php }?>
		</div>
	</div>
	<?php if(isset($returnData)){?>
	<HR style="border:3px double #987cb9; width='80%';color=#987cb9; SIZE=3">
	<div class="row clearfix" style="padd   ing-top: 30px">
		<div class="col-md-12 column">
			<label class="col-sm-2 control-label">JSON数据：</label>
			<blockquote>
				<div id="shousuo" style="float: right"><button class="btn" onclick="show_div()">展开收起</button></div>
				<pre id="result"style="display: none">
				</pre>
			</blockquote>

			<label class="col-sm-2 control-label">数组格式：</label>
			<blockquote>
				<div id="shousuo2" style="float: right"><button class="btn" onclick="show_div2()">展开收起</button></div>
				<pre id="arrayData" style="display: none">
					<?php
					$startData = $returnData;
					$returnData = json_decode($returnData);
					$arr =(array)$returnData;
					var_dump($arr);
					?>
				</pre>
			</blockquote>
		</div>
	</div>
	<?php }?>
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
<script>
	function syntaxHighlight(json) {
		if (typeof json != 'string') {

			json = JSON.stringify(json, undefined, 2);
		}
		json = json.replace(/&/g, '&').replace(/</g, '<').replace(/>/g, '>');
		return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function(match) {
			var cls = 'number';
			if (/^"/.test(match)) {
				if (/:$/.test(match)) {
					cls = 'key';
				} else {
					cls = 'string';
				}
			} else if (/true|false/.test(match)) {
				cls = 'boolean';
			} else if (/null/.test(match)) {
				cls = 'null';
			}
			return '<div><span class="' + cls + '">' + match + '</span></div>';
		});
	}
</script>
<script language="javascript">
	function show_div(){
		var str = '<?php echo empty($startData) ? '' : $startData;?>';
		var obj_div=document.getElementById("result");
		$('#result').html(syntaxHighlight(str));
		obj_div.style.display=(obj_div.style.display=='none')?'block':'none';
	}
	function show_div2(){
		var obj_div=document.getElementById("arrayData");
		obj_div.style.display=(obj_div.style.display=='none')?'block':'none';
	}
</script>
</body>
</html>