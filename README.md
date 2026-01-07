# SimBlog – Laravel 12 Blog Application

SimBlog is a Laravel 12–based blog application with authentication, roles, permissions, and social login support (Google & Facebook).  
This repository contains the complete source code, ready to be installed and run locally.

---

## 📋 Requirements

Ensure your system meets the following requirements:

- PHP **8.3+**
- Composer
- MySQL **8+**
- Node.js & npm (optional, if frontend assets are used)
- Laravel CLI (optional)

---

## 🚀 Installation & Setup

Follow the steps below to run the project locally.

---

### 1️⃣ Clone the Repository


git clone https://github.com/sidmahata/simblog.git
cd simblog

---

2️⃣ Install Dependencies

composer install

3️⃣ Environment Configuration

cp .env.example .env

Update the .env file with the following configuration:

Database Configuration:

DB_CONNECTION=mysql<br> 
DB_HOST=127.0.0.1<br>
DB_PORT=3307<br>
DB_DATABASE=simblog<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>


Google OAuth Configuration:

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback


Facebook OAuth Configuration:

FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT_URI=http://127.0.0.1:8000/auth/facebook/callback


4️⃣ Generate Application Key
php artisan key:generate


5️⃣ Run Database Migrations & Seeders
php artisan migrate:fresh
php artisan db:seed

6️⃣ Create Admin User
php artisan app:create-admin

You will be prompted to enter:
Name
Email
Password

7️⃣ Start the Development Server
php artisan serve

Access the application at:
http://127.0.0.1:8000


🧪 Running Tests (Optional)
php artisan test


🛠 Troubleshooting

Database Connection Issues:
Ensure MySQL is running
Verify the database port (3307)
Check database credentials in .env

Social Login Not Working:
Verify OAuth credentials
Ensure redirect URIs match those configured in Google/Facebook developer consoles


