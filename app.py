from MirisHuesWebapp import app
from flask_restful import reqparse, Resource, Api

api = Api(app)

# Make the WSGI interface available at the top level so wfastcgi can get it.
wsgi_app = app.wsgi_app


@app.route('/')
def index():
    """Renders home page."""
    return "Python Flask is up and running!"


if __name__ == '__main__':
    import os

    HOST = os.environ.get('SERVER_HOST', 'localhost')
    try:
        PORT = int(os.environ.get('SERVER_PORT', '5555'))
    except ValueError:
        PORT = 5555
    app.run(HOST, PORT)
