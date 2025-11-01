# Valorent - Sewa Akun Valorant

## Nama Kelompok
- Muhamad Rega Pramudya
- Kresna Mukti Wibowo

## Nama Team
Nol Dua

## Nama Project
Valorent - Platform Sewa Akun Valorant

## List Fitur

### User Side (Rega)
- Register & Login
- Profile Management
- Browse Catalog (Search & Filter)
- Rent Unit (max 2 unit, max 5 hari)
- View My Rentals
- View Rental Details

### Admin Side (Kresna)
- CRUD Unit
- CRUD Category
- CRUD User/Anggota
- View All Rentals
- Process Return Unit
- Print Rental History

## Demo Video
https://drive.google.com/file/d/1zeMQ7PiQwPzASezPRHzCJUvw4SMD3KqQ/view?usp=sharing

## Tech Stack
- Laravel 11
- Nwidart/Laravel-Modules
- Clean Architecture
- Bootstrap 5
- MySQL

## Installation

1. Clone repository
```bash
git clone https://github.com/mregaa/valorent
cd valorent
```

2. Install Dependencies
```bash
composer install
npm install
```

3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in .env

5. Run migration & seeder
```bash
php artisan migrate --seed
```

## Default Credentials
### Admin:
Email: admin@valorent.com
Password: admin123
### User:
Email: user@valorent.com
Password: user123

## Pembagian Tugas
### Developer 1: Muhamad Rega Pramudya
Setup Project & Clean Architecture
Authentication Module
Catalog Module (User Side)
Rental Module (User Side)

### Developer 2: Kresna Mukti Wibowo
Core Module (Category & Profile Repository)
Admin Module (CRUD)
Admin Dashboard
Return Process & Reports