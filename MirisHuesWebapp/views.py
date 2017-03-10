from datetime import datetime
from flask import render_template
from MirisHuesWebapp import app

@app.route('/')
@app.route('/home')
def home():
    """Renders the home page."""
    return render_template(
        'index.html',
        title='Home Page',
        year=datetime.now().year,
    )

@app.route('/about')
def about():
    """Render the about page"""
    return 'Hello World!'

@app.route('/user')
def user():
    """Render the user page"""
    return 'Hello World!'
