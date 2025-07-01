# 🌟 AmigoLink - Social Media Platform

A modern social media platform built with PHP and MySQL, inspired by Twitter/X. Connect with friends, share your thoughts, and stay updated with what's happening around you.

## ✨ Features

### 🔐 Authentication & Security
- **User Registration & Login** with email verification
- **Password Reset** via OTP (One-Time Password)
- **Secure Password Hashing** using PHP's built-in password functions
- **Session Management** with proper security measures
- **Input Validation & Sanitization** to prevent XSS attacks
- **SQL Injection Prevention** using prepared statements

### 📱 Social Features
- **Create Posts** with text, images, and videos
- **Like & Comment** on posts
- **Follow/Unfollow** other users
- **User Profiles** with customizable profile pictures and background images
- **Real-time Search** functionality
- **Feed System** showing posts from followed users

### 🎨 User Interface
- **Modern & Responsive Design** that works on all devices
- **Dark/Light Mode Toggle** for better user experience
- **Clean & Intuitive Navigation**
- **Font Awesome Icons** for better visual appeal
- **Google Fonts Integration** for typography

### 👨‍💼 Admin Features
- **Admin Panel** for user management
- **User Statistics** and monitoring
- **Content Moderation** capabilities

## 🛠️ Technology Stack

- **Backend**: PHP 7+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Libraries**: jQuery, Font Awesome, PHPMailer
- **Server**: Apache/XAMPP

## 📋 Prerequisites

Before running this project, make sure you have:

- **XAMPP** or similar local server environment
- **PHP 7.0** or higher
- **MySQL 5.7** or higher
- **Apache Server**
- **Composer** (for PHPMailer dependencies)

## 📁 Project Structure

```
AmigoLink/
├── admin.php                 # Admin panel
├── classes/
│   └── methods.php          # Core business logic
├── css/                     # Stylesheets
├── database/
│   ├── connection.php       # Database connection
│   └── amigodatabase.txt    # Database schema
├── handle/                  # Form processors
├── images/                  # Static images
├── include/
│   └── logout.php          # Logout functionality
├── js/                     # JavaScript files
├── phpMailer/              # Email library
├── userImagesVedios/       # User uploaded content
├── home.php               # Main feed page
├── index.php              # Login/Register page
├── profile.php            # User profile page
├── settings.php           # User settings
└── README.md              # This file
```

⭐ **Star this repository if you found it helpful!** 
