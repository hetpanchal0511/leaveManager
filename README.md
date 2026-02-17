🏢 LeaveManager – HR Leave Management System

LeaveManager is a web-based Employee Leave Management System built using Laravel (PHP Framework).
It helps organizations manage employee leave requests efficiently with an easy-to-use admin panel.

🌐 Live Demo: http://hr.dizintro.com

📌 Project Overview

LeaveManager simplifies HR operations by allowing:

Employees to apply for leave online

Admin to approve or reject leave requests

Automatic leave balance tracking

Centralized leave records management

This system reduces manual paperwork and improves workflow efficiency.

✨ Features
👨‍💼 Employee Panel

Secure Login & Authentication

Apply for Leave (Casual / Sick / Paid)

View Leave History

Check Leave Balance

🛠️ Admin Panel

Dashboard with Leave Statistics

Approve / Reject Leave Requests

Manage Employees

Manage Leave Types

View Reports

🛠️ Technology Stack

Backend: Laravel

Frontend: Blade Template / HTML / CSS / JavaScript

Database: MySQL

Authentication: Laravel Auth

Version Control: Git & GitHub

⚙️ Installation Guide
1️⃣ Clone Repository
git clone https://github.com/hetpanchal0511/leaveManager.git
cd leaveManager

2️⃣ Install Dependencies
composer install
npm install

3️⃣ Environment Setup
cp .env.example .env
php artisan key:generate


Update your .env file with database credentials:

DB_DATABASE=leaveManager
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Run Migration
php artisan migrate

5️⃣ Start Server
php artisan serve


Visit:

http://127.0.0.1:8000

📊 Database Structure

Main Tables:

users

leaves

leave_types

leave_balances

🎯 Project Objective

Automate leave management process

Improve HR efficiency

Reduce manual record keeping

Provide real-time leave tracking
