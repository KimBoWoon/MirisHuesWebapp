from flask import Flask
import os

app = Flask(__name__)


@app.route('/')
def hello_world():
    return 'Hello World!'


if __name__ == '__main__':
    HOST = os.environ.get('SERVER_HOST', 'localhost')
    PORT = int(os.environ.get('SERVER_PORT', '5555'))
    app.run(HOST, PORT)
