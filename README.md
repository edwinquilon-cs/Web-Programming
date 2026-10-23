Vehicle Fleet Management System
A beginner-friendly PHP project demonstrating Object-Oriented
Programming (OOP) concepts through a simple car dealership vehicle fleet
management system.
Project Overview
This project models three types of vehicles---cars, trucks, and
motorcycles---using a shared Vehicle base class. It shows how
inheritance and method overriding help organize reusable code while
allowing each vehicle type to display its own specific information.
Features
- Vehicle base class: Stores shared vehicle details: brand, model,
  year, and price.
- Specialized vehicle classes: Car, Truck, and Motorcycle
  extend Vehicle.
- Method overriding: Each subclass overrides displayInfo() to
  show its own additional details.
- Vehicle comparison: Compares two vehicles by price or model
  year.
- Static vehicle counter: Tracks the number of vehicle objects
  created during the current PHP request.
- HTML form: Accepts information for a new car, truck, or
  motorcycle.
- Input validation and output escaping: Validates submitted values
  and uses HTML escaping when displaying user-provided text.
Technologies Used
- PHP
- HTML
- Object-Oriented Programming (OOP)
OOP Concepts Demonstrated
  Concept                             How it is used
  Classes and objects                 Defines vehicle types and creates
                                      sample vehicle objects.

  Encapsulation                       Uses protected and private
                                      properties to control access.

  Inheritance                         Car, Truck, and Motorcycle
                                      inherit from Vehicle.

  Constructors                        Initialize vehicle properties when
                                      objects are created.

  Method overriding                   Each subclass provides its own
                                      displayInfo() implementation.

  Polymorphism                        The same displayInfo() method
                                      produces details specific to the
                                      object's class.

  Static properties and methods       Counts vehicle objects created
                                  during the current request.
Vehicle Types
- Car: Includes the number of doors.
- Truck: Includes cargo capacity in kilograms.
- Motorcycle: Includes handlebar type.
The application also creates sample vehicles and compares the sample car
with the sample truck by price and model year.
Getting Started
Requirements
- PHP 7.4 or later
- A code editor such as Visual Studio Code
- A web browser
Run the project locally
1. Save the PHP program from this assignment in a file named
   index.php.
2. Open a terminal in the folder containing index.php.
3. Start PHP's built-in development server:
   php -S localhost:8000
4. Open this address in your browser:
   http://localhost:8000
You can also run the project using a local PHP environment such as
XAMPP. If you use XAMPP, place the project folder inside htdocs, start
Apache, and visit the matching local URL.
Example Data
The program includes these sample objects:
- Car: Toyota Camry (2025)
- Truck: Ford F-150 (2024)
- Motorcycle: Honda Rebel 500 (2025)
You can use the form to enter a new vehicle and view its details after
submission.
Current Scope and Limitations
- This is a learning project, not a complete production
  fleet-management application.
- Vehicle information is not saved to a database; submitted objects
  are created during the current request.
- The vehicle counter is reset when a new PHP request starts.
- The form displays fields for all vehicle-specific properties. Enter
  the property that matches the selected vehicle type.
What I Learned
Through this assignment, I practiced designing a reusable base class,
extending it with specialized subclasses, overriding methods, creating
objects, comparing object data, and processing form input in PHP. The
project helped me understand how OOP can reduce duplicated code and make
an application easier to extend.
Author
Edwin Quilon
Computer Science Student
Academic Project
Created as part of Unit 5: Object-Oriented PHP Vehicle Fleet
Management System.
