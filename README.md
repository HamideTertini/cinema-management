# Blood Donation API

A robust and efficient **RESTful API** developed with **Laravel** for managing **blood donations**. The API supports **JWT authentication**, utilizes seeders for initial data, and establishes seamless relationships across multiple tables via a centralized **DB Seeder**.

---

##  **Features**

- **User Authentication**: Secure user registration and login using **JWT** (JSON Web Tokens).
- **Blood Donation Management**: CRUD operations for tracking and managing blood donations.
- **Donors & Recipients**: Manage both **donors** and **recipients** for each donation event.
- **Database Integration**: Seamless interaction with **MySQL** (or other supported databases).
- **Centralized Seeder**: Efficient data population through a **centralized seeder**.
- **RESTful API Design**: Fully **RESTful** endpoints for easy integration with any frontend or mobile platform.
- **Comprehensive Documentation**: Clear setup instructions and API endpoint details.

---

##  **System Requirements**

Before starting, ensure the following are installed:

- **PHP** >= 8.0
- **Composer** (PHP dependency manager)
- **MySQL** (or any Laravel-supported database)
- **Node.js & npm** (optional, for frontend tasks)
- **Postman** (optional, for API testing)

---

##  **Installation & Setup**

### 1️⃣ **Clone the Repository**

```bash
git clone <repo-url>
cd backend-api
```

### 2️⃣ **Install Dependencies**

```bash
composer install
```

### 3️⃣ **Configure Environment Variables**

Copy the `.env.example` file and configure the database credentials:

```bash
cp .env.example .env
```

Edit the `.env` file:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blood_donation
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4️⃣ **Generate JWT Secret Key**

```bash
php artisan jwt:secret
```

### 5️⃣ **Migrate Database & Seed Data**

```bash
php artisan migrate --seed
```

### 6️⃣ **Create Storage Link (Optional)**

```bash
php artisan storage:link
```

### 7️⃣ **Clear Cache & Start the Server**

```bash
php artisan config:clear
php artisan cache:clear
php artisan serve
```

The API will be accessible at: `http://127.0.0.1:8000`.

---

## 📊 **API Endpoints**

| Method  | Endpoint               | Description                          |
|---------|------------------------|--------------------------------------|
| **POST** | `/api/register`       | Register a new user                 |
| **POST** | `/api/login`          | Authenticate and retrieve a JWT token |
| **GET**  | `/api/donors`         | List all blood donors               |
| **GET**  | `/api/recipients`     | List all blood recipients           |
| **POST** | `/api/donations`      | Create a new blood donation entry   |
| **GET**  | `/api/donations/{id}` | View a specific blood donation entry |

---

##  **Best Practices**

- **Environment Configuration**: Always update the `.env` file with accurate credentials, especially before deployment.
- **Database Migrations**: Use `php artisan migrate:refresh --seed` during development to reset and repopulate the database.
- **JWT Security**: Ensure the JWT secret key is generated and properly set before using authentication endpoints.

---

##  **Testing**

- Use **Postman** or **cURL** to test all API routes efficiently.
- Utilize Laravel's built-in **PHPUnit** for unit testing to ensure backend stability.

---

##  **Support**

For issues, feature requests, or questions, please open an issue in the repository.

**Thank you for using the Blood Donation API! Happy coding! 🚀**

