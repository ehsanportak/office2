from flask import abort, Flask, render_template, request


ALLOWED_IPS = ['192.168.1.', '127.0.0.1']

app = Flask(__name__)

@app.errorhandler(403)
def permission_error(e):
    return render_template('403.html', error_code=403), 403

@app.before_request
def limit_remote_addr():
    client_ip = str(request.remote_addr)
    valid = False
    for ip in ALLOWED_IPS:
        if client_ip.startswith(ip) or client_ip == ip:
            valid = True
            break
    if not valid:
        abort(403)


@app.route('/', methods = ['GET'])
def home():
    return "Your IP: {}".format(request.remote_addr)

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)