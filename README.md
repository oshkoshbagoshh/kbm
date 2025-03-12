# Klutch Products (WIP)

## Overview

This project is a vanilla PHP application designed to automate the generation of affiliate links and blog posts. The end goal is to have a working website front end using Bootstrap to display all of the articles that have successfully been added to the PostgreSQL database after meeting validation and sanitization.

## Table of Contents

- [Setup](#setup)
- [Directory Structure](#directory-structure)
- [Processing JSON Articles](#processing-json-articles)
- [Form Submission](#form-submission)
- [Displaying Articles](#displaying-articles)
- [API Endpoints](#api-endpoints)
- [Environment Variables](#environment-variables)
- [Running the Project](#running-the-project)

## Setup

1. **Clone the repository**:

   ```sh
   git clone https://github.com/oshkoshbagoshh/klutch-products.git
   cd klutch-products
   ```

2. **Install dependencies**:

   ```sh
   composer install
   ```

3. **Set up environment variables**:
   Copy the `.env.example` file to `.env` and update the necessary values.

   ```sh
   cp .env.example .env
   ```

4. **Set up the database**:
   Ensure you have a PostgreSQL database set up and update the `.env` file with the database credentials.

5. **Run database migrations**:
   ```sh
   php artisan migrate
   ```

## Directory Structure
