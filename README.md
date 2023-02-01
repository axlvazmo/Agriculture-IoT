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

### **ESP32 Code Algorithm**
- After initializing all the necessary variables and start the Wi-Fi connection, the program will check if the
ESP32 is connected to Wi-Fi in the loop function.
- The ESP32 collects the analog readings from the solar pannel and the DHT22 sensors through some of the GPIO
ports and converts it to a digital value using ADC (Analog to Digital Conversion).
- The readings are then sent in an HTTP request to be posted to the database.

### **Raspberry Pi**
-  The Raspberry Pi will act as a server that contains the reading values in the database. This is done through php scripts, one script will
receive the HTTP request and parse the data to write it in the database. The other script will get the data from the database and post it a web-page
that can be accessed from any browser.
- I have created a security layer that implements a user authentication using another php script, which will prompt the user to enter a password.
The data will not be displayed in the website untill the user enters the correct password.

### **Diagram**
- The following diagram gives an overview of all the components and the process of the system.

### **Circuit**
- This is a picture that shows the circuit built on a breadboard.
