# Social Platform (Laravel)

A basic social networking platform built with Laravel.

Features:
- User profiles (name, email, image, phone, status)
- Posts (text + optional image)
- Comments + single reply from post owner
- Likes
- Connections (friend requests system)
- REST API (Sanctum token authentication)
- Frontend theme integrated (news-master)
- Separate frontend routes (front.php)

------------------------------------------------------------
SYSTEM REQUIREMENTS
------------------------------------------------------------

- PHP 8.1+
- Composer
- MySQL / MariaDB
- Node.js + NPM (optional if using auth scaffolding)

------------------------------------------------------------
INSTALLATION
------------------------------------------------------------

1) Clone project

git clone <YOUR_REPO_URL>
cd <PROJECT_FOLDER>

2) Install dependencies

composer install

3) Copy env file

cp .env.example .env

4) Generate app key

php artisan key:generate



------------------------------------------------------------
DATABASE CONFIGURATION
------------------------------------------------------------

Open .env and update:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=social
DB_USERNAME=root
DB_PASSWORD=

------------------------------------------------------------
MIGRATION & SEEDING
------------------------------------------------------------

php artisan migrate
php artisan db:seed

------------------------------------------------------------
STORAGE LINK (IMPORTANT FOR IMAGES)
------------------------------------------------------------

php artisan storage:link

------------------------------------------------------------
RUN PROJECT
------------------------------------------------------------

php artisan serve

Default URL:
http://127.0.0.1:8000

------------------------------------------------------------
WEB AUTHENTICATION (SESSION BASED)
------------------------------------------------------------

The frontend uses default Laravel web authentication.

If authentication scaffolding is NOT installed, install Laravel Breeze:

composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run build
php artisan migrate

After that you will have:

GET  /login
POST /login
POST /logout
GET  /register
POST /register

------------------------------------------------------------
FRONTEND ROUTES (Navbar Pages)
------------------------------------------------------------

Frontend routes are registered in:

routes/front.php

NOT in web.php.

Navbar pages:

/              -> Home feed
/friends       -> Accepted friends
/connections   -> Pending sent & received requests
/posts         -> My posts
/pages         -> Static placeholder page
/contact       -> Contact page

If front.php is not loaded, make sure RouteServiceProvider loads it.

------------------------------------------------------------
API AUTHENTICATION (SANCTUM)
------------------------------------------------------------

Sanctum is used for API authentication.

Install if needed:

composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

API requests require header:

Authorization: Bearer <TOKEN>


------------------------------------------------------------
postman collection
------------------------------------------------------------

inside the root file of the project with name social_postman_collection
------------------------------------------------------------
API STRUCTURE
------------------------------------------------------------

Base URL:
{{base_url}}/api

1) Authentication (User V1)
POST /api/user-login
POST /api/user-regist
POST /api/user-checkOtp

2) Authentication (Alternative)
POST /api/login
POST /api/regist
POST /api/otp-check

3) User Management (auth:sanctum)
GET    /api/user
GET    /api/user-getDate
POST   /api/user-update/{id}
DELETE /api/user-destroy/{id}
POST   /api/user-logout

4) Admin Management (auth:sanctum)
GET    /api/admin-getDate
POST   /api/admin-create
POST   /api/admin-update/{id}
DELETE /api/admin-destroy/{id}

5) Posts (auth:sanctum)
GET    /api/posts
GET    /api/posts/{id}
POST   /api/posts
POST   /api/posts/{id}
DELETE /api/posts/{id}

6) Comments (auth:sanctum)
GET    /api/comments
GET    /api/comments/{id}
POST   /api/comments
PUT    /api/comments/{id}
DELETE /api/comments/{id}

7) Connections (auth:sanctum)
GET    /api/connections
POST   /api/connections
DELETE /api/connections/{id}

------------------------------------------------------------
POSTMAN
------------------------------------------------------------

Import the provided Postman collection file.

Set variables:
base_url = http://127.0.0.1:8000
token = <token from login>

------------------------------------------------------------
IMAGE STORAGE
------------------------------------------------------------

User images:
storage/<path>

Post images:
storage/<path>

Make sure:
php artisan storage:link

------------------------------------------------------------
COMMON ISSUES
------------------------------------------------------------

401 Unauthorized:
- Check Bearer token
- Ensure route is inside auth:sanctum middleware

Images not loading:
- Run php artisan storage:link
- Check APP_URL in .env

Routes not updating:
php artisan route:clear
php artisan cache:clear

------------------------------------------------------------
GIT WORKFLOW
------------------------------------------------------------

git add .
git commit -m "feat: add posts and connections"
git push

------------------------------------------------------------
PROJECT TYPE
------------------------------------------------------------

Educational / Social platform demo using Laravel.
