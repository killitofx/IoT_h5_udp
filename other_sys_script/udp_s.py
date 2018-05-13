import socket
import json
import requests
import time
import sys
import os

address = ('0.0.0.0', 9999)
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.bind(address)

device = {}
php_api = "http://192.169.10.11/iot3/function/py-api.php"

def select_status(pid):
    kv = {"token": "python", "method": "s", "pid": pid}
    r = requests.get(php_api, params=kv)
    # data = json.loads(r.text)
    return r.text

def change_state(pid,state):
    # if int(pid) in device:
    #     addr = device[int(pid)]
    #     send = {"pid": pid, "state": state}
    #     send = json.dumps(send).encode()
    #     s.sendto(send, addr)
    kv = {"token": "python", "method": "up", "pid": pid, "state": state}
    r = requests.get(php_api, params=kv)


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
                # try:
                exec(cmd)
                # except:
                #     print("%s =》 %s语法错误" %(father, son))



while True:
    data, addr = s.recvfrom(2048)
    data = json.loads(data)
    print("received:", data, "from", addr)

    if data["from"] == "php":
        if data["method"] == "up":
            pid = data["pid"]
            state = data["state"]
            print(data["pid"], data["state"])
            apply_ruler(pid, state)
            if int(pid) in device:
                addr = device[int(pid)]
                send = {"pid": pid, "state": state}
                send = json.dumps(send).encode()
                s.sendto(send, addr)
        elif data["method"] == "up_all":
            for pid in device:
                addr = device[pid]
                send = select_status(pid).encode()
                s.sendto(send, addr)
            print("up_all")

    elif data["from"] == "mpy":
        if data["method"] == "reg":
            pid = data["id"]
            device[pid] = addr
            print(device)
            send = select_status(pid).encode()
            s.sendto(send, addr)





