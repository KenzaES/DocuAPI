# DocuAPI

## Project Context

This project uses Laravel to develop a secure and well-documented API. It integrates Laravel Breeze for authentication, Laravel Resources to structure API responses, and Scramble to generate the documentation. The goal is to provide an API ready for consumption by external developers with clear and interactive documentation.

## User Stories

- **Developer**: I need to be able to connect to the API via Laravel Breeze to secure access to the endpoints.
- **User**: I want to perform CRUD operations on resources (e.g., articles, products) via secure API endpoints.
- **Tester**: I want to use Postman to test each endpoint, verify security, and validate JSON responses structured by Laravel Resources.
- **API Developer**: I want to generate clear and detailed API documentation using Swagger, Scribe, or Scramble so that developers can understand and use the API easily.

## Design

- **RESTful API Structure**: API structured according to best REST practices with clear and well-defined endpoints.
- **Interactive Documentation**: Automatically generated API documentation using tools like Swagger, Scribe, or Scramble, offering usage examples and live tests.
- **Request Validation**: Implementation of validation rules to ensure that data sent to the API is correct and secure.

## Project Structure

1. **Authentication with Laravel Breeze API**
   - Implement authentication via Laravel Breeze to secure access.

2. **CRUD Endpoints**
   - Development of CRUD endpoints for managing resources (e.g., articles, products), using Laravel Resources to structure responses.

3. **API Documentation**
   - Generation and publication of comprehensive API documentation using Swagger, Scribe, or Scramble.

4. **API Testing with Postman**
   - Manual testing of each endpoint via Postman, including authentication checks, data validation, and JSON response structure validation.

## Features with Laravel

- **Complete CRUD with Laravel**: Development of CRUD operations to manage resources, using Laravel Resources to format responses.
- **Authentication with Laravel Breeze API**: Securing the API with Laravel Breeze, managing authentication tokens, and access permissions.
- **API Testing with Postman**: Configuration of Postman tests to validate each endpoint, including tests for success and failure scenarios.
- **Documentation with Swagger/Scribe**: Generation of detailed and interactive API documentation, including request examples and explanations for each endpoint.

## Prerequisites

- PHP 8.x
- Composer
- Laravel 8.x or higher
- Node.js (for front-end dependencies)
- MySQL or other supported database

## Installation


bash
Copy code
composer install
npm install
Configure the Environment File

Copy the .env.example file to .env and configure the environment settings, including database information.

bash
Copy code
cp .env.example .env
Generate Application Key

bash
Copy code
php artisan key:generate
Run Migrations

bash
Copy code
php artisan migrate
Start the Development Server

bash
Copy code
php artisan serve
API Documentation
Generating Documentation
Analyze API Routes

bash
Copy code
php artisan scramble:analyze
Export API Documentation

bash
Copy code
php artisan scramble:export
Accessing Documentation
Local Documentation: After exporting, you can view the interactive documentation by hosting it with Swagger UI or another tool. Ensure the path to api.json is correctly configured.

Example: Place Swagger UI in the public/swagger directory and configure it to use /api.json.

Testing
Run the tests to ensure everything is working correctly:

bash
Copy code
php artisan test
Running Specific Tests
Functional Tests: Run functional tests with Pest:

bash
Copy code
vendor/bin/pest
Contributing
We welcome contributions to this project! Please follow these guidelines:

Fork the repository.
Create a feature branch (git checkout -b feature/your-feature).
Commit your changes (git commit -am 'Add new feature').
Push to the branch (git push origin feature/your-feature).
Create a new Pull Request.
License
This project is licensed under the MIT license.
