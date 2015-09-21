//封装document.getElementById

function $(dom) {
    return (typeof dom=="string")?document.getElementById(dom):dom;
}

/*
*功能：封装一个获取类名的方法
*参数：
 *   str:表示接收的类名
  *  root:类所在的父级元素
  *  tag:表示某个html标签  例如：li里的k
* */
function getClass(str,root,tag) {
    var arr2=[],//临时数组
        resultarr=[];//存放找到str的类元素
    //获取root
    if(root){
      root=(typeof root=="string")?document.getElementById(root):root;
    }else {
        root=document.body;
    }

    //获取所有tag,*表示所有html标签
    tag=tag || "*";

    //获取tag标签DOM节点
    els=root.getElementsByTagName(tag);

    //获取类，若等于str,则将类存放一个arr数组中
    for(var i= 0,len=els.length;i<len;i++){
        //遍历每个元素中是否含有带str类的节点
        arr2=els[i].className.split(" ");
        for(var j= 0,len2=arr2.length;j<len2;j++){
            if(arr2[j]==str){
                resultarr.push(els[i]);
                break;
            }

        }
    }

    return resultarr;


}


//查找等于数组中某个元素的个数
function countArr(arr,str) {
    //统计等于str的个数
    var counter=0;
    for(var i= 0,len=arr.length;i<len;i++) {
        if(arr[i]==str){
            counter++;
        }
    }

    return counter;

}

//写一个反序函数
function fanXu(arr02){
    var t;
    for(var i= 0,len=arr02.length/2;i<len;i++) {
        t=arr02[i];
        arr02[i]=arr02[arr02.length-1-i];
        arr02[arr02.length-1-i]=t;
    }

    return arr02;

}


//挑出大于num数的函数
function gtNum(arr,num) {
    //建立一个新数组，用于存储大于200的数
    var newArr=[];
    for(var i= 0,len=arr.length;i<len;i++){
         if(arr[i]>num) {
            newArr.push(arr[i]);
         }
    }

   //alert(newArr[0]);
    return newArr;

}


//用冒泡法对指定数组进行排序
function paiXu(arr) {
    var temp;  //存放临时数据

    //排序趟数
    for(var i= 0,len=arr.length-1;i<len;i++){
         //每趟比较次数
        for(var j= 0,len2=arr.length-1-i;j<len2;j++){
              //若当前数比较下个数大，则交互相邻两数
              if(arr[j]>arr[j+1]) {
                  temp=arr[j];
                  arr[j]=arr[j+1];
                  arr[j+1]=temp;

              }
        }
    }

    return arr;
}


//查大写字母函数
function dxzm(s) {
    //定义数组用于存放大写字母
    var arr=[];
    for(var i= 0,len= s.length,k;i<len;i++){
        k=s.charCodeAt(i);
        if(k>=65 && k<=90) {
            arr.push(s[i]);
        }
    }


    if(arr.length==0) {
        return "此串没有大写字母";
    }
   return arr;

}

//判断字符串是否对称函数
function duiChen(s) {
    var flag=1; //定义标志，对称为1，0表示不对称
    for(var i= 0,len= s.length;i<len;i++){
        if(s[i]!=s[s.length-1-i]) {
            console.log(i);
            console.log(s.length-1-i);
            flag=0;
        }
    }




    try{
        //检测有问题的代码
        if(flag==1) {
            return s+"是对称字符串";
        }
    }catch (e){

        alert(e.message);
    }




   if(flag==0) {
       return s+"不是对称字符串";
   }


}




