# fulll - Hiring Test

## Algo Test (FizzBuzz)

[https://codesandbox.io/p/devbox/5l2j8g](https://codesandbox.io/p/devbox/5l2j8g)

## Backend (DDD & CQRS Intermédiaire/Sénior)

Tech Stack:
- PHP 8.1
- Behat
- Symfony 6.4 (In Step Two)
- Apache (In Step Two)
- MySQL (In Step Two)
- Docker (In Step Two)

### Step One

This version was built based on the PHP/Boilerplate, no frameworks were used, and the persistence is made in-memory.

#### **Requirements**
To run this project you will need a computer with PHP and composer installed.

#### **Install**
To install the project, you just have to run `composer install` to get all the dependencies

#### **Running the tests**
After installing the dependencies you can run the tests with this command `php vendor/behat/behat/bin/behat`.
The result should look like this :

![./stepOne/behat.jpg](./stepOne/behat.jpg)

### Step Two & Three

#### **Install**

#### **1️⃣ Go To Project's Directory**
```bash
cd stepTwoTree
```

#### **2️⃣ Build & Start Services with Docker**
```bash
docker-compose up -d --build
docker exec -it fulll_test_php-fpm bash
```

#### **3️⃣ Install the needed libraries & clear cache**
```bash
composer install
php bin/console c:c
```

#### **4️⃣  **
```bash
php bin/console do:da:c
php bin/console do:mi:mi
```


#### **5️⃣ Run Behat**
```bash
vendor/behat/behat/bin/behat
```

#### **6️⃣ Run PHPStan Analysis**
```bash
vendor/bin/phpstan analyse
```

_And you're ready to go!_


### Console Commands

#### **Creates Fleet**

```bash
php bin/console fleet:create "First Fleet"
```

#### **Registers Vehicle in a Fleet**

```bash
php bin/console fleet:register-vehicle "First Fleet" "ABC123"
```

#### **Localizes Vehicle in a Fleet & Location**

```bash
php bin/console fleet:localize-vehicle "First Fleet" "ABC123" 43.2 5.4
```

### Code Quality Tools

#### **PHPStan - Level 10**: 

Strictest static analysis level; detects potential bugs, type mismatches, and ensures robust code quality by enforcing strict type checks and best practices.

#### **PHPCS Fixer**: 

Ensures consistent Symfony-based coding standards, strict types, modern short-array syntax, removes unused imports, aligns and orders PHPDocs and imports, and enforces strict comparisons and parameter types—resulting in cleaner, maintainable, and readable code.

### CI/CD Setup/Process (TBC)