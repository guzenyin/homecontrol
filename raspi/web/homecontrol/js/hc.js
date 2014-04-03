/**
 * Created with JetBrains WebStorm.
 * User: tin
 * Date: 14-4-3
 * Time: 下午9:09
 * To change this template use File | Settings | File Templates.
 */

//const for Pushover;
var kPushoverUrl = "https://api.pushover.net/1/messages.json";

function sendPushoverMessage(title,message){
    var postData = JSON.stringify({
        token:"ae8stbH21emfZD8uBUt5sK6NgLUJ8z",
        user:"u9mqqPxNdjYoB9NkJdmiSf8djtw8nM",
        message:message,
        title:title
    });
    $.post(kPushoverUrl,postData,function(data, textStatus, jqXHR){
        alert(textStatus);
        var result = JSON.parse(data);
    },"json");
}
