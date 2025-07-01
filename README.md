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

## 🚀 Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/AmigoLink.git
cd AmigoLink
```

### Step 2: Set Up Database
1. Start your XAMPP server (Apache & MySQL)
2. Open phpMyAdmin in your browser
3. Create a new database named `amigolink`
4. Import the database structure (you'll need to create this from the existing code)

### Step 3: Configure Database Connection
Edit `database/connection.php`:
```php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "amigolink";
```

### Step 4: Set Up Email Configuration
For password reset functionality, configure PHPMailer in the relevant files:
- `handle/OTP.php`
- `handle/forgetPassword.html`

### Step 5: Set File Permissions
Ensure the `userImagesVedios/` directory is writable:
```bash
chmod 755 userImagesVedios/
```

### Step 6: Access the Application
Open your browser and navigate to:
```
http://localhost/AmigoLink/
```

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

## 🎯 Usage

### For Users
1. **Register** a new account or **Login** with existing credentials
2. **Complete your profile** by uploading a profile picture and background image
3. **Start posting** text, images, or videos
4. **Follow other users** to see their posts in your feed
5. **Like and comment** on posts you enjoy
6. **Search for users** using the search functionality
7. **Customize your experience** with dark/light mode

### For Administrators
1. Login with admin credentials
2. Access the admin panel at `/admin.php`
3. Manage users, view statistics, and moderate content

## 🔧 Configuration

### Email Settings
To enable password reset functionality, configure your email settings in the OTP-related files.

### File Upload Limits
Adjust PHP settings in `php.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

### Database Optimization
Consider adding indexes to frequently queried columns for better performance.

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Verify database credentials in `database/connection.php`
   - Ensure MySQL service is running

2. **File Upload Issues**
   - Check file permissions on `userImagesVedios/` directory
   - Verify PHP upload settings

3. **Email Not Working**
   - Configure PHPMailer settings properly
   - Check SMTP credentials

4. **Session Issues**
   - Ensure cookies are enabled
   - Check PHP session configuration

## 🔒 Security Features

- **Password Hashing**: All passwords are hashed using PHP's `password_hash()`
- **SQL Injection Prevention**: Prepared statements used throughout
- **XSS Protection**: Input sanitization with `htmlspecialchars()`
- **Session Security**: Proper session management and validation
- **File Upload Security**: Basic file type validation

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Abdul Rahman**
- GitHub: [@yourusername](https://github.com/yourusername)
- Email: your.email@example.com

## 🙏 Acknowledgments

- **Font Awesome** for the beautiful icons
- **Google Fonts** for typography
- **PHPMailer** for email functionality
- **jQuery** for enhanced JavaScript functionality

## 📊 Project Status

- ✅ User Authentication
- ✅ Post Creation & Management
- ✅ Social Features (Follow, Like, Comment)
- ✅ Profile Management
- ✅ Search Functionality
- ✅ Admin Panel
- 🔄 Real-time Notifications (In Progress)
- 🔄 Mobile App (Planned)

## 📞 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/yourusername/AmigoLink/issues) page
2. Create a new issue with detailed information
3. Contact the author directly

---

⭐ **Star this repository if you found it helpful!** 
