/**
 * 功能：添加/编辑页中，点击"取消"按钮
 */
function cancel_btn(url){
	window.location.href = url;
}
//点击小图标，观览大图片
function view_image(src){
	tipsWindown("预览图片", "img:" + src, "640", "480", true,"true", "", "true", "img");
}
	

//弹出层调用 注册登录和找回密码用
/*function popTips(title, id, width, height){
    tipsWindown(title, "url:get?"+id, width, height, false, "true", "", "true", id);
}

//点击小图标，观览大图片
function view_image(src){
	tipsWindown("预览图片", "img:" + src, "640", "480", true,"true", "", "true", "img");
}
	


//批量操作，全选
function select_group(checkbox) { 
    var checked = ($(checkbox).attr('checked') == 'checked') ? true : false;
	$("input[class='manipulate_id']").attr('checked', checked);
}

//批量操作，按钮赋值
function batch_operation(flag){
	var batch_flag = false;
	var msg;
	switch (flag){
		case 'batch_delete':
			msg = '确定批量删除！';
			batch_flag = true;
			break;
		case 'batch_recovery':
			msg = '确定批量恢复！';
			batch_flag = true;
			break;
		case 'batch_true_delete':
			msg = '确定批量彻底删除！';
			batch_flag = true;
			break;
		case 'all_delete':
			msg = '确定全部删除！';
			break;
		case 'all_recovery':
			msg = '确定全部恢复！';
			break;
		case 'all_true_delete':
			msg = '确定全部彻底删除！';
			break;
	}
	
	if (batch_flag == true){
		var arrays = new Array();   //创建一个数组对象
		var items = document.getElementsByName("manipulate_id[]");  //获取name为check的一组元素(checkbox)
		for(i=0; i < items.length; i++){  //循环这组数据
			if(items[i].checked){      //判断是否选中
				arrays.push(items[i].value);  //把符合条件的 添加到数组中. push()是javascript数组中的方法.
			}
		}

		if (arrays.length < 1){
			alert('请选择要批量操作的记录！');
			return false;
		}
	}
	 
	if (confirm(msg) == false) return false;
	$('#manipulate').val(flag);
	$('#list_form').submit();
}

//删除专家
function remove_span_expert(id){
    var stringObj = $("#expert_ids").val();
	stringObj = stringObj.replace("|"+id+"|", "|");
	if(stringObj=="|"){
		stringObj = "";
	}
	$("#expert_ids").val(stringObj);
    $("#span_expertid_"+id).remove();
}*/