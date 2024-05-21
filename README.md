# Evergreen-Footprints

**Evergreen-Footprints** is an improved version of my previous project, aimed at enhancing functionality and performance by upgrading the technology stack. The initial version used Firebase for the backend, but this version leverages PHP and MySQL, a relational database management system (RDBMS), to deliver a more robust and scalable solution.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)

## Introduction

Evergreen-Footprints is designed to provide a seamless and efficient experience by utilizing a more advanced and reliable backend infrastructure. By migrating from Firebase to PHP and MySQL, the project now benefits from the structured data management and powerful querying capabilities of an RDBMS.

## Features

- Improved backend infrastructure with PHP and MySQL.
- Enhanced data management and retrieval.
- Scalable and robust architecture.
- User-friendly interface and seamless user experience.

## Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Installation

To set up the project locally, follow these steps:

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/evergreen-footprints.git
    cd evergreen-footprints
    ```

2. **Set up the database:**
    - Create a MySQL database and import the provided SQL file (`database.sql`) to set up the necessary tables.

3. **Configure the backend:**
    - Update the database configuration in `config.php` with your MySQL credentials:
    ```php
    
    <?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'evergreenfootprints');
    define('PORT', '3307');
    ?>
    

4. **Install dependencies:**
    - Ensure you have PHP installed on your system. If not, download and install it from [PHP's official website](https://www.php.net/downloads).
    - You may need to install additional PHP extensions depending on your project requirements (e.g., `mysqli` for database interaction).

5. **Run the server:**
    - Use a local development server like XAMPP, WAMP, or MAMP to host the project. Alternatively, you can use the built-in PHP server:
    bash
    php -S localhost:8000
    

## Usage

1. **Access the application:**
    - Open your web browser and navigate to `http://localhost:8000`.

2. **User registration and login:**
    - Register a new user account or log in with existing credentials to start using the application.

3. **Explore features:**
    - Utilize the various features provided by Evergreen-Footprints, such as data management and retrieval functionalities.

## Contributing

We welcome contributions to improve Evergreen-Footprints. To contribute, follow these steps:

1. **Fork the repository:**
    - Click on the "Fork" button on the top right corner of the repository page.

2. **Clone your forked repository:**
    bash
    git clone https://github.com/your-username/evergreen-footprints.git
    cd evergreen-footprints
    

3. **Create a new branch:**
    bash
    git checkout -b feature-branch
    

4. **Make your changes and commit:**
    - Ensure your code follows the project's coding standards and conventions.
    bash
    git commit -m "Add new feature"
    

5. **Push to your forked repository:**
    bash
    git push origin feature-branch
    ```

6. **Create a pull request:**
    - Navigate to the original repository and click on the "New Pull Request" button to submit your changes for review.

By following these guidelines, you can help enhance Evergreen-Footprints and contribute to its ongoing development.

---

Feel free to reach out if you have any questions or need further assistance with the project. Happy coding!
