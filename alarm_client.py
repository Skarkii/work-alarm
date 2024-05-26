import requests

url = 'http://localhost:8080/assets/alarm/get_data.php'
# if($_SERVER['HTTP_X_API_KEY'] != "im_safe_i_promise") {
headers = {
    'X_API_KEY': 'im_safe_i_promise',
}

try:
    response = requests.get(url, headers=headers)

    # Check if the request was successful (status code 200)
    if response.status_code == 200:
        print('Request successful!')
        print('Response content:', response.text)
    else:
        print('Request failed with status code:', response.status_code)
        print('Response content:', response.text)

except requests.exceptions.RequestException as e:
    print('Request failed:', e)
