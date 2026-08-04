# Clothes - Modern E-Commerce Platform

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-3.x-F9A826?style=for-the-badge&logo=filament&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Clothes** is a fully-featured, scalable, and modern E-Commerce platform built with Laravel 11. It provides a robust backend architecture along with a comprehensive administration panel powered by Filament v3.

---

## 🌟 Key Features

### 🛍️ Core E-Commerce
*   **Advanced Catalog Management:** Manage products, categories, subcategories, variants (colors, sizes), and multiple images per product.
*   **Smart Cart & Checkout:** Seamless shopping cart experience with dynamic coupon validation and calculation.
*   **Order Management:** Complete lifecycle management for orders and order items, with integrated shipment tracking.

### 💳 Customer Engagement & Loyalty
*   **Digital Wallet:** Users can top up their digital wallet and use it for purchases seamlessly (`/my-wallet`).
*   **Loyalty Points System:** Reward customers with points for purchases, which can be redeemed for discounts.
*   **Wishlist:** Customers can save their favorite products for later.
*   **Product Reviews:** Allow verified buyers to leave reviews and ratings for products.

### 🔄 Support & Logistics
*   **RMA (Returns Management):** Built-in system for handling customer return requests smoothly.
*   **Support Tickets:** Integrated customer support ticketing system to handle inquiries directly within the platform.
*   **Shipments Tracking:** Track shipping statuses and provide updates to customers.

### 👑 Powerful Administration
*   **Filament V3 Dashboard:** A highly interactive, beautiful, and responsive admin dashboard.
*   **Comprehensive Resources:** Dedicated interfaces to manage Users, Products, Orders, Returns, Tickets, and Wallet Transactions.
*   **Analytics:** Built-in views for store performance and analytics.

---

## 🛠️ Tech Stack & Architecture

*   **Backend:** [Laravel 11.x](https://laravel.com/) (PHP 8.3+)
*   **Admin Panel:** [Filament 3.x](https://filamentphp.com/) (TALL Stack)
*   **Frontend:** Blade Templates, [Tailwind CSS](https://tailwindcss.com/), [Vite](https://vitejs.dev/)
*   **Authentication:** Laravel Breeze
*   **API Documentation:** L5-Swagger (`/api/documentation`)
*   **Architecture Pattern:** Clean Service-Oriented MVC (Heavy lifting is done in dedicated `app/Services`).

---

## 🚀 Getting Started

### Prerequisites
*   PHP 8.5 or higher
*   Composer
*   Node.js & NPM
*   MySQL / PostgreSQL / SQLite

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/Clothes.git
   cd Clothes
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM dependencies:**
   ```bash
   npm install
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Make sure to configure your database settings in the `.env` file.*

5. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Frontend Assets:**
   ```bash
   npm run build
   ```
   *or for development:* `npm run dev`

7. **Start the Development Server:**
   ```bash
   php artisan serve
   ```

---

## 📚 API Structure

The application separates Web routes from API routes natively inside `routes/web.php` for flexible integrations.

*   **Customer APIs:** Prefixed with `/api/...` (e.g., `/api/products`, `/api/cart`, `/api/wallet/balance`).
*   **Admin APIs:** Prefixed with `/admin/api/...` (e.g., `/admin/api/orders`, `/admin/api/inventory/low-stock`).

You can explore the full API documentation using Swagger by visiting `/api/documentation` after starting the server.

---

## 🤝 Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
