import socket
import json
import requests
import threading
import logging
import time
import sys
import os
from user_function import *

address = ('0.0.0.0', 9999)
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.bind(address)

device = {}
users = {}
fav = {}
php_api = "http://10.0.2.1/iot3/function/py-api.php"

logger = logging.getLogger('mylogger')
logger.setLevel(logging.DEBUG)
fh = logging.FileHandler('logger.log')
fh.setLevel(logging.DEBUG)
ch = logging.StreamHandler()
ch.setLevel(logging.INFO)
formatter = logging.Formatter('%(levelname)s - %(message)s - %(asctime)s')
fh.setFormatter(formatter)
ch.setFormatter(formatter)
logger.addHandler(fh)
logger.addHandler(ch)


def read_data():
    global device
    logger.info("正在读取缓存的设备列表")
    try:
        with open('device.txt', 'r') as f:
            data = f.read()
            data = json.loads(data)
            for i in data:
                v = (data[i][0], data[i][1])
                device[int(i)] = v
        logger.debug("设备列表读取完成，列表数据为%s" % device)

    except:
        logger.warning("读取设备列表失败，可能是不存在该列表")

def get_name(pid):
    kv = {"token": "python", "method": "name", "pid": pid}
    r = requests.get(php_api, params=kv)
    name = r.text
    name = json.loads(name)
    name = name[0]
    return name

def write_data():
    data = json.dumps(device)
    with open('device.txt', 'w') as f:
        f.write(data)
        logger.debug("device列表写入成功")

def select_relation(pid):
    global fav
    kv = {"token": "python", "method": "fav", "pid": pid}
    r = requests.get(php_api, params=kv)
    data = r.text
    pid = int(pid)
    if data==[]:
        fav[pid] = []
    else:
        data = json.loads(data)
        fav[pid] = data

def pc_notice(pid, state):
    pid = int(pid)
    if pid in fav:
        u = fav[pid]
        for i in users:
            if str(i) in u:
                addr = users[i]
                name = get_name(pid)
                send = {"pid": pid, "state": state, "name": name}
                send = json.dumps(send).encode()
                s.sendto(send, addr)
                logger.debug("通知已发送到%s,%s" % addr)
    else:
        select_relation(pid)
        pc_notice(pid,state)



def select_status(pid):
    kv = {"token": "python", "method": "s", "pid": pid}
    r = requests.get(php_api, params=kv)
    return r.text

def change_state(pid,state):
    kv = {"token": "python", "method": "up", "pid": pid, "state": state}
    r = requests.get(php_api, params=kv)
    logger.debug("ID:%s的设备状态更新为%s，结果为%s" % (pid, state, r.text))


def apply_ruler(father, father_state):
    kv = {"token": "python", "method": "s_rule", "father": father}
    r = requests.get(php_api, params=kv)
    # print(r.text)
    if r.text == []:
        return 0
    else:
        # rec_data = r.text
        rec_data = json.loads(r.text)
        for i in rec_data:
            father = i["father"]
            son = i["son"]
            same = i["same"]
            advanced = i["advanced"]
            father_state = int(father_state)
            # if int(son) in device:
            if advanced == '0':
                if same == '1':
                    state = father_state
                else:
                    if father_state:
                        state = 0
                    else:
                        state = 1
                change_state(son, state)

            else:
                tg = i["tg"]
                t_order = i["t_order"]
                f_order = i["f_order"]
                t_order2 = i["t_order2"]
                f_order2 = i["f_order2"]
                t_order3 = i["t_order3"]
                f_order3 = i["f_order3"]
                cmd = "if(%s):\n\t%s\n\t%s\n\t%s\nelse:\n\t%s\n\t%s\n\t%s" % (tg, t_order, t_order2, t_order3, f_order, f_order2, f_order3)
                # print(cmd)
                try:
                    exec(cmd)
                except Exception as e:
                    logger.error(e)



def main(data,addr):
    global device, users
    if data["from"] == "php":
        if data["method"] == "up":
            pid = data["pid"]
            state = data["state"]
            logger.info("ID为%s的设备状态变更为%s" % (data["pid"], data["state"]))
            if int(pid) in device:
                addr = device[int(pid)]
                send = {"pid": pid, "state": state}
                send = json.dumps(send).encode()
                s.sendto(send, addr)
                pc_notice(pid, state)
            apply_ruler(pid, state)
        elif data["method"] == "up_all":
            for pid in device:
                addr = device[pid]
                send = select_status(pid).encode()
                s.sendto(send, addr)
            logger.info("系统检测到数据大量变更，正在重新发送所有设备的状态")


    elif data["from"] == "pc":
        if data["method"] == "reg":
            uid = data['uid']
            users[uid] = addr
            logger.info("有新的客户端加入了，新的设备IP为%s，端口为%s" % addr)
        elif data["method"] == "alive":
            uid = data['uid']
            users[uid] = addr


    elif data["from"] == "mpy":
        if data["method"] == "reg":
            pid = data["id"]
            device[pid] = addr
            logger.info("有新的设备加入了，新的设备IP为%s，端口为%s" % addr)
            write_data()
            logger.debug("有新的设备加入了，新的设备列表为%s" % device)
            send = select_status(pid).encode()
            s.sendto(send, addr)


logger.debug("\n\n\n\n")
logger.info("系统启动中")
read_data()
logger.info("系统启动完成")
while True:
    data, addr = s.recvfrom(2048)
    data = json.loads(data)
    logger.debug("received: %s, from %s" % (data, addr))
    t = threading.Thread(target=main, args=(data, addr))
    t.start()







