import requests
import time
import threading
from dotenv import load_dotenv
import os

load_dotenv()
print(os.getenv('URL'))

url = 'http://localhost:8080/assets/alarm/get_data.php'


def api_client():
    while (True):
        headers = {
                'X_API_KEY': 'im_safe_i_promise',
                'REQUEST': 'GET_DATA',
                }
        try:
            response = requests.get(url, headers=headers)

            if response.status_code == 200:
                print('Request successful!')
                print('Response content:', response.text)
            else:
                print('Request failed with status code:', response.status_code)
                print('Response content:', response.text)

        except requests.exceptions.RequestException as e:
            print('Request failed:', e)

        time.sleep(5)


def temp():
    while (True):
        print("Thread 2")
        time.sleep(2.5)


if __name__ == "__main__":
    t1 = threading.Thread(target=api_client, args=())
    t2 = threading.Thread(target=temp, args=())
    t1.start()
    t2.start()
    t1.join()
    t2.join()
