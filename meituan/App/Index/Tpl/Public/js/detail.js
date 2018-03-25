$(function(){
    //当在一个页面的时候这个clickNum可以随着点击数的增加而增加，但是如如果进入另一个页面，此时变量重新渲染，
    //clickNum依然为1！
    var clickNum=1;
	$('#addCart').click(function(){
           clickNum++;
           var origTop=$(this).offset().top;//这个是获取当前元素的top值。
           var origLeft=$(this).offset().left;
           $('#infoWindow').show().css({
               "top":origTop+50,"left":origLeft-100
           })
           //发送AJAX请求:
          $.ajax({
                type:"post",
                url:URL+"/ajaxGetGoods",
                data:  $("#goodsForm").serialize(),//将表单内容序列化之后打包过去，过去的就相当于我们post提交过去的数据。
                success:function(msg)
                {
                   // alert(msg);
                     $('#infoWindow').html(msg)
                }   
                })
            //点击购物车时，同步修改购物车后面的数字，前提是点击的是不同的gid.
            if(clickNum<3)
                {
                    var pre=$("#gou").text();
                    var pre1=pre.substring(1,2);
          //alert(pre1);
                    var  pre2=parseInt(pre1);
       // alert(pre2);
                 var preNow=pre2+1;
                  //注意当在再次点击的时候，他还是会执行      var pre1=pre.substring(1,2);
          //alert(pre1);
    //   var  pre2=parseInt(pre1);//如果你把 $("#gou").html设成数字,那么是会出错的！所以设成("("+preNow+")");加上那()!!!
                $("#gou").html("("+preNow+")");
                }
           return false;
	})
        $("#guanbi").live("click",function()
    {
          $('#infoWindow').hide();
        return false;
    })

	
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    /*
     *
     *下面是原来拥有的点击购物车之后出现弹窗的形式。上面是另一种方式，也就是在购物车下面出现
     *一个div，div里面的内容是通过AJAX请求存放购物车的session数据来得到的!
     *
     */
	$('#addCollect').click(function(){
		if(userIsLogin === false){
			alert('请先登录！');
			return false;
		}
		var url = $(this).attr('url');
		$.ajax({
			url:url,
			dataType:'json',
			success:function(result){
				if(result.status === true){
					showInfoWindow(collectSucc);
				}else{
					alert('添加收藏失败！')
				}
			}
		})
	
	})


})




/**
 * 显示信息提示框
 * @param html
 */
function showInfoWindow(html){
	$('#infoWindow').show().css({
		top:$(window).scrollTop()+Math.floor(($(window).height()-$('#infoWindow').innerHeight())/2)
	})
	$('#cover').show().css({
		width:$(window).width(),
		height:$(document).height(),
		position:'absolute',
		left:0,
		top:0,
		background:'#333',
		opacity:0.3,
		
	})
	$('#infoWindow').html(html);
}
/**
 * 隐藏信息提示框
 */
function hideInfoWindow(){
	$('#infoWindow').hide();
	$('#cover').hide();
}

