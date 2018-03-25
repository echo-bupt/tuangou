$(function()
{
     $("tr[pid!=0]").hide();
    $(".click").toggle(function()
{
   var index=$(this).parents("tr").attr("cid");
   $(this).html("-").removeClass("btn-info");
   $("tr[pid="+index+"]").show();//这里注意在javascript中，双引号是不能解析变量的，所以我们要用加号s进行连接。
},
function()
{
     var index=$(this).parents("tr").attr("cid");
      $(this).html("+").addClass("btn-info");
    $("tr[pid="+index+"]").hide();
})

}) 

