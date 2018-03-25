$(function()
{
    var IE = /msie (\d+\.\d)/i.test(navigator.userAgent)
    //这个对num的命名是在有page=..的时候渲染一次，也就是在
    //这个仅仅是再刷新本页面的时候渲染一次，也就是令var num=0，其余时间执行getAjaxData函数，只会num累加。
    
   var num=0;
   var total=30;
   var timer="";
   var contentHeight="";
   getAjaxData();
  var nowUrl=location.href;
 //我们定义一个变量用来盛放content这个元素的高度，每一次得到数据后，都把该数据的高度加到这个变量中.
   function getAjaxData()
{
    $("#loader").show();
    //注意这里的更改，每一次请求6个数据，这个时候我们是增加3个div的高度的！
    contentHeight=parseInt(contentHeight+1125);
  var nowUrl=location.href;
     var inner="";//每一次执行这个ajax函数的时候我们都要提前清空inner这个字符串.
     var page=document.getElementById("page").value;
                 if(!page)
                     {
                         page=1;
                     }
    $.post(url+"/index/ajaxDataGet/page/"+page+"/num/"+num,{url:nowUrl},function(status)
    {
       // alert(status);
      $.each(status,function(i,n)
        {
            if(n)
                {
                       inner+= '<div class="item"><div class="cover"><a href="'+url+'/detail/index/gid/'+n.gid+'"><img src="'+n.goods_img+'"/></a>'+
       '</div><a class="link" href="'+url+'/detail/index/gid/'+n.gid+'"><h3>'+n.main_title+'</h3><p class="describe">'+n.sub_title+'</p></a>'+
       '<p class="detail"><strong>¥'+n.price+'</strong><span>门店价<span>-</span><del>'+n.old_price+'</del></span><a href="'+url+'/detail/index/gid/'+n.gid+'"></a></p>'+
       '<p class="total"><strong>'+n.buy+'</strong>人已参与</p></div>';
   //一般来说瀑布流效果都是宽度固定，我们根据宽度与原宽度的
                }
        
         
        }) 
         $(".content").append(inner);
         // $("#loader").hide();
         setTimeout(function(){$("#loader").hide(),1000});
         
    },"json");
  num=num+6;
   
}
 //timer=setInterval(getAjaxData,3000);
  var content=document.getElementById("content");
 var topValue=getTop(content);
// var height=$(".content").height();
// alert(height);
$(window).scroll(function()
{
    var scrollHeight=$(window).scrollTop();
    //alert(scrollHeight);
     if(num>=total)
        {
            //clearInterval(timer);
            return
        }
    if(topValue+contentHeight<scrollHeight+$(window).height())
        {
            getAjaxData();
            //alert(contentHeight);
        }
var navTop=document.getElementById("nav");
var value=getTop(navTop);
if(value<=$(window).scrollTop())
    {
        if(IE)
            {
                // $("#nav").css({position:"absolute",top:(132+$(window).scrollTop()),background:"#15B6AA"});
                // navTop.style.zIndex=20;
                // document.title=$(window).scrollTop();
                //$("#nav").addClass("fixed-top");
                 
            }
            else{
                $("#nav").css({position:"fixed",top:0,background:"#15B6AA"});
    navTop.style.zIndex=20;
            }  
    }
 if($(window).scrollTop()<100)
        {
             $("#nav").css({position:"absolute",top:132,background:"#15B6AA"});
             var filter=document.getElementById("filter");
             filter.style.marginTop="50px";
        }
})

function getTop(e){
var offset=e.offsetTop;
if(e.offsetParent!=null) offset+=getTop(e.offsetParent);
return offset;
}
$(".backToTop").goToTop();
	$(window).bind('scroll resize',function(){
		$(".backToTop").goToTop({
			pageWidth:960,
			duration:0
		});
	});
})



