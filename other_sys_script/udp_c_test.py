import socket
import json
pid = 1
addr=('127.0.0.1', 9999)
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

def starts():
    sw = 1
    data = {"method": "reg", "id": pid, "from": "mpy"}
    data = json.dumps(data).encode()
    s.sendto(data, addr)
    while sw:
        d = s.recv(1024).decode()
        d = json.loads(d)
        print(d)
        if (d['pid'] == str(pid)):
            print(d['pid'], d["state"], d["type"])
            sw = 0

starts()
while True:
    d = s.recv(1024).decode()
    d = json.loads(d)
    print(d)
    if (d['pid'] == str(pid)):
        print(d['pid'], d["state"])

