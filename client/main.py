import requests
import time
import threading
from dotenv import load_dotenv
import os
import explorerhat

load_dotenv()

def api_client():
    url = os.getenv('POST_URL')
    print('Breath thread started!')
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

def get_data():
    url = os.getenv('GET_URL') 
    headers = {
        'X_API_KEY': 'im_safe_i_promise',
        'REQUEST': 'alarm_data',
    }
    try:
        response = requests.get(url, headers=headers)
        if response.status_code == 200:
            return json.loads(response.text) 
        else:
            print('Failed to breath:', response.status_code)
    except requests.exceptions.RequestException as e:
        print('Request for breath failed:', e)

    return False

import json
from datetime import datetime, timedelta
def alarm_thread(global_activated):
    last_person_time = datetime.now() 
    while(True):
        time.sleep(1)

        data = get_data() 
        if(data['users_in'] > 0):
            last_person_time = datetime.now() 

        if(data['activated'] == 0):
            continue

        if(last_person_time + timedelta(seconds=data['time_upon_empty']) < datetime.now()):
            global_activated[0] = True
            continue

        global_activated[0] = False

from pygame import mixer
import os
mixer.init()
sound = mixer.Sound("alarm.wav")
def motion_sensor_thread(global_activated):
    while(True):
        while(global_activated[0]):
            sensor = explorerhat.analog.one.read()
            if(sensor > 1.2):
                print("ALARM RUNNING!")
                sound.play(loops=-1)
                while(True):
                    data = get_data() 
                    if(data['users_in']):
                        sound.stop()
                        break

                    time.sleep(0.05)
            time.sleep(0.05)
        time.sleep(1)


if __name__ == "__main__":
    global_activated = [False]
    t1 = threading.Thread(target=api_client, args=())
    t2 = threading.Thread(target=alarm_thread, args=(global_activated,))
    t3 = threading.Thread(target=motion_sensor_thread, args=(global_activated,))
    t1.start()
    t2.start()
    t3.start()
    t1.join()
    t2.join()
    t3.join()
