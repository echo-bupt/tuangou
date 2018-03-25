$(function()
{
    $("#reduce").click(function()
{
    var inputVal=$(this).next().val();
    if(inputVal==1)
        {
            return 
        }
       $(this).next().val(parseInt(inputVal)-1);
       var nowValue=$(this).next().val();
     //获得单价:
     var perPrice=$(this).parents("td").next().text();
     //修改总价:
     $(this).parents("td").next().next().text(nowValue*parseInt(perPrice));
       return false;
})
$("#add").click(function()
{
    var inputVal=$(this).prev().val();
     $(this).prev().val(parseInt(inputVal)+1);
      var nowValue=$(this).prev().val();
     //获得单价:
     var perPrice=$(this).parents("td").next().text();
     //修改总价:
     $(this).parents("td").next().next().text(nowValue*parseInt(perPrice));
     return false;
})
})


