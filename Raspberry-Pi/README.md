#**ESP32 Code Breakdown**
- This code is in charge of connecting the microcontroller to the local Wi-Fi, collecting the needed readings from
the sensors, building the HTTP POST request to write all the readings in the database and sending the request to
the Raspberry Pi.

##**Constants and Variables Definitions**
- The first part of the code is the initialization of the global variables used throughout the code. These variables
consist of the network SSID and password, the address of the server (Raspberry Pi), the key value for database
authentication, port numbers used to take in readings, and the objects for the DHT sensor.

##**void setup()**
- This function takes care of all the tasks that need to be executed only once. Here we start the Wi-Fi connection
and echo feedback when the connection is successful, then we start the DHT sensors.

##**void loop()**
- In this function is the main algorithm that takes care of the majority of the tasks, these are the most important
parts of the code:

###**Using ADC to obtaion reading values** 
- I use the analogRead() and the respective DHT functions to get the reading values of the solar panel, humidity and
temperature

'''
code
'''

###**Preparing HTTP POST Request**
- Here I build a request to post the readings to the database, this is done by concatonating the readings and the 
API key. Since all the individual values are in the same string, I separate them by using the special character "&"
so be able to separate the data on the Raspberry Pi.

'''
code
'''

###**Send the HTTP POST Request**
- This part is simple, we just use the http.POST() function to send the request, when this is done we can check if 
the request was successful.

'''
code
'''
