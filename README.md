# Simple Calculator Project

This project includes a simple web application for a calculator and 1000 random calculation operations generated by a "bot". Users can perform basic mathematical operations (addition, subtraction, multiplication, division) by selecting two numbers and an operator. Additionally, the "bot" function performs 1000 calculation operations on random numbers and saves the results to a JSON file.

## Project Contents

- `index.html`: HTML file containing the interface of the web application.
- `calculator_backend.php`: PHP file performing the calculation operations.
- `calculations/`: Folder where JSON files of calculations generated by the bot are saved.

## Usage

1. Open the `index.html` file in a browser to launch the web application.
2. Perform calculations by selecting two numbers and a mathematical operator, then click the "Calculate" button.
3. Observe the 1000 calculations generated by the bot by clicking the "Create Random 1000 calculation" button.

## Important Notes

- The web application and bot provide users with the ability to perform simple calculations and generate random calculations.
- Security measures have been implemented to protect against XSS attacks for user inputs.
