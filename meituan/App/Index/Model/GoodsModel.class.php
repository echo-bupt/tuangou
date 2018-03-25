<?php
//关联模型:商品表关联shop，detail,category三张表
class GoodsModel extends ViewModel{
    public $view=array(
        "shop"=>array(
            "type"=>"inner",
            "on"=>"goods.shopid=shop.shopid",
        ),
        "category"=>array(
            "type"=>"inner",
            "on"=>"category.cid=goods.cid"
        ),
        "locality"=>array(
            "type"=>"inner",
            "on"=>"locality.lid=goods.lid"
        ),
        "goods_detail"=>array(
            "type"=>"inner",
            "on"=>"goods_detail.goods_id=goods.gid"
        )
    );
}
?>

