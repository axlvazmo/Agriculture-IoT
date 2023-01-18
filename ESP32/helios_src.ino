#include <HTTPClient.h>
#include <WiFi.h>
#include <Wire.h>
#include "DHT.h"

#define DHTTYPE   DHT22

/* Network Credentials */
const char* ssid     = "XYZ";    // network ssid
const char* password = "XYZ";      // network password

/* WiFi Global Variable Definitions */
const char* server_name = "http://192.168.1.206/post-esp-data.php";   // URL for posting data to database
String api_key_value = "tPmAT5Ab3j7F9";       // key value for database authentication

/* GPIO Global Variable Definitions */
const int solar_panel_port_number = 34;       // ADC port for solar panel 
const int temperature_port_number = 33;       // ADC port for temperature sensor
const int humidity_port_number = 32;          // ADC port for humidity sensor

/* Global Variable Definitions */
float solar_panel_reading = 0;
float temperature_reading = 0;
float humidity_reading = 0;
DHT dht_temperature(temperature_port_number, DHTTYPE);    // DHT object for temperature reading
DHT dht_humidity(humidity_port_number, DHTTYPE);          // DHT object for humidity reading

void setup() {
  Serial.begin(115200);
  
  WiFi.begin(ssid, password);               // starting wifi connection
  Serial.println("Connecting");             // echo feedback
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");                      // stall while connecting
  }
  Serial.println("");
  Serial.print("Connected to WiFi network: " + WiFi.SSID() + ", with IP address: ");  // echo connection successful
  Serial.println(WiFi.localIP());

  dht_temperature.begin();      // starting sensors
  dht_humidity.begin();
}

void loop() {

  //Check WiFi connection status
  if(WiFi.status()== WL_CONNECTED){
    WiFiClient client;
    HTTPClient http;
    
    /* HTTP Setup */
    http.begin(client, server_name);   // Domain name with URL path or IP address with path
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  // Specify content-type header
  
    /* Obtaining ADC Measurements */
    solar_panel_reading = analogRead(solar_panel_port_number);    // reading analog value from solar panel
    temperature_reading = dht_temperature.readTemperature();      // reading temperature
    humidity_reading = dht_humidity.readHumidity();               // reading humidity
    if (isnan(temperature_reading) || isnan(humidity_reading)) {  // checking if DHT sensors provided valid readings
      Serial.println(F("Failed to read from DHT Sensor!"));
    }
    // Prepare your HTTP POST request data
    String http_request_data = "api_key=" + api_key_value + "&solar=" + String(solar_panel_reading) + "&temp=" + String(temperature_reading) + "&humid=" + String(humidity_reading) + "";  // creating http request string
    Serial.println("HTTP Request Data: " + http_request_data);    // echo http request string

    /* Sending HTTP POST request */
    int http_response_code = http.POST(http_request_data);
        
    if (http_response_code>0) {   // if request successfu;
      Serial.println("HTTP Response code: " + String(http_response_code));  // echo http response
    }
    else {
      Serial.println("Error: " + String(http_response_code));   // echo error if present
    }
    /* Free HTTP Resources */
    http.end();
  }
  else {
    Serial.println("WiFi Not Connected");   // echo wifi not connected
  }
  //Send an HTTP POST request every 30 seconds
  delay(30000);  
}
