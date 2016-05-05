/*******************************************************************************
 * 验证 逻辑函数
 ******************************************************************************/
jQuery.extend( {
	isEmpty : function(val) {
		if (undefined == val || val == "" || val == null) {
			return true;
		}
		return false;
	},
	isNotEmpty : function(val) {
		return !($.isEmpty(val));
	},

	/**
	 * 是否是数字（正整数）
	 */
	isDigits : function(value) {
		var reg = /^\d+$/;
		return reg.test(value);
	},

	/**
	 * 判断是否是数字(整数)
	 */
	isInteger : function(value) {
		var reg = /^[-+]?[1-9][0-9]*$/;
		return reg.test(value);
	},
	/**
	 *userName
	 */
	isUserName: function(value) {
		var reg = /^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]{0,50}$/;
		return reg.test(value);
	},
	
	/**
	 *中英文字符
	 */
	isStringChar: function(value) {
		var reg = /^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]{0,100}$/;
		return reg.test(value);
	},
	/**
	 * 是否是字符串
	 */
	isString : function(value) {
		reg = /^[a-z0-9A-z_]+$/;
		return reg.test(value);
	},
	/**
	 * 
	 */
	isPhoneCityCode : function(value) {
		var reg = /^\d{3,4}$/;
		return reg.test(value);
	},
	/*
	 * 
	 */
	isPhoneCode : function(value) {
		var reg = /^\d{7,8}$/;
		return reg.test(value);
	},
	isPhoneExtCode : function(value) {
		var reg = /^\d{3,5}$/;
		return reg.test(value);
	},
	isMobile : function(value) {
		var length = value.length;
		var reg = /^(1[235][0-9]{1})+\d{8}$/;
		return ((length == 11) && reg.test(value));
	},
	isPostCode : function(value) {
		var reg = /^[0-9]{6}$/;
		return reg.test(value);
	},
	/* 
	身份证判断函数，是返回true，不是返回false 
	15位数字，18位数字或者最后一位为X（大写） 
	*/ 
	isSFZ : function(num){ 
		function checkDate(date)
		{
			return true;
		}
		var factorArr = new Array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2,1); 
		var error; 
		var varArray = new Array(); 
		var intValue; 
		var lngProduct = 0; 
		var intCheckDigit; 
		var intStrLen = num.length; 
		var idNumber = num; 
		// initialize 
		if ((intStrLen != 15) && (intStrLen != 18)) { 
			//error = "输入身份证号码长度不对！"; 
			//alert(error); 
			//frmAddUser.txtIDCard.focus(); 
			return false; 
		} 
		// check and set value 
		for(i=0;i<intStrLen;i++) { 
			varArray[i] = idNumber.charAt(i); 
			if ((varArray[i] < '0' || varArray[i] > '9') && (i != 17)) { 
				//error = "错误的身份证号码！."; 
				//alert(error); 
				//frmAddUser.txtIDCard.focus(); 
				return false; 
			} else if (i < 17) { 
				varArray[i] = varArray[i]*factorArr[i]; 
			} 
		} 
		if (intStrLen == 18) { 
			//check date 
			var date8 = idNumber.substring(6,14); 
			if (checkDate(date8) == false) { 
				//error = "身份证中日期信息不正确！."; 
				//alert(error); 
				return false; 
			} 
			// calculate the sum of the products 
			for(i=0;i<17;i++) { 
				lngProduct = lngProduct + varArray[i]; 
			} 
			// calculate the check digit 
			intCheckDigit = 12 - lngProduct % 11; 
			switch (intCheckDigit) { 
				case 10: 
					intCheckDigit = 'X'; 
					break; 
				case 11: 
					intCheckDigit = 0; 
					break; 
				case 12: 
					intCheckDigit = 1; 
					break; 
			} 
			// check last digit 
			if (varArray[17].toUpperCase() != intCheckDigit) { 
				//error = "身份证效验位错误!...正确为： " + intCheckDigit + "."; 
				//alert(error); 
				return false; 
				} 
			} 
			else{ //length is 15 
				//check date 
				var date6 = idNumber.substring(6,12); 
				if (checkDate(date6) == false) { 
					//alert("身份证日期信息有误！."); 
					return false; 
				} 
			}
		return true;
 	} 
});

/*******************************************************************************
 * 扩展常用，通用的验证方法，完全个性化的验证方法请写在各自页面
 ******************************************************************************/
$.validator.addMethod("mobile", function(value) {
	return $.isMobile(value);
});

$.validator.addMethod("identity", function(value) {
	return $.isSFZ(value);
});

$.validator.addMethod("userName", function(value) {
	return $.isUserName(value);
});

$.validator.addMethod("stringChar", function(value) {
	return $.isStringChar(value);
});

$.validator.addMethod("string", function(value) {
	return $.isString(value);
});

/*******************************************************************************
 * 设定验证初始化参数
 ******************************************************************************/
jQuery.extend( {
	getValidateOptions : function(options) {
		var defaults = {
			event : "keyup",
			errorPlacement : function(error, element) {
				var err_id = element.attr("name") + "_error";
				var $err = $("body").find("#" + err_id)[0];
				if (!$.isEmptyObject($err)) {
					error.appendTo($err);
				} else {
					$("<div/>", {
						"class" : "error_",
						id : err_id
					//}).append(error).insertAfter(element);
					}).append(error).insertAfter(element);
					//error.appendTo ( element.next() );
				}
			},
			invalidHandler : function(form, validator) {
				var errNum = validator.numberOfInvalids();
				var $err = $("#global_msgbox");
				if (errNum && $err) {
					var error = "共有 " + errNum + " 处错误!";
					$err.html(error);
					$err.show();
				} else {
					$err.hide();
				}
			}
		};
		return $.extend(true, defaults, options);
	}

});

/*
 * Translated default messages for the jQuery validation plugin. Locale: CN
 */
jQuery.extend(jQuery.validator.messages, {
	required : "*(必填)",
	remote : "请修正该字段",
	email : "请输入正确格式的电子邮件",
	url : "请输入合法的网址",
	date : "请输入合法的日期",
	dateISO : "请输入合法的日期 (ISO).",
	number : "只能输入数字",
	digits : "只能输入整数",
	creditcard : "请输入合法的信用卡号",
	equalTo : "请再次输入相同的值",
	accept : "请输入拥有合法后缀名的字符串",
	maxlength : jQuery.validator.format("请将输入内容控制在 {0}字以内"),
	minlength : jQuery.validator.format("请输入一个长度最少是 {0} 的值"),
	rangelength : jQuery.validator.format("请输入一个长度介于 {0} 和 {1} 之间的值"),
	range : jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
	max : jQuery.validator.format("请输入一个最大为 {0} 的值"),
	min : jQuery.validator.format("请输入一个最小为 {0} 的值"),
	mobile : "请输入手机号码",
	identity : "请输入正确的身份证",
	stringChar: "请输入100以内只含有汉字、字母的字符",
	string: "输入只有字母和数字的值",
	userName : "请输入50位以下有效的名称"
});
