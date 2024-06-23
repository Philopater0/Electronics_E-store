from flask import Flask, request, jsonify

from .model import main

app = Flask(__name__)

@app.route("/", methods=['GET','POST'])
def ai():
    if  request.method == 'POST':

        json_data = request.json
        print(json_data)
        rsp = main(json_data)
        # Get the parameters from the POST request
        return   jsonify(rsp),200
    else:
        return 'that was get request'
    return "shd ei-7af"




@app.route("/product", methods=['GET','POST'])
def product():
    if  request.method == 'POST':

        json_data = request.json
        print(json_data)
        rsp = main(json_data)
        # Get the parameters from the POST request
        return   jsonify(rsp),200
    else:
        return 'that was get request gdeeed 7644385763485348'
    return "shd ei-7af"



