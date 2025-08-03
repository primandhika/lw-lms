# Setup Project LW-LMS Setelah Clone

## 1. Install Dependencies
```bash
composer install
```

## 2. Setup Environment
```bash
# Copy file environment
cp .env .env.local

# Edit konfigurasi database di .env
database.default.hostname = localhost
database.default.database = lw_lms
database.default.username = root
database.default.password = 
database.default.port = 3306
```

## 3. Setup Database

### Opsi A: Menggunakan Docker MySQL
```bash
# Jalankan MySQL container
docker run -d --name mysql-lms -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root mysql:8.0

# Import database
mysql -h 127.0.0.1 -P 3306 -u root -p < export_database.sql
```

### Opsi B: Menggunakan MySQL Lokal/XAMPP
```bash
# Buat database
mysql -u root -p -e "CREATE DATABASE lw_lms;"

# Import struktur
mysql -u root -p lw_lms < export_database.sql
```

## 4. Generate Encryption Key
```bash
php spark key:generate
```

## 5. Jalankan Migrasi & Seeder
```bash
# Jalankan migrasi
php spark migrate

# Jalankan seeder (data awal)
php spark db:seed DatabaseSeeder
```

## 6. Set Permissions (Linux/Mac)
```bash
chmod -R 755 writable/
```

## 7. Jalankan Development Server
```bash
php spark serve
```

Akses: http://localhost:8080

## Login Default
- **Admin**: admin@example.com / password123
- **Teacher**: teacher@example.com / password123

## Troubleshooting

### Database Connection Error
- Pastikan MySQL berjalan
- Periksa konfigurasi di .env
- Pastikan database `lw_lms` sudah dibuat

### Permission Error
```bash
# Windows
icacls writable /grant Users:F /T

# Linux/Mac  
sudo chmod -R 777 writable/
```

### Missing Composer
Download dari: https://getcomposer.org/

### Missing PHP
Minimum PHP 8.1 required