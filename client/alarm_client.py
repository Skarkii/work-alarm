import requests
import time
import threading
from dotenv import load_dotenv
import os
import explorerhat

load_dotenv()
url = os.getenv('POST_URL')


def api_client(q):
    while (True):
        headers = {
                'X_API_KEY': 'im_safe_i_promise',
                'REQUEST': 'is_alive',
                }
        try:
            response = requests.get(url, headers=headers)

            if response.status_code == 200:
                print('Breathed!')
            else:
                print('Failed to breath:', response.status_code)

        except requests.exceptions.RequestException as e:
            print('Request for breath failed:', e)

        time.sleep(5)


button_name_mapping = {
    "one": 2,
    "two": 1,
    "three": 4,
    "four": 3
}

import queue
class LockedQueue:
    def __init__(self):
        self.queue = queue.Queue()
        self.lock = threading.Lock()

    def put(self, item):
        with self.lock:
            self.queue.put(item)

    def get(self):
        with self.lock:
            return self.queue.get()

    def empty(self):
        with self.lock:
            return self.queue.empty()

def play_sound(q):
    print("queued sound play")
    q.put("play")


import subprocess
def code_entered(code):
    command = ["aplay", "-f", "cd", "-N", "error.wav"]

    subprocess.Popen(command)
    print(f'Code : {code} entered')


def read_keys(q, inp):
    code = "";
    def on_press(self):
        button = button_name_mapping.get(self.name)
        nonlocal code
        code += str(button)
        if(len(code) >= 4):
            code_entered(code)
            code = "";
        else:
            # Define the command as a list of strings
            command = ["aplay", "-f", "cd", "-N", "keypad_pressed.wav"]

            subprocess.Popen(command)
    inp.pressed(on_press)

    # explorerhat.input.two.pressed(on_press)
    # explorerhat.input.one.pressed(on_press)
    # explorerhat.input.three.pressed(on_press)
    # explorerhat.input.four.pressed(on_press)

    explorerhat.pause()

if __name__ == "__main__":
    q = LockedQueue()
    t1 = threading.Thread(target=api_client, args=(q,))
    t2 = threading.Thread(target=read_keys, args=(q, explorerhat.input.one))
    t1.start()
    t2.start()
    t1.join()
    t2.join()
