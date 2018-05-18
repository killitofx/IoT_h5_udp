import socket
import json
import threading
import time
from win10toast import ToastNotifier

uid = 9
addr=('127.0.0.1', 9999)
title = '有设备变动了'
times = 3

s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

def build_text(name,state):
    if int(state):
        s="打开了"
    else:
        s="关闭了"
    data = "%s被%s" % (name, s)
    toaster = ToastNotifier()
    toaster.show_toast(title, data, duration=times, icon_path=None)


def starts():
    data = {"method": "reg", "uid": uid, "from": "pc"}
    data = json.dumps(data).encode()
    s.sendto(data, addr)

def alive():
    while True:
        time.sleep(30)
        data = {"method": "alive", "uid": uid, "from": "pc"}
        data = json.dumps(data).encode()
        s.sendto(data, addr)

def main():
    while True:
        d = s.recv(1024).decode()
        d = json.loads(d)
        name = d["name"]
        state = d["state"]
        # 单线程方案
        build_text(name, state)
        # 多线程 会报错
        # t = threading.Thread(target=build_text, args=(name, state))
        # t.start()


starts()
t1 = threading.Thread(target=main)
t2 = threading.Thread(target=alive)
t1.start()
t2.start()

