/**
 * 引入css文件
 * 
 */
require('./style.css');
require('./abc.less');

import $ from 'jquery';
import Vue from 'vue';
Vue.config.debug = true;
 new Vue({
    el: "#app",
    created: function() {
        $.get('http://localhost/brandClear/index.php?c=brand&m=index').done(data => {
            data = JSON.parse(data);
            this.items = data.data;
            console.log(data);
        })
    },
    data: {
        items: []
    }

});

   var _czc = _czc || [];
    _czc.push(["_trackPageview", "品牌尾货清"]);
    _czc.push(["_setAutoPageview", false]);

    /**
     * 判断是否微信内打开
     */
    if(!IsChuchujieAPP()){
        $('.fenxiang').hide();
    }

    /**
     * 跳转详情
     * @param productId
     * @param type
     * @returns {boolean}
     */
    function buyNative(productId,type){
        if(window._czc) {
            _czc.push(['_trackEvent', '品牌尾货清', '品牌尾货清点击数']);
        }

         if(type){
            location.href = 'http://m.chuchujie.com/details/detail.html?id=' + productId;
            return false;
        }
        if(IsChuchujieAPP()){
            var jsonDict = {"productId": productId, "static_id":76};
            window.CcjJSBridgeInstance.callTemplate("CHUCHUITEM", JSON.stringify(jsonDict));
        }else{
            location.href = 'http://m.chuchujie.com/details/detail.html?id=' + productId;
        }

    }

    /**
     * 微信qq分享
     * @param list
     * @param type
     */
    function shareWeixin(list,type) {
        var  shareurl ="http://huodong.chuchujie.com/brandClear/index.php?c=brand&m=index";
        var imgUrl='http://huodongcdn.chuchujie.com/brandClear/imgs/0813/fenxiang.png';
        var sharedesc='我正在看楚楚街品牌清仓活动，都是傲娇的品牌，只卖亲民的价格';
        CcjJSBridge.call(
                 list,
                {
                    title:sharedesc,
                    imgUrl:imgUrl,
                    url:shareurl,
                    desc:sharedesc,
                    type:0
                },
                function(res){
                    if(res.code==0){
                        switch (type){
                            case '1':
                                _czc.push(['_trackEvent','品牌清仓活动分享朋友圈','成功数']);
                                break;
                            case '2':
                                _czc.push(['_trackEvent','品牌清仓活动分享微信朋友次数','成功数']);
                                break;
                            case '3':
                                _czc.push(['_trackEvent','品牌清仓活动分享qq好友','成功数']);
                                break;
                            case '4':
                                _czc.push(['_trackEvent','品牌清仓活动分享qq空间','成功数']);
                                break;
                        }
                        $("#share_content").hide();
                    }
                }
        );
    }

    /**
     * listwiew
     */
    function goto(){
        if(window._czc) {
            _czc.push(['_trackEvent', '品牌尾货清', '品牌尾货清点击数']);
        }

        window.location.href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/brandClear/index.php?c=Brand&m=listView';?>";
    }

    /**
     * 懒加载
     */
   // $("img.lazy").lazyload({threshold:'0'});

    /**
     * 显示分享弹窗
     */
    function showPupop(){
        $("#share_content").show();
    }
    /**
     * 影藏
     */
    function hidePupop(){
        $('#share_content').hide();
    }
