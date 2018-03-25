$(function()
{
    var prevNum="";//这个变量是用来记录我们原来input里面的数字，他是在获得input的焦点事件发生的时候给与他赋值
    //点击减号的时候
    $(".reduce").click(function()
{
    var preVal=$(this).next().val();
    if(preVal==1)
        {
            return false;
        }
   $(this).next().val(preVal-1);
   //接下来是去修改小计与总数。
   //如何获得不是本td下的其他td下的html，然后获取html下的值呢，需要通过parents还有children来进行操作!
   
  var nowNum=$(this).next().val();
   var perprice=$(this).parents("tr").children().eq(-3).text();//单价。
   $(this).parents("tr").children().eq(-2).text(nowNum*perprice);//修改小计。
   //下面是发送ajax请求去修改$_SESSION['goods']里面的数据。
   var gid=$(this).next().next().next().val();
  
   $.post(URL+"/ajax_reduce",{gid:gid},function(status)
{
})
   var preTotal=$("#total").text();
   $("#total").text(preTotal-perprice);
})
$(".add").click(function()
{
    var preVal=$(this).prev().val();
      $(this).prev().val(parseInt(preVal)+1);
      var nowNum=$(this).prev().val();
   var perprice=$(this).parents("tr").children().eq(-3).text();//单价。
   $(this).parents("tr").children().eq(-2).text(nowNum*perprice);//修改小计。
   //下面是发送ajax请求去修改$_SESSION['goods']里面的数据。
   var gid=$(this).next().val();
  
   $.post(URL+"/ajax_add",{gid:gid},function(status)
{
})
   var preTotal=$("#total").text();
   $("#total").text(parseInt(preTotal)+parseInt(perprice));
       //下面是发送ajax请求去修改$_SESSION['goods']里面的数据。
    
})
//接下来是当点击input框的时候也就是手动写入数据的时候。
$(".input").focus(function()
{
 prevNum=$(this).val();
$(this).next().next().css("display","block");
})
$(".ok").click(function()
{
    var nowInputNum=$(this).prev().prev().val();
    var perprice=$(this).parents("tr").children().eq(-3).text();//单价。
   $(this).parents("tr").children().eq(-2).text(nowInputNum*perprice);//修改小计。
   $(this).css("display","none");
   //修改总计.
    var preTotal=$("#total").text();
    $("#total").text(parseInt(preTotal)+(nowInputNum-prevNum)*perprice);
})
/*
 * 
 * 点击删除时删除物品。
 * 
 */
$(".solve").click(function()
{
    if(confirm("确认要删除吗?"))
        {
            //删除后更改总计。
            var gid=$(this).parents("td").prev().prev().prev().children().eq(3).val();
           var xiaoji=$(this).parents("td").prev().text();
           var preTotal=$("#total").text();
           $("#total").text(parseInt(preTotal)-parseInt(xiaoji));
            $(this).parents("tr").remove();
            
            //ajax删除对应session里面的数据。
           $.post(URL+"/del",{gid:gid},function(status)
{
})
//还有要修改购物车后面的数字。
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
            
        }
})
})

