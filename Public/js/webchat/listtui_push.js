var myScroll,
        pullDownEl, pullDownOffset,
        pullUpEl, pullUpOffset,
        generatedCount = 0;
var num = 1;
/**
 * 初始化iScroll控件
 */
function ajx(page, number) {
    $.ajax({
        type: 'POST',
        url: '?s=/Home/Webchatpush/get_resume_list',
        data: 'page=' + page + '&number=' + number+"&jobid="+jobid,
        dataType: 'json',
        success: function (data) {

            count = data.count;
            if (data.count == 0) {
                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:17px;text-align:center;line-height:50px;">暂时没有数据</div>');
                return;
            }
            var data = eval(data['result']);

            for (var i = 0; i < data.length; i++) {
                var str = "";

                if (data[i].deadline == 1) {
                    str =
                            '<div class = "resultjobs clearfix">'
                            + '<div class="left select res" id="res' + i + '"><input type="hidden" value="' + data[i].id + '" id="resumeid"></div>'
                            + '<div class="job_title">'
                            + '<div class="left"style="width:55%"><h3 class="colorhei">' + data[i].username + '</h3></div>'
                            + '</div>'
                            + '<div class="jobsInfo">'
                            + '<p style="width:55%">' + data[i].statedata + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="ytuijian"></span></p>'
                            + '</div>'
                            + '</div>';
                } else {
                   

                    str = ' <div class="resultjobs clearfix" >'
                            + '<div  onclick="change('+ i +')">'
                            + '<div class="left select res" id="res' + i + '"><input type="hidden" value="' + data[i].id + '" id="resumeid"></div>'
                            + '<div class="job_title">'
                            + '<div class="left"style="width:55%"><h3 class="colorhei">' + data[i].username + '</h3></div>'
                            + '</div>'
                            + '<div class="jobsInfo">'
                            + '<p style="width:55%">' + data[i].statedata + '</p>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                }

                $('#thelist2').append(str)
            }
            ++num;
        }
    });
}
function pullUpAction() {
    setTimeout(function () {    // <-- Simulate network congestion, remove setTimeout from production!
        var el, li, i;
        el = document.getElementById('thelist');
        myScroll.refresh(); // 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000); // <-- Simulate network congestion, remove setTimeout from production!
}
function pullUpAction2() {
    setTimeout(function () {    // <-- Simulate network congestion, remove setTimeout from production!
        var el, li, i;
        el = document.getElementById('thelist');
        ajx(1, 10);
        myScroll.refresh(); // 数据加载完成后，调用界面更新方法 Remember to refresh when contents are loaded (ie: on ajax completion)
    }, 1000); // <-- Simulate network congestion, remove setTimeout from production!
}
pullUpAction2()

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
//                pullDownEl.className = 'loading';
//                pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
//                pullDownAction(); // Execute custom function (ajax call?)
                $('#pullDown').hide();
            } else if (pullUpEl.className.match('flip')) {
                pullUpEl.className = 'loading';
                pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                pullUpAction(); // Execute custom function (ajax call?)
                ajx(num, 10)
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