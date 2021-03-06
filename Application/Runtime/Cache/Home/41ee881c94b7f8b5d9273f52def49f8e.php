<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>考勤记录</title>
<link rel="stylesheet" type="text/css" href="/Public/Images/css1/css.css" />
<script type="text/javascript" src="/Public/scripts/jquery.js"></script>
<script>
//页面加载
$(function(){
	//隐藏下拉提示框
	$('#tip').hide();
	
	//绑定姓名文本框事件
	$('#truename').bind('keyup',function(){
		//获取subject和truename姓名
		var subject = $('#subject').val();
		var truename = $(this).val();
		//组织json数据
		var data = {
			subject : subject,
			truename : truename
		};
		//发送Ajax请求
		$.post('/index.php/Home/Kaoqin/addSel',data,function(msg){

			//判断返回的数据的长度
			if(msg.length > 0){
				//清空下拉框
				$('#tip').html('');
				
				//变量json对象,生成div添加到#tip中
				$(msg).each(function(i,item){
					//生成div
					var div = $('<div></div>');
					//将姓名添加到div中
					div.html(item.truename);
					//追加到#tip中
					$('#tip').append(div);
					
					//给每个div绑定鼠标悬浮事件
					div.bind('mouseover',function(){
						div.css('backgroundColor','#ccc');
					});
					//每个div绑定鼠标离开事件
					div.bind('mouseout',function(){
						div.css('backgroundColor','#ffffff');
					});
					//给每个div绑定鼠标点击事件
					div.bind('click',function(){
						$('#truename').val( $(this).text() );//添加到truename文本框中
						$('#tip').hide(); //隐藏下拉提示框
					});
				});
									
				//显示#tip
				$('#tip').show();
			}
		},'json');
		
	});
});
</script>
<style>
td, th {
	text-align: center
}
#tip{
	width:145px;
	height:auto;
	color:#000000;
	border:1px solid #03A8F6;
	display:block;
}
#tip div{
	width:145px;
}
</style>
</head>
<body>
<form method='post' action='/index.php/Home/Kaoqin/addOk' enctype='multipart/form-data'>
  <table class="table" cellspacing="1" cellpadding="2" width="99%"
			align="center" border="0">
    <tbody>
      <tr>
        <th style="text-align:left;" colspan="2" class="bg_tr" align="left" height="25">考勤添加管理</th>
      </tr>
    
	  <tr>
        <td style="text-align:right;" class="td_bg" width="17%" height="23" align="center">所属学科：</td>
        <td style="text-align:left;" class="td_bg">
        	<select id='subject' name='subject'>
        		<option value='-1'>请选择</option>
				<?php if(is_array($sub)): $i = 0; $__LIST__ = $sub;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["id"]); ?>'><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        	</select>
        </td>
      </tr>
	    <tr>
        <td style="text-align:right;" class="td_bg" width="17%" height="23" align="center">姓名：</td>
        <td style="text-align:left;" class="td_bg">
        	<input type='text' id='truename' name='truename' />
			<br/>
			<span id='tip'></span>
        </td>
      </tr>
	  <tr>
        <td style="text-align:right;" class="td_bg" width="17%" height="23" align="center">迟到时间：</td>
        <td style="text-align:left;" class="td_bg">
        	<input type='text' disabled='false' name='addtime' value='<?php echo ($time); ?>' />
        </td>
      </tr>
	  <tr>
        <td style="text-align:right;" class="td_bg" width="17%" height="23" align="center">&nbsp;</td>
        <td style="text-align:left;" class="td_bg">
        	<input type='submit' name='submit' value='添加' />
        </td>
      </tr>
    </tbody>
  </table>
</form>
</body>
</html>