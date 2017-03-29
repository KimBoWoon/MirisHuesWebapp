import time
import urllib.error, urllib.parse, urllib.request
import json
import requests
import config
from flask import render_template
from datetime import datetime
from MirisHuesWebapp import app
from azure.storage.blob import BlobService

cognitiveUrl = config.COGNITIVE_URL
cognitiveKey = config.COGNITIVE_KEY
maxNumRetries = 10


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
    return render_template(
        'index.html',
        title='About Page',
        year=datetime.now().year,
    )


@app.route('/text', methods=['GET'])
def cognitiveText():
    headers = {
        # Request headers
        'Content-Type': 'application/json',
        'Ocp-Apim-Subscription-Key': config.COGNITIVE_KEY,
    }

    params = urllib.parse.urlencode({
        # Request parameters
        'language': 'en',
        'detectOrientation ': 'true',
    })

    data = None

    urlImage = azureStorageList()
    imageUrlJson = {'url': urlImage}

    try:
        result = processRequest(imageUrlJson, data, headers, params)
        print(result)
        return json.dumps(result)
    except Exception as e:
        print("[Errno {0}]".format(e))


def processRequest(json, data, headers, params):
    """
    Helper function to process the request to Project Oxford

    Parameters:
    json: Used when processing images from its URL. See API Documentation
    data: Used when processing image read from disk. See API Documentation
    headers: Used to pass the key information and the data type request
    """

    retries = 0
    result = None

    while True:
        response = requests.request('post', cognitiveUrl, json=json, data=data, headers=headers, params=params)

        if response.status_code == 429:
            print("Message: %s" % (response.json()['error']['message']))

            if retries <= maxNumRetries:
                time.sleep(1)
                retries += 1
                continue
            else:
                print('Error: failed after retrying!')
                break
        elif response.status_code == 200 or response.status_code == 201:
            if 'content-length' in response.headers and int(response.headers['content-length']) == 0:
                result = None
            elif 'content-type' in response.headers and isinstance(response.headers['content-type'], str):
                if 'application/json' in response.headers['content-type'].lower():
                    result = response.json() if response.content else None
                elif 'image' in response.headers['content-type'].lower():
                    result = response.content
        else:
            print("Error code: %d" % (response.status_code))
            print("Message: %s" % (response.json()['error']['message']))

        break

    return result


def azureStorageList():
    urlPath = None
    block_blob_service = BlockBlobService(account_name=config.AZURE_STORAGE_NAME,
                                          account_key=config.AZURE_STORAGE_KEY)

    generator = block_blob_service.list_blobs('images')
    for blob in generator:
        urlPath = block_blob_service.make_blob_url('images', blob.name)

    return urlPath
