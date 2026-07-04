CREATE DATABASE bookstore_crm
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE bookstore_crm;

CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL,

    password_hash VARCHAR(255) NOT NULL,

    role ENUM('admin','staff') DEFAULT 'staff',

    status TINYINT DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_users_email(email),

    INDEX idx_users_role(role)
);

CREATE TABLE customers (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL,

    phone VARCHAR(20),

    address VARCHAR(255),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_customers_email(email),

    INDEX idx_customers_created(created_at),

    INDEX idx_customers_phone(phone)
);

CREATE TABLE book_orders (

    id INT AUTO_INCREMENT PRIMARY KEY,

    order_code VARCHAR(50) NOT NULL,

    customer_id INT NOT NULL,

    book_title VARCHAR(255) NOT NULL,

    quantity INT NOT NULL,

    unit_price DECIMAL(12,2) NOT NULL,

    total_amount DECIMAL(12,2) NOT NULL,

    status ENUM(
        'pending',
        'paid',
        'shipping',
        'completed',
        'cancelled'
    ) DEFAULT 'pending',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    UNIQUE KEY uk_order_code(order_code),

    INDEX idx_customer(customer_id),

    INDEX idx_status(status),

    INDEX idx_created(created_at),

    CONSTRAINT fk_orders_customer
        FOREIGN KEY(customer_id)
        REFERENCES customers(id)
        ON DELETE CASCADE
);

