<?php namespace web\home\controller;
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

class Entry {
	//首页
	public function index() {

//	  $data= Db::query("select * from activity_draw where product_id=:product_id",
//[':product_id'=>11111]);
		顶顶顶顶
   $data=Db::table('activity_draw')->where('user_id',1)->get();
		p($data);
	}
}