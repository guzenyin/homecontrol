/**
 * Created with JetBrains WebStorm.
 * User: tin
 * Date: 14-4-3
 * Time: 下午9:09
 * To change this template use File | Settings | File Templates.
 */

//const for Pushover;

var kDispatchUrl = "/getway/controller.php";
var kChannelWeb = "web";
var kActionTakePicture = "TakePicture" ;
var kActionSendMessage = "SendMessage" ;

function start(){
    $("#btnSendMessageViaPushover").bind("click",function(e){
        e.preventDefault();
        _sendMessageViaPushover();
    });
    $("#btnTakePicture").bind("click",function(e){
        e.preventDefault();
        _takePicture();
    });
    $("#btnGetTemp").bind("click",function(e){
        e.preventDefault();
        _getTemperature();
    });
    $("#btnSendMessageViaEmail").bind("click",function(e){
        e.preventDefault();
        _sendMessageViaEmail();
    });

}

function _sendMessageViaPushover(){
    doRequest(kActionSendMessage,kDispatchUrl,function(status){},[],null,null,null);
}

function _takePicture(){
    window.open("/snapshot.html","snapshot");
}

function _getTemperature(){
}

function _sendMessageViaEmail(){
}

///Tool
Date.prototype.format = function(format){
    var o = {
        "M+" : this.getMonth() + 1,
        "d+" : this.getDate(),
        "h+" : this.getHours(),
        "m+" : this.getMinutes(),
        "s+" : this.getSeconds(),
        "q+" : Math.floor((this.getMonth() + 3) / 3),
        "S" : this.getMilliseconds()
    }

    if (/(y+)/.test(format))
    {
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4
            - RegExp.$1.length));
    }

    for (var k in o)
    {
        if (new RegExp("(" + k + ")").test(format))
        {
            format = format.replace(RegExp.$1, RegExp.$1.length == 1
                ? o[k]
                : ("00" + o[k]).substr(("" + o[k]).length));
        }
    }
    return format;
}

function isFunction(fn) {
    return !!fn && !fn.nodeName && fn.constructor != String &&
        fn.constructor != RegExp && fn.constructor != Array &&
        /function/i.test( fn + "" );
}

function doAjaxRequestAction(url,data,fnBeforeSend,fnSuccess,fnError,fnComplete) {
    $.ajax({
        type:"post",
        url:url,
        data:data,
        dataType:"json",
        beforeSend:function(xhr,setting){
            if(isFunction(fnBeforeSend)){
                fnBeforeSend();
            }else{
                $.blockUI();
            }
        },
        success:function(result,status,xhr){
            if(isFunction(fnSuccess)){
                fnSuccess(result);
            }
        },
        error:function(xhr,status,errorThrown){
            if(isFunction(fnError)){
                fnError();
            }
        },
        complete:function(xhr,status){
            if(isFunction(fnComplete)){
                fnComplete();
            }else{
                $.unblockUI();
            }
        }
    });
}

function doGeneratePackage(action,params){
    var time = new Date();
    var package = {
        channel:kChannelWeb,
        reqId:Math.uuid(),
        reqDate:time.format("yyyy-MM-dd hh:mm:ss"),
        action:action,
        data:params
    };
    return JSON.stringify(package);
}

function doRequest(action,url,fnSuccess,params,fnBeforeSend,fnError,fnComplete){
    var data = doGeneratePackage(action,params);
    doAjaxRequestAction(url,data,fnBeforeSend,function(data){
        fnSuccess(data.status);
    },fnError,fnComplete);
}