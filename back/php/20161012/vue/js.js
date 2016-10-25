 Vue.config.debug = true;

 //先定义组件
 var share=Vue.extend({
   template:'<div class="layer z_big Ndisplay" id="share_content"><p class="share_content ft07 clearfix">\
        <img src="http://huodongcdn.chuchujie.com/20160409/0911/img/close.png" onclick="hidePupop();" class="close" id="close_share" alt=""/>\
        <a href="javascript:;"><img src="http://huodongcdn.chuchujie.com/20160409/0911/img/share_pyq.png" alt="" onclick="shareWeixin(\'shareToWeixin_type\',1);"/><span>朋友圈</span></a>
        <a href="javascript:;"><img src="http://huodongcdn.chuchujie.com/20160409/0911/img/share_wx.png" alt="" onclick="shareWeixin(\'shareToWeixinFriends_type\',2);"/><span>微信朋友</span></a>
        <a href="javascript:;"><img src="http://huodongcdn.chuchujie.com/20160409/0911/img/share_qq.png" alt="" onclick="shareWeixin(\'shareToQQFriends_type\',3);"/><span>QQ好友</span></a>
        <a href="javascript:;"><img src="http://huodongcdn.chuchujie.com/20160409/0911/img/share_kj.png" alt="" onclick=" shareWeixin(\'shareToQQZone_type\',4);"/><span>QQ空间</span></a>
    </p>
</div>'
 });
 //注册组件
Vue.component('shared',share);

 var vm = new Vue({
    el:"#app",
 	created : function () {
        $.get('http://localhost/brandClear/index.php?c=brand&m=index').done(data=>{
        	 data=JSON.parse(data);
        	  this.items=data.data;
        })
 	},
 	data:{
       items:[]
 	},
 	methods:{
 	    goto(){
 	    	  if(window._czc) {
                 _czc.push(['_trackEvent', '品牌尾货清', '品牌尾货清点击数']);
               }
              window.location.href="http://localhost/vue/list.html";
 	    
 	    }
 	}
    
 })
