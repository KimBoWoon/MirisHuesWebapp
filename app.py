from os import environ
from MirisHuesWebapp import app

from tornado.wsgi import WSGIContainer
from tornado.httpserver import HTTPServer
from tornado.ioloop import IOLoop
from tornado.web import RequestHandler, Application
from tornado.stack_context import NullContext

if __name__ == '__main__':
    HOST = environ.get('SERVER_HOST', 'localhost')
    try:
        PORT = int(environ.get('SERVER_PORT', '5555'))
    except ValueError:
        PORT = 5555
    app.run(HOST, PORT, debug=True)

    http_server = HTTPServer(WSGIContainer(app))
    with NullContext():
        http_server.bind(5555, address="127.0.0.1")
        http_server.start(6)
    IOLoop.instance().start()