# **Sustainable Agriculture IoT :tractor:**
In this project I make use of different devices and technologies to make an IoT (Internet of Things) application targetted to sustainable agriculture.
I also implemented a user authentication security feature to comply with the characteristics of a cyber-physical system.

## **Materials :paperclip:**
- ESP32 WROOM
- Raspberry Pi 4 Model B
- Small Solar Panel
- DHT22 Temperature and Humidity Sensor

## **Software Used :computer:**
- Arduino IDE
- phpMyAdmin 

## **Design :triangular_ruler:**

### **ESP32**
- The ESP32 collects the analog readings from the solar pannel and the DHT22 sensors through some of the GPIO
ports and converts it to a digital value using ADC (Analog to Digital Conversion).
- It is also connected to wifisends an HTTP request every 30 seconds for the data to be stored in the database
hosted in the Raspberry Pi.

### **Raspberry Pi**
- 

