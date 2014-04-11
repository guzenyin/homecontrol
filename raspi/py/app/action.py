from app import webApp
from flask import json
from flask import request,Response
import requests

@webApp.route('/')
@webApp.route('/index')
def index():
    return "Home control!"

#摄像头相关接口
@webApp.route('/hc/v1.0/getMonitorStream')
def getMonitorStream():
	#从mjpg-streamer api获取图片,暂时也是用图片模拟.
	resp = requests.get("http://127.0.0.1:8888/APNSImages/upgradeView.png")
	return Response(resp.content, content_type='image/jpg')	

@webApp.route('/hc/v1.0/takeMonitorPicture')
def takeMonitorPicture():
	#截图保存到云盘或者本地
	pass

@webApp.route('/hc/v1.0/startCamMonitor')
def startCamMonitor():
	#启动mjpg-streamer
	pass

@webApp.route('/hc/v1.0/stopCamMonitor')
def stopCamMonitor():
	#停止mjpg-streamer
	pass

#通知发送接口
@webApp.route('/hc/v1.0/sendMessage')
def sendMessage():
	#从客户端发送消息,暂时支持pushover 和 email
	pass

#配置接口
@webApp.route('/hc/v1.0/config/email')
def configEmailAccount():
	#设置邮箱帐号
	pass

@webApp.route('/hc/v1.0/config/pushover')
def configPushoverAccount():
	#设置pushover帐号,包括userid 和 appid
	pass

@webApp.route('/hc/v1.0/config/cloudStorage')
def configCloudStorage():
	#设置相片监控照片存储云盘信息，暂支持baidu云
	pass

@webApp.route('/hc/v1.0/config/workflow')
def configWorkflow():
	#配置联动，e.g:红外感应触发后，发送邮件或者发送pushover通知，或者截图保存
	#温度到达上升或者下降到某个值时，启动空调etc.
	pass

@webApp.route('/hc/v1.0/listServices')
def listServices():
	#获取服务列表
	pass

@webApp.route('/hc/v1.0/getTemperature')
def getTemperature():
	pass

@webApp.route('/hc/v1.0/startSenors')
def startSenors():
	#开始接收感应器数据
	pass

@webApp.route('/hc/v1.0/stopSenors')
def startSenors():
	#停止接收感应器数据
	pass
