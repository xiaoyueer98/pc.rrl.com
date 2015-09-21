/*
 * 实现焦点图功能
 * 其中方法：
 * new Lunbo(buttons,scrollcontent,hoverclass,timeout)
 * button:要接收的li数组
 * scrollContent:滚动内容div
 * hoverClass:高亮显示的类
 * timeout播放间隔
 * 其中构造函数方法：
 * start()开始播放方法，默认打开网页从第一张开始播放
 * stop();停止
 * invoke(n)切换到某一张图片的方法
 * next();切换到下一个索引
 * huifuClass（）;恢复li的默认显示
 *
 * author：赵元瑞
 * e-mail：zyr_9970@163.com
 * 我不希望有人私自改动我的注释以及代码
 * QQ:844969129
 * 版本：v1.0
 * */





//创建轮播图构造函数
function Lunbo(buttons,scrollcontent,hoverclass,timeout) {
    this.buttons=buttons;
    this.scrollcontent=scrollcontent;
    this.hoverclass=hoverclass || 'hover';
    this.timeout=timeout || 3000;
    //默认当前li为第一个
    this.curItem=buttons[0];
    this.curItem.index=0;
    this.invoke(0);
    var _this=this;
    for(var j= 0,len2=this.buttons.length;j<len2;j++){
        this.buttons[j].onmouseover=function(){
            _this.stop();
            //alert(this.index);
            _this.invoke(this.index);

        };

        this.buttons[j].onmouseout=function(){
            _this.start();

        };

        //给每个li保存一个索引，分别为0,1,2,3,4
        this.buttons[j].index=j;
    }

}


Lunbo.prototype={
    start:function(){
        var _this=this;
        this.timer=setInterval(function(){
            _this.next();
        },this.timeout);

    },
    stop:function(){
        clearInterval(this.timer);
    },
    invoke:function(n){
        this.curItem=this.buttons[n];
        this.huifuClass();
        this.scrollcontent.style.top=(-n*524)+"px";
        this.curItem.className=this.hoverclass;

    },
    next:function(){
        var nextIndex=this.curItem.index+1;
        if(nextIndex>=this.buttons.length){
            nextIndex=0;
        }
        this.invoke(nextIndex);

    },
    huifuClass:function(){
        for(var i= 0,len=this.buttons.length;i<len;i++){
            this.buttons[i].className="";
        }
    }

};






var olis=getClass('focusNav')[0].getElementsByTagName('li'),
    focuspic=getClass('focusPic')[0];


var jdt=new Lunbo(olis,focuspic);
jdt.start();
//jdt.stop();
//jdt.invoke(4);


/*tab*/
var tabNav=$('tabNav'),
    navlis=tabNav.getElementsByTagName('li'),
    tabContent=$('view');

for(var i= 0,len=navlis.length;i<len;i++){
    navlis[i].index=i;
    navlis[i].onclick=function(){

        //先隐藏其他high
        for(var j= 0,len2=navlis.length;j<len2;j++){
            navlis[j].className="";
        }

        this.className="login-high";
        tabContent.style.top=-(this.index*318)+"px";


    }

}




