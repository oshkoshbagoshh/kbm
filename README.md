# Influencer Platform

The **Influencer Platform** is a vanilla PHP application designed to create dynamic and engaging content for influencers and writers. It leverages **Object-Oriented Programming (OOP)** principles for backend functionality and uses **Tailwind CSS** for a modern, responsive frontend design. This platform allows users to sign up as writers, explore articles, and connect with brands.

![image](https://github.com/user-attachments/assets/c87a9823-26d2-478d-92ac-5410ae95b61e)

## Features

- **Dynamic Content Generation**: Built with vanilla PHP and OOP for clean, modular, and maintainable code.
- **Responsive Design**: Styled with Tailwind CSS for a seamless user experience across devices.
- **Sign-Up Form**: Allows influencers to register with details like name, email, bio, and product group.
- **Article Showcase**: Displays latest articles dynamically with placeholders for future integration.
- **Modern UI**: Designed with a minimalistic and professional look, using Tailwind's utility-first approach.

## Project Structure

```
root/
├── public/
│   ├── index.php           # Main entry point
│   ├── css/                # Tailwind CSS styles (if compiled locally)
│   ├── js/                 # JavaScript files (if needed)
│   └── other assets...     # Static assets like images, fonts, etc.
├── src/
│   ├── classes/            # PHP classes for OOP
│   ├── controllers/        # Controllers for handling logic
│   ├── models/             # Models for database interaction
│   └── views/              # Views for rendering HTML templates
├── composer.json           # Composer dependencies (if used)
├── Procfile                # Heroku process file for deployment
├── README.md               # Project documentation
```

## Prerequisites

- **PHP 7.4+**: Ensure PHP is installed and available on your system.
- **Composer**: For managing dependencies (if applicable).
- **Tailwind CSS**: Included via CDN for simplicity, but can be compiled locally if needed.
- **Web Server**: Apache or Nginx recommended for local development.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/influencer-platform.git
   cd influencer-platform
   ```

2. Set up a local server:
   - If using PHP's built-in server:
     ```bash
     php -S localhost:8000 -t public/
     ```

3. Ensure the `public/` folder is set as the document root when deploying to a web server.

## Deployment

This project is configured for deployment on **Heroku**. Follow these steps:

1. Ensure the `Procfile` is in the root directory:
   ```
   web: heroku-php-apache2 public/
   ```

2. Push the code to Heroku:
   ```bash
   git push heroku master
   ```

3. Scale the web dyno:
   ```bash
   heroku ps:scale web=1
   ```

4. Visit your Heroku app URL to verify the deployment.

## Usage

- **Homepage**: Displays a hero section with a call-to-action for influencers to sign up.
- **Sign-Up Form**: Collects user data (name, email, bio, product group) via a simple form.
- **Articles**: Lists the latest articles with placeholders for dynamic content.

## Technologies Used

- **Backend**:
  - Vanilla PHP
  - Object-Oriented Programming (OOP) principles
- **Frontend**:
  - Tailwind CSS (via CDN)
  - Responsive design for mobile and desktop
- **Deployment**:
  - Heroku (Apache server with PHP)

## Future Enhancements

- **Database Integration**: Add a MySQL or PostgreSQL database to store user and article data.
- **Authentication**: Implement user login and session management.
- **Dynamic Articles**: Fetch and display articles dynamically from the database.
- **API Integration**: Connect with third-party APIs for additional features like analytics or social media sharing.
- **Custom Tailwind Build**: Compile Tailwind CSS locally for optimized performance.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature-name"
   ```
4. Push to your branch:
   ```bash
   git push origin feature-name
   ```
5. Submit a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

## Acknowledgments

- [Tailwind CSS](https://tailwindcss.com/)
- [Heroku](https://www.heroku.com/)
