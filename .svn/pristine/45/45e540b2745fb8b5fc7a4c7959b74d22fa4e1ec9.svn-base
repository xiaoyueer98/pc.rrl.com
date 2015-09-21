var myScroll,
        pullDownEl, pullDownOffset,
        pullUpEl, pullUpOffset,
        generatedCount = 0;

var count = 10;
/*
 * ajax调取页面数据
 */
function ajx(page, number) {
    if ((page - 1) * number >= count) {
        return;
    } else {
        $.ajax({
            type: 'POST',
            url: '?s=/Home/Webchatpush/get_recommending_list',
            data: 'page=' + page + '&number=' + number,
            dataType: 'json',
            success: function (data) {
                count = data.count;
                if (data.count == 0) {
                    if ($.trim($("#thelist2").html()) == "") {
                        $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:17px;text-align:center;line-height:50px;">暂时没有数据</div>');
                    }
                    $('#pullUp').hide();
                    return;
                }
                var result = eval(data['result']);

                $(result).each(function (k) {

                    var pay = this.sink == 1 ? "未付款" : "已付款";

                    var str = "";
                    str = '<div class="resultjobs clearfix">'
                            + '<div class="job_title">'
                            + '<div class="left"><h3 class="colorhei">' + this.username + '</h3><span><em class="zhizhao colorlan">' + this.title + '</em></span></div>'
                            + '<div class="right jin_ds"><img src="/Public/images/webchat/xiaoshang.png"  alt="" style="vertical-align:middle"/>' + this.Tariff + '</div>'
                            + '</div>'
                            + '<div class="jobsInfo">'
                            + '<p>' + this.cpname + '' + this.cascname + '' + this.treatmentdata + '进度：<span class="colorlan">' + this.audstartdata + '</span></p>'
                            + '<div class="right colorhui">' + pay + '</div> '
                            + '</div>'
                            + '</div>';
                    $('#thelist2').append(str);

                })
                ++num;


            }
        })
    }
}





/**
 * 滚动翻页 （自定义实现此方法）
 * myScroll.refresh();		// 数据加载完成后，调用界面更新方法
 */

function pullUpAction() {

    setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
        var el, li, i;
        el = document.getElementById('thelist2');
        myScroll.refresh();		// 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)

    }, 2000);	// <-- Simulate network congestion, remove setTimeout from production!
}
function pullUpAction2() {
    setTimeout(function () {    // <-- Simulate network congestion, remove setTimeout from production!
        var el, li, i;
        el = document.getElementById('thelist');

        ajx(1, 10);
        myScroll.refresh();     // 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000);   // <-- Simulate network congestion, remove setTimeout from production!
}
var num = 1;
pullUpAction2();


/**
 * 初始化iScroll控件
 */
function loaded() {
    pullDownEl = document.getElementById('pullDown');
    pullDownOffset = pullDownEl.offsetHeight;
    pullUpEl = document.getElementById('pullUp');
    pullUpOffset = pullUpEl.offsetHeight;

    myScroll = new iScroll('wrapper', {
        scrollbarClass: 'myScrollbar', /* 重要样式 */
        useTransition: false, /* 此属性不知用意，本人从true改为false */
        topOffset: pullDownOffset,
        onRefresh: function () {
            if (pullDownEl.className.match('loading')) {
                pullDownEl.className = '';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
            } else if (pullUpEl.className.match('loading')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
            }
        },
        onScrollMove: function () {
            if (this.y > 5 && !pullDownEl.className.match('flip')) {
                pullDownEl.className = 'flip';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手开始更新...';
                this.minScrollY = 0;
            } else if (this.y < 5 && pullDownEl.className.match('flip')) {
                pullDownEl.className = '';
                pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                this.minScrollY = -pullDownOffset;
            } else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
                pullUpEl.className = 'flip';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
                this.maxScrollY = this.maxScrollY;
            } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
                pullUpEl.className = '';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                this.maxScrollY = pullUpOffset;
            }
        },
        onScrollEnd: function () {
            if (pullDownEl.className.match('flip')) {
                //pullDownEl.className = 'loading';
                // pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
                //pullDownAction();	// Execute custom function (ajax call?)
                $('#pullDown').hide();
            } else if (pullUpEl.className.match('flip')) {
                pullUpEl.className = 'loading';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                pullUpAction();	// Execute custom function (ajax call?)
                ajx(num, 10);

            }
        }

    });

    setTimeout(function () {
        document.getElementById('wrapper').style.left = '0';
    }, 800);
}

//初始化绑定iScroll控件
document.addEventListener('touchmove', function (e) {
    e.preventDefault();
}, false);
document.addEventListener('DOMContentLoaded', loaded, false);

