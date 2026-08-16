Private Shared Photo Album & Memory Vault

A private digital photo gallery solution that enables users (couples, families, or close-knit teams) to share an account and collaboratively manage shared photo albums in a private and secure manner.


1. Project Background & Objectives

In today's digital era, sharing cherished photos with loved ones (partners, family, or close friends) often presents several challenges:
- Limited/Paid Public Cloud Storage: Cloud services like Google Photos or iCloud often require monthly subscription fees once storage limits are reached.
- Privacy Concerns: Uploading to public social media platforms like Instagram may not feel comfortable for moments that are deeply personal and private.
- Need for Simple Collaboration: A desire for a unified gallery space where both parties can add albums and upload their own photos simply by sharing account access (Email & Password).

This project was created to address these needs. With this application, users can create a single shared account. Anyone possessing the account credentials (Email & Password)—regardless of the device used—can access the same private gallery, create new photo albums, and preserve important moments together without third-party interference.


2. Key Features

- Shared Private Authentication: A secure login system based on a shared account. Trusted individuals can access the platform using a single set of Email & Password credentials. - **Dynamic Album Management**: Easily create, rename, and delete photo albums based on categories (e.g., "Bali Vacation," "Graduation 2026," "Group Project").
- **Photo Collection & Storyteller**: Upload photos with support for titles, capture dates, and descriptions of the stories behind the images.
- **Live Instant Search**: Instantly search for your favorite photos without needing to refresh the web page.
- **Warm Studio Aesthetic UI**: A modern, calming, and eye-friendly interface design (Warm Cream & Amber Theme), crafted to let photo colors stand out.
- **Zero-Config File Database**: Uses SQLite to ensure data is permanently stored in a local file, eliminating the need for complex database server setups.


3. Technologies Used

This application is built using a modern, lightweight, and fast architecture:

- **Framework**: [Laravel 11](https://laravel.com/) (PHP MVC Architecture)
- **Frontend & Styles**: HTML5, Vanilla CSS (Custom Design System with Variables), Vite
- **Database**: [SQLite](https://www.sqlite.org/) (File-based Local Database)
- **Security**: Laravel Authentication, Session Management, CSRF Protection, Mass Assignment Protection (`$fillable`).


4. How to Run the Project Locally

1. System Prerequisites
Ensure the following are installed on your computer:
- PHP (v8.2 or newer) & Composer
- Node.js & npm

2. Initial Setup Steps
```bash
# 1. Clone this repository
git clone https://github.com/username/list-album.git
cd list-album

# 2. Copy the environment file
cp .env.example .env

# 3. Install PHP & Node dependencies
composer install
npm install

# 4. Generate Application Key
php artisan key:generate

# 5. Prepare SQLite Database & Run Migrations
touch database/database.sqlite
php artisan migrate
```

3. Running the Application Server
Run these 2 commands in separate terminal tabs:
Terminal 1 (Backend Server): ```bash
php artisan serve
```
Terminal 2 (Frontend Assets Compiler):
```bash
npm run dev
```

Open your browser and visit: `http://127.0.0.1:8000`

How to Share Access

1. Open `http://127.0.0.1:8000/register` in your browser to create an initial account.
2. Share the account's email and password with your partner, friend, or family member.
3. They can log in from their own devices using the same account.
4. You can now **create albums, upload photos, and view your shared gallery of memories privately!**
