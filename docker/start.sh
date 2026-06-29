#!/bin/sh

# Buat folder khusus untuk database sqlite jika belum ada
mkdir -p /var/www/storage/database

# Buat file database jika belum ada
if [ ! -f /var/www/storage/database/database.sqlite ]; then
    touch /var/www/storage/database/database.sqlite
    echo "Created empty SQLite database in /var/www/storage/database/database.sqlite"
fi

# Jalankan migrasi database (berpotensi membuat file log atau memodifikasi DB sebagai root)
echo "Running database migrations..."
php artisan migrate --force --seed

# Pastikan permission folder storage dan database benar untuk SQLite & Laravel SETELAH migrasi
chown -R www-data:www-data /var/www/storage /var/www/database /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/database /var/www/bootstrap/cache

# Link Nginx logs to stdout/stderr for debugging
ln -sf /dev/stdout /var/log/nginx/access.log
ln -sf /dev/stderr /var/log/nginx/error.log

# Gunakan PORT dari Railway (default ke 80 jika tidak diset)
PORT=${PORT:-80}

# Update Nginx port configuration across all possible default files
if [ -f /etc/nginx/sites-available/default ]; then
    sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/sites-available/default
fi
if [ -f /etc/nginx/conf.d/default.conf ]; then
    sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/conf.d/default.conf
fi

# Jalankan PHP-FPM di background menggunakan shell operator
echo "Starting PHP-FPM..."
php-fpm &

# Jalankan Nginx di foreground agar log error Nginx terlihat dan container tetap hidup
echo "Starting Nginx on port ${PORT}..."
exec nginx -g "daemon off;"
