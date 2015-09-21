/*
*       解决ie不支持placehloder属性
*       author：赵元瑞
*       e-mail：zyr_9970@163.com
**/
!function(window,document,$,undefined){
    var len,i= 0,target,result;
    //如果input里创建了placeholder直接返回
    if('placeholder' in document.createElement('input')) return;
    target=$('[placeholder]');
    for(len=target.length;i<len;i++){
        result=target[i].getAttribute('placeholder');
        target[i].value=result;
        target[i].style.color='#aaaaaa';
        target[i].onfocus=function(){
            if(this.value!=this.getAttribute('placeholder')) return;
            this.value='';
            this.style.color='#000000';
        }
        target[i].onblur=function(){
            if(this.value!='') return;
            this.value=this.getAttribute('placeholder');
            this.style.color='#aaaaaa';
        }
    }
}(window,document,jQuery);
