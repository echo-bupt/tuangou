/**
 * 添加收藏
 */
function addFavorite2() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    }
    else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
    }
    else if (document.all) {
    	try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else if (window.sidebar) {
       try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else {
    	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}
/**
 * 导航字菜单
 */

$(function(){
 var btn=true;
 var btn2=true;
	//导航样式切换
	$('#nav .user-nav').hover(function(){
		$(this).addClass('active');
	},function(){
		$(this).removeClass('active');
	})
	//我的团购菜单切换
	$('#nav .my-hdtg').hover(function(){
		$(this).find('.menu').show();
	},function(){
		$(this).find('.menu').hide();
	})
	//最近浏览菜单切换
	$('#nav .recent-view a').hover(function(){
		$('#nav .recent-view').find('.menu').show();
                if(btn2)
                    {
                           $('#nav .recent-view').find('.menu').html("");
                            $.post("http://localhost/meituan/index.php/index/index/ajaxGetCookie",{btn:true},function(status)
                            {
                                if(status && status.length!=0)
                                    {
                                        $.each(status,function(i,n)
                                    {
                                       var nodeStr = '<li>\
						<a class="image" href="">\
					<img src="'+n.goods_img+'" />\
				</a>\
				<div>\
					<h4>\
						<a href="">'+n.main_title+'</a>\
					</h4>\
					<span><strong>¥'+n.price+'</strong></span>\
				</div>\
			</li>';
                                            $('#nav .recent-view').find('.menu').append(nodeStr);
           
                                    })
                                    var str='<p class="clear"><a href="javascript:void(0)">清空最近浏览记录</a></p>';
                                                                               $('#nav .recent-view').find('.menu').append(str);

                                    }else{
                                        var str="<li>您最近没有浏览记录哦.</li>";
                      $('#nav .recent-view').find('.menu').html("");
                   $('#nav .recent-view').find('.menu').append(str);
                                    }
                            },"json")
                    }
	},function(){
		$('#nav .recent-view').find('.menu').hide();
	})
        //清空浏览记录。
       $('#nav .recent-view').find('.clear').live("click",function()
       {
            $.post("http://localhost/meituan/index.php/index/index/clearCookie",{btn:true},function(status)
            {
                
            });
            var str="<li>您最近没有浏览记录哦.</li>";
                       $('#nav .recent-view').find('.menu').html("");
                   $('#nav .recent-view').find('.menu').append(str);
                   return false;
       })
        $('#nav .recent-view').find('.menu').hover(function()
    {
        $(this).show();
    },function()
{
     $(this).hide();
})
	//购物车菜单切换
        //有很多注意事项:第一最好给a加ajax的hover事件，不然会发生很多次hover事件，发生很多次ajax请求。那么$(".menu)不断被清空。导致你根本看不到删除后的结果。
        //第二:给a加hover事件之后，对于menu这个的hover事件。重新制定。
        //第三:如果不限制a的hover事件，那么在删除的时候不小心触发了a的一次hover事件，会导致产生两个删除的a发生两次del请求。
	$('#nav .my-cart a').hover(function(){
             
              //发送AJAX请求。
            $("#nav .my-cart").find(".menu").show();
              if(btn)
                  {
                         $("#nav .my-cart").find(".menu").html("");
                      $.post("http://localhost/meituan/index.php/member/cart/ajaxData",{btn:true},function(status)
          {
              if(status && status.length!=0)
                  {
                    
                       $.each(status,function(i,n)
          {
             var str='<li class="'+n.gid+'">\
								<a class="image" href="">\
									<img src="'+n.goods_img+'" />\
								</a>\
								<div>\
									<h4>\
										<a href="">'+n.main_title+'</a>\
									</h4>\
											<span><strong>¥'+n.price+'</strong><a href="javascript:void(0)" gid="'+n.gid+'" id="del">删除</a></span>\
				</div>\
			</li>';
                   $("#nav .my-cart").find(".menu").append(str);
                 $("#load").css("display","none");
							
          })    
           var str='<p class="clear"><a href="http://localhost/meituan/index.php/member/cart/index">去查看我的购物车</a></p>';
                                                                              $("#nav .my-cart").find(".menu").append(str);
                  }else{
                      var str="<li>购物车内没有商品</li>";
                        $("#nav .my-cart").find(".menu").html("");
                   $("#nav .my-cart").find(".menu").append(str);
                 $("#load").css("display","none");
                  }
  
          },"json")
                  }else{
                      var str="请求过于频繁，请1秒后再试。"
                           $("#nav .my-cart").find(".menu").html("");
                            $("#nav .my-cart").find(".menu").append(str);
                  }
        
          btn=false;
           
	},function(){
		 $("#nav .my-cart").find(".menu").hide();
	})
          var timer=setInterval(function()
      {
          btn=true;
      },3000);
        //为新产生的元素加事件就得通过live来进行加事件。前面出错的原因是把这个删除事件加在了hover事件里，这是错误的！！！
        $("#del").live("click",function()
       {
           var gid=$(this).attr("gid");
           var self=this;
           $.post("http://localhost/meituan/index.php/member/cart/del",{gid:gid},function(status)
       {
            $(self).parents("."+gid).remove(); 
       });
       //修改购物车后面的数字。
       //用js将页面中的li删除。
       //alert($(this).parents("li").length);
     var pre=$("#gou").text();
                    var pre1=pre.substring(1,2);
          //alert(pre1);
                    var  pre2=parseInt(pre1);
       // alert(pre2);
                 var preNow=pre2-1;
                  //注意当在再次点击的时候，他还是会执行      var pre1=pre.substring(1,2);
          //alert(pre1);
    //   var  pre2=parseInt(pre1);//如果你把 $("#gou").html设成数字,那么是会出错的！所以设成("("+preNow+")");加上那()!!!
                $("#gou").html("("+preNow+")");
                if(preNow==0)
                    {
                         var str="<li>购物车内没有商品,赶紧去看看商品吧!</li>";
                        $(".menu").html("");
                   $(".menu").append(str);
                    }
                 
       return false;
       })
          $('#nav .my-cart').find(".menu").hover(function()
      {
           $('#nav .my-cart').find(".menu").show();
      },function()
  {
      $('#nav .my-cart').find(".menu").hide();
  })
  var keyword=$("#keyword").val();
  if(typeof(keyword)!="undefined")
      {
           $(".s-text").val(keyword);
      }
  $(".s-text").focus(function()
{
    $(this).val("");
})
 $(".s-text").blur(function()
{
    if($(this).val()=="")
        {
            $(this).val("请输入商品名称，地址等");
        }
})
})




