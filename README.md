# StyleSync - Salon Appointment System

![StyleSync Logo](https://via.placeholder.com/150x50?text=StyleSync) 
*Your beauty, our priority*

## Table of Contents
- [Project Description](#project-description)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [Usage](#usage)
- [Screenshots](#screenshots)
- [API Endpoints](#api-endpoints)
- [Contributing](#contributing)
- [License](#license)

## Project Description
StyleSync is a comprehensive salon management and appointment booking system that allows customers to book beauty services online while providing salon administrators with powerful tools to manage branches, staff, services, and appointments.

## Features

### Customer Facing
- User registration and authentication
- Service browsing with details and pricing
- Branch location information
- Multi-step appointment booking process
- Appointment management (view, reschedule, cancel)
- User profile management

### Admin Panel
- Dashboard with key metrics
- Branch management (CRUD operations)
- Service management with pricing
- Staff management with expertise assignment
- Appointment tracking and status updates
- User management
- Reporting and analytics

## Technologies Used

### Frontend
- HTML5, CSS3, JavaScript
- Responsive design with mobile-first approach
- Font Awesome for icons
- Google Fonts (Poppins)

### Backend
- PHP 7.4+
- MySQL database
- PDO for database operations
- Session-based authentication

### Development Tools
- Git for version control
- VS Code (recommended editor)

## Installation

1. **Prerequisites**:
   - Web server (Apache/Nginx)
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Composer (for dependency management)

2. **Setup**:
   ```bash
   # Clone the repository
   git clone https://github.com/yourusername/stylesync.git
   cd stylesync
   
   # Set up database
   mysql -u root -p < database/schema.sql
   
   # Configure environment
   cp config.example.php config.php
