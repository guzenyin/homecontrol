from app import webApp

@webApp.route('/')
@webApp.route('/index')
def index():
    return "Hello, World!"
