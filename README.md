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


git clone https://github.com/sidmahata/simblog.git<br>
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

GOOGLE_CLIENT_ID=your_google_client_id<br>
GOOGLE_CLIENT_SECRET=your_google_client_secret<br>
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback<br>


Facebook OAuth Configuration:

FACEBOOK_CLIENT_ID=your_facebook_client_id<br>
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret<br>
FACEBOOK_REDIRECT_URI=http://127.0.0.1:8000/auth/facebook/callback<br>


4️⃣ Generate Application Key:<br>
php artisan key:generate


5️⃣ Run Database Migrations & Seeders:<br>
php artisan migrate:fresh<br>
php artisan db:seed<br>

6️⃣ Create Admin User:<br>
php artisan app:create-admin<br>

You will be prompted to enter:<br>
Name<br>
Email<br>
Password<br>

7️⃣ Start the Development Server:<br>
php artisan serve<br>

Access the application at:<br>
http://127.0.0.1:8000<br>


🧪 Running Tests (Optional):<br>
php artisan test<br>


🛠 Troubleshooting

Database Connection Issues:<br>
Ensure MySQL is running<br>
Verify the database port (3307)<br>
Check database credentials in .env<br>

Social Login Not Working:<br>
Verify OAuth credentials<br>
Ensure redirect URIs match those configured in Google/Facebook developer consoles<br>


