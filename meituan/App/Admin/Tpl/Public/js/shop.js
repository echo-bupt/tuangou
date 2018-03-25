$(function()
{
        $("#validation").validation(
    {
        shopname: {
			 rule: {
				 maxlen:10,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于10个字符 ",
		         required: "不能为空 "
		     },
		     message: "商铺名称长度 1到 10 位 ",
		     success: "商铺名称正确"
		 },
		 shopaddress: {
			 rule: {
				 maxlen:40,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于40个字符 ",
		         required: "不能为空 "
		     },
		     message: "商铺地址长度 1到 40 位 ",
		     success: "商铺地址填写正确"
		 },
                  metroaddress: {
			 rule: {
				 maxlen:40,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于40个字符 ",
		         required: "不能为空 "
		     },
		     message: "地铁长度 1到 40 位 ",
		     success: "地铁地址填写正确"
		 },
                 //这是对于电话号码的验证方法!!
              shoptel:{
			 rule: {
				 tel:true,
				 required: true
			 },
			 error: {
				 tel: "不符合电话规则 ",
		         required: "不能为空 "
		     },
		     message: "请填写一个固定电话的号码",
		     success: "电话填写正确"
		 },
                 shopcoord:{
			 rule: {
				 maxlen:40,
				 required: true
			 },
			 error: {
				 maxlen: "不能大于40个字符 ",
		         required: "不能为空 "
		     },
		     message: "请先在此处填写一个您想获取的坐标的地址，必须是一个地址名称，然后第二次点击获取地址按钮便可得到地址坐标。 ",
		     success: "商铺地址填写正确"
		 }
        //貌似最后一个不能加逗号，因为在IE下会报错。
    })
    //$(".isshow").attr("pid")//我们是选取所有pid为0的元素并且让他显示，我们选择出元素的pid属性干什么!应当选处对象。，巧妙之处我们给每一个tr加了cid与pid属性!
    $("#getPoint").click(function()
{
    if($("#getPointValue").val()=="")
        {
            alert("请填写一个地址!");
        }else{
            var ads=$("#getPointValue").val();  
        }
   //alert(ads);
        getPoint(ads);
        return false;
})
 //这是请求百度地图的API数据，下面是。
function getPoint(ads)
{
    // 创建地址解析器实例
	var myGeo = new BMap.Geocoder();
	// 将地址解析结果显示在地图上,并调整地图视野
        //这里的ads是动态的，是一个城市的或者地址名。所以我们把它作为一个变量参数来进行处理。
        //一开始是我们获取到#getPointValue的value也就是得到地址，然后根据地址得到百度API的json坐标，然后再给这个#getPointValue赋值。
	myGeo.getPoint(ads, function(point){
            //我们必须把拿到的point进行stringify处理之后才可以获得到JSON下的数据。
		$('#getPointValue').val(JSON.stringify(point));
	}, "河北省");
}

})






