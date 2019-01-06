$(document).ready(function() {
    //getMessage();
//	token是自动生成的guid
//在本地测试请解开此注释
//localStorage.setItem("123123123")
    if(localStorage.getItem("token")){
        if(window.WebSocket){
            startConnect();
        }
    }
});
function getMessage(){
    $.ajax({
        type: "GET",
        url: "/user/get/message",
        data: {code:"code.life"},
        dataType: "json",
        success: function(data){
            for (var i = 0; i < data.length; i++) {
                message =JSON.parse(data[i]);
                addMessage(message.img,message.comment,message.time);
            }
        }
    });
}
function addMessage(img,comment,time){
    var now = new Date();
    var div = document.getElementById('chat-messages');
    var portrait = null;
    if(localStorage.getItem("userInfo")){
        portrait = JSON.parse(localStorage.getItem("userInfo")).portrait;
    }
    if(img== portrait){
        div.innerHTML = div.innerHTML + "<div class='message right'><img src='"+img+"'><div class='bubble'><xmp class='chatXmp'>"+comment+"</xmp><div class='corner'></div><span>"+timesFun(time).timesString+"</span></div></div>";
    }else{
        div.innerHTML = div.innerHTML + "<div class='message'><img src='"+img+"'><div class='bubble'><xmp class='chatXmp'>"+comment+"</xmp><div class='corner'></div><span>"+timesFun(time).timesString+"</span></div></div>";
    }
    div.scrollTop = div.scrollHeight;
}


function startConnect(){
    var url = null;
    if("https:" == document.location.protocol){
        url ="wss://";
    }else{
        url ="ws://";
    }
    url = url+window.location.host+"/websocket/"+code+"/"+localStorage.getItem("token");
    webSocket = new WebSocket(url);//一个websocket
    webSocket.onerror = function(event) {//websocket的连接失败后执行的方法
        onError(event)
    };
    webSocket.onopen = function(event) {//websocket的连接成功后执行的方法
        onOpen(event)
    };
    webSocket.onmessage = function(event) {//websocket的接收消息时执行的方法
        onMessage(event)
    };
}

function onMessage(event) {
    message =JSON.parse(event.data);
    addMessage(message.img,message.comment,message.time);
}
function onOpen(event) {
}
function onError(event) {
    console.log("连接服务器发生错误")
}
function sendMessage(){
    if(localStorage.getItem("token")){
        if(webSocket.readyState != 1){//断了或其他原因连不上，就得重新连接一下
            startConnect();
        }
        var img = $("#user_img").attr("src");
        var comment = $("#comment").val();
        message=new Object();
        message.img = img;
        message.comment = comment;
        message.time = formatDate(new Date());
        if(comment != null && comment != ""){
            var div = document.getElementById('chat-messages');
            webSocket.send(JSON.stringify(message));//向服务器发送消息
            div.scrollTop = div.scrollHeight;
            $("#comment").val("");//清空输入框
        }
    }else{
        login();
    }
}

$(document).keypress(function(e) {
    var eCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
    if (eCode == 13){
        sendMessage();
    }
});





function timesFun (timesData) {
    //如果时间格式是正确的，那下面这一步转化时间格式就可以不用了
    var dateBegin = new Date(timesData.replace(/-/g, "/"));//将-转化为/，使用new Date
    var dateEnd = new Date();//获取当前时间
    var dateDiff = dateEnd.getTime() - dateBegin.getTime();//时间差的毫秒数
    var dayDiff = Math.floor(dateDiff / (24 * 3600 * 1000));//计算出相差天数
    var leave1 = dateDiff % (24 * 3600 * 1000)    //计算天数后剩余的毫秒数
    var hours = Math.floor(leave1 / (3600 * 1000))//计算出小时数
    //计算相差分钟数
    var leave2 = leave1 % (3600 * 1000)    //计算小时数后剩余的毫秒数
    var minutes = Math.floor(leave2 / (60 * 1000))//计算相差分钟数
    //计算相差秒数
    var leave3 = leave2 % (60 * 1000)      //计算分钟数后剩余的毫秒数
    var seconds = Math.round(leave3 / 1000);
    var timesString = '';

    if (dayDiff != 0 && dayDiff > 0) {
        timesString = dayDiff + '天前';
    } else if (dayDiff == 0 && hours != 0) {
        timesString = hours + '小时前';
    } else if (dayDiff == 0 && hours == 0 && minutes!=0) {
        timesString = minutes + '分钟前';
    }else if(minutes ==0 || dayDiff <= 0){
        timesString = '现在';
    }
    return {
        timesString: timesString
    }
}


function formatDate(time){
    var date = new Date(time);
    var year = date.getFullYear(),
        month = date.getMonth() + 1,//月份是从0开始的
        day = date.getDate(),
        hour = date.getHours(),
        min = date.getMinutes(),
        sec = date.getSeconds();
    var newTime = year + '-' +
        month + '-' +
        day + ' ' +
        hour + ':' +
        min + ':' +
        sec;
    return newTime;
}