# BlogApp - Laravel 12

A full-featured blog application with **authentication, admin dashboard, posts & comments, AJAX CRUD, caching, and real-time notifications**.

---

## Features

- User authentication & social login (Google & Facebook)  
- Role-based access control (`admin`/`user`)  
- CRUD for posts & comments  
- AJAX-powered edit/view/delete
- Real-time notifications using Laravel Echo + Pusher  
- Tailwind CSS responsive UI with white & gray-700 theme  

---

## Setup

```bash
git clone <repo_url>
cd BlogApp
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
