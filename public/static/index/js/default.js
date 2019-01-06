$(document).ready(function() {
    //添加分页位置的被点击后的样式
    $('.panel-default').hover(function() {
        $(this).addClass("box_shadow");
        $(this).children(".panel-body").children(".comments").removeClass("comment_a");
    },function() {
        $(this).removeClass("box_shadow");
        $(this).children(".panel-body").children(".comments").addClass("comment_a");
    });
    $("#backTopBtn").hide();
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#backTopBtn').fadeIn();
            } else {
                $('#backTopBtn').fadeOut();
            }
        });
        $('#backTopBtn').click(function() {
            $('body,html').animate({
                scrollTop : 0
            }, 'fast');
            return false;
        });
    });


});

function login(){
    $('#myModal').modal("show");
}

function register() {
    $('#myModal2').modal("show");
}
var webSocket = null;
var code ="code.life";
var name = null;

//获取url参数值
function GetQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return  unescape(r[2]); return null;
}
function Trim(str){
    return str.replace(/\s+/g,"");
}
var nowtime = new Date();
var endtime = new Date("2019/01/01,00:00:00");
var lefttime = parseInt((nowtime.getTime() - endtime.getTime()) / 1000);
var d = parseInt(lefttime / (24 * 60 * 60));
var h = parseInt(lefttime / (60 * 60) % 24);
var m = parseInt(lefttime / 60 % 60);
var s = parseInt(lefttime % 60);

var ele_timer = document.getElementById("timer");
var n_sec = s; //秒
var n_min = m; //分
var n_hour = h; //时
var n_day = d; //天
//60秒 === 1分
//60分 === 1小时
function timer() {
    return setInterval(function() {
        var str_sec = n_sec;
        var str_min = n_min;
        var str_hour = n_hour;
        var str_day = n_day;
        if (n_sec < 10) {
            str_sec = "0" + n_sec;
        }
        if (n_min < 10) {
            str_min = "0" + n_min;
        }

        if (n_hour < 10) {
            str_hour = "0" + n_hour;
        }

        var time = str_day + "天" + str_hour + "时" + str_min + "分" + str_sec
            + "秒";
//		document.getElementById('timer').innerText = time;
        $("#timer").html(time)
        n_sec++;
        if (n_sec > 59) {
            n_sec = 0;
            n_min++;
        }
        if (n_min > 59) {
            n_sec = 0;
            n_hour++;
        }
        if (n_hour > 23) {
            n_min = 0;
            n_hour = 0;
            n_day++;
        }

    }, 1000);
}
var n_timer = timer();


var width='70';
var margin_top = '65';
function full(){
    if(width=='100'){
        $("#full").text("全屏查看");
        exitAll();
    }else{
        $("#full").text("退出全屏");
        selectAll();
    }
}
function selectAll(){
    $("#b-public-right").removeClass();
    $("#b-public-right").addClass("hidden");
    $(".header").css("display","none");
    selectAddClass();
}
function exitAll(){
    width = 70;
    margin_top = 65;
    $("#b-public-right").removeClass();
    $("#b-public-right").addClass(" hidden-xs hidden-sm hidden-md");
    $(".header").css("display","block");
    $(".col-lg-8").css("width","70%");
    $("#portfolio").css("margin-top","65px");
}
function timeOut(){
    setTimeout("selectAddClass()",50);
}
function selectAddClass(){
    if(width < 100){
        width=parseInt(width)+1;
        $(".col-lg-8").css("width",width+"%");
        timeOut();
    }
    if(margin_top>0){
        margin_top = parseInt(margin_top)-1;
        $("#portfolio").css("margin-top",margin_top+"px");
        timeOut();
    }
}
var opacity = 0;
$(function(){
    var ua = navigator.userAgent;
    var ipad = ua.match(/(iPad).*OS\s([\d_]+)/),
        isIphone =!ipad && ua.match(/(iPhone\sOS)\s([\d_]+)/),
        isAndroid = ua.match(/(Android)\s+([\d.]+)/),
        isMobile = isIphone || isAndroid;
    //判断
    if(!isMobile){
        $(".blog img").click(function(){
            var src =  $(this).attr("src")
            var img = new Image();
            img.src = src;
            $(".imgViewDom img").attr("src",src);
            $(".imgViewDom img").css("width",img.width);
            $(".imgViewDom").css("display","-webkit-box");
            addClassOpacityImg();
        });
        $(".imgViewDom").click(function(){
            $(".imgViewDom").css("display","none");
            opacity = 0;
        });
    }

});
function addClassTime(){
    setTimeout("addClassOpacityImg()",50);
}
function addClassOpacityImg(){
    if(parseFloat(opacity) < 1){
        opacity = parseFloat(opacity)+0.1;
        $(".imgViewDom").css("opacity",parseFloat(opacity));
        addClassTime();
    }
}