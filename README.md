## Symfony Calculator Module Example

A simple command-line calculator that performs basic mathematical operations such as addition, subtraction, multiplication, and division, and also square root.

### Requirements

- PHP 7.2.5 or higher
- Symfony 5.4 or higher

### Installation

Clone the repository:
```
git clone https://github.com/AlexandruNicolaePopa/SymfonyCalculatorExample.git
```
Install the dependencies:

```
composer install
```

### Usage
The calculator can be used through the command-line interface. To use the calculator, you need to run the following command:

```
php bin/console app:calculator "expression"
```
Where expression is the mathematical expression you want to calculate.

### Examples

- To calculate 5 + 2:

```
php bin/console app:calculator "5 + 2"
```
- To calculate the square root of 9:

```
php bin/console app:calculator "9 sqrt"
```

### Testing
To run the tests, use the following command:

```
php bin/phpunit
```

Or the following command for a detailed execution of the tests:

```
php bin/phpunit --debug
```

### License
This project is licensed under the MIT License.