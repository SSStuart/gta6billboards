#!/bin/bash

echo "Deploying..."
cd /home/crtpxwuz/gta6billboards/ || exit

php artisan down --render="errors::503" --refresh=30
echo "[MAINTENANCE MODE ON]"
echo ""

echo "====== 1. Git pull ======"
git pull

if [ $# -eq 1 ]; then
	echo "(! Ignoring composer updates for this execution)"
else
	echo "====== 2. Install/Update packages ======"
	composer.phar dump-autoload --optimize
fi

echo "====== 3. Database migrations ======"
php artisan migrate --force

echo "====== 4. Optimization ======"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo ""
php artisan up
echo "[MAINTENANCE MODE OFF]"

echo ""
echo "Deployment finished"