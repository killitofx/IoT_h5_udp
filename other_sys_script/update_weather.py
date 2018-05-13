import json
import requests

weather_api = "https://www.sojson.com/open/api/weather/json.shtml?city="
php_api = "http://192.169.10.11/iot3/function/py-api.php"


get_city = {"token": "python", "method": "weather", "city": ""}
r = requests.get(php_api, params=get_city)
city = r.text
# print(city)

t = requests.get(weather_api + city)
data = json.loads(t.text)
data = data["data"]
shidu = data["shidu"]
pm25 = data["pm25"]
quality = data["quality"]
wendu = data["wendu"]
fx = data["forecast"][0]["fx"]
typ = data["forecast"][0]["type"]

# print(shidu, pm25, quality, wendu, fx, typ)

kv={"shidu": shidu, "pm25": pm25, "quality": quality, "wendu": wendu, "fx": fx, "type":typ}
for i in kv:
    weather = {"token": "python", "method": "weather", "key": i, "value": kv[i]}
    r = requests.get(php_api, params=weather)

