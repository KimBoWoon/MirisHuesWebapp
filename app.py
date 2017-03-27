from os import environ
from gevent.wsgi import WSGIServer
from MirisHuesWebapp import app

wsgi_app = app.wsgi_app

if __name__ == '__main__':
    # HOST = environ.get('SERVER_HOST', 'localhost')
    # try:
    #     PORT = int(environ.get('SERVER_PORT', '5555'))
    # except ValueError:
    #     PORT = 5555
    # app.run(HOST, PORT, debug=True)

    http_server = WSGIServer(('localhost', 5555), app)
    http_server.serve_forever()

    # http_server = HTTPServer(WSGIContainer(app))
    # with NullContext():
    #     http_server.bind(port=5555, address="127.0.0.1")
    #     http_server.start(6)
    # IOLoop.instance().start()
