from app import webApp
from flask import json
from flask import request,Response
import requests

@webApp.route('/')
@webApp.route('/index')
def index():
    return "Home control!"

@webApp.route('/hc/v1.0/getMonitorStream')
def getMonitorStream():
	resp = requests.get("http://127.0.0.1:8888/APNSImages/upgradeView.png")
	return Response(resp.content, content_type='image/jpg')	

@webApp.route('/hc/v1.0/takeMonitorPicture')
def takeMonitorPicture():
	pass

@webApp.route('/hc/v1.0/startCamMonitor')
def startCamMonitor():
	pass

@webApp.route('/hc/v1.0/stopCamMonitor')
def stopCamMonitor():
	pass

@webApp.route('/hc/v1.0/sendMessage')
def sendMessage():
	pass

@webApp.route('/hc/v1.0/config/email')
def configEmailAccount():
	pass

@webApp.route('/hc/v1.0/config/pushover')
def configPushoverAccount():
	pass

@webApp.route('/hc/v1.0/config/cloudStorage')
def configCloudStorage():
	pass

@webApp.route('/hc/v1.0/config/workflow')
def configWorkflow():
	pass

@webApp.route('/hc/v1.0/listServices')
def listServices():
	pass

@webApp.route('/hc/v1.0/getTemperature')
def getTemperature():
	pass

@webApp.route('/hc/v1.0/startSenors')
def startSenors():
	pass

@webApp.route('/hc/v1.0/stopSenors')
def stopSenors():
	pass
