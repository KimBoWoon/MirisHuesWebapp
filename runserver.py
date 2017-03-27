from MirisHuesWebapp import app
from werkzeug.contrib.fixers import ProxyFix

# wsgi_app = app.wsgi_app
app.wsgi_app = ProxyFix(app.wsgi_app)

if __name__ == '__main__':
    from wsgiref.simple_server import make_server

    httpd = make_server('localhost', 5555, app.wsgi_app)
    httpd.serve_forever()
