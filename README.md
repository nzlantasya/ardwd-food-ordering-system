# ardwd-food-ordering-system

A web-based food ordering application developed using PHP and MySQL. This project allows customers to place food orders, submit personal information, and review order details before completing a transaction.

## Features

* Food ordering interface
* Customer information form
* Order summary page
* Order confirmation page
* Database integration using MySQL

## Technologies Used

* PHP
* MySQL
* Apache
* HTML
* CSS
* Burp Suite

## Security Assessment

This project was also used to conduct a security assessment focusing on Parameter Tampering vulnerabilities. HTTP requests were intercepted and modified using Burp Suite to analyze the impact of unauthorized changes to customer information and order details.

## Key Findings

* Customer information could be modified through intercepted requests
* Order quantity manipulation affected stored transaction data
* Lack of server-side validation created data integrity risks

## Screenshots

Project screenshots are available in the `screenshots` folder.
