# 🍞 Bread Bakery Website

A modern and responsive bakery website built with **Laravel 12** and **Livewire**, featuring dynamic product display, a seeded database, and an engaging user experience.

---

## 🚀 Features

- 🥖 Beautiful homepage design  
- 📱 Fully responsive (mobile-friendly)  
- 🛒 Product / menu display with Livewire components  
- 📞 Contact form  
- 💾 Database seeders for sample data  
- 🎨 Clean and modern UI  

---

## 🛠️ Technology Stack

- PHP >= 8.1  
- Laravel 12  
- Livewire  
- MySQL (or any supported database)  
- HTML5, CSS3, JavaScript  
- Node.js & NPM (for assets compilation)  

---

## 💻 Installation

### Prerequisites

- PHP >= 8.1  
- Composer  
- Node.js & NPM  
- MySQL or another supported database  
- Git  

---

### Steps

1. **Clone the repository**
    ```bash
    git clone https://github.com/mohammadhussainshams7/Bread-Bakery.git
    cd Bread-Bakery
2. Install PHP dependencies:
   ```bash
   composer install
3. Install JavaScript dependencies:
   ```bash
        npm install
        npm run dev
4. Copy .env.example to .env and set your database credentials:
   ```bash
        cp .env.example .env
        php artisan key:generate
5. Run migrations:
    ```bash
        php artisan migrate
        php artisan migrate --seed
6. Start the local development server:
   ```bash
        php artisan serve
## Usage

Visit http://localhost:8000 in your browser.

Register a new account or log in.

Manage products, categories, and inventory per room.

Track the validity/expiration of items to ensure safe usage.

