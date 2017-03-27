from tornado.httpserver import HTTPServer
from tornado.ioloop import IOLoop
from tornado.stack_context import NullContext
from tornado.wsgi import WSGIContainer
from MirisHuesWebapp import app
from os import environ

wsgi_app = app.wsgi_app

if __name__ == '__main__':
    app.run(host="127.0.0.1", port=5555)
    # HOST = environ.get('SERVER_HOST', 'localhost')
    # try:
    #     PORT = int(environ.get('SERVER_PORT', '5555'))
    # except ValueError:
    #     PORT = 5555
    # app.run(HOST, PORT, debug=True)

    # http_server = HTTPServer(WSGIContainer(app))
    # with NullContext():
    #     http_server.bind(port=5555, address="127.0.0.1")
    #     http_server.start(6)
    # IOLoop.instance().start()
