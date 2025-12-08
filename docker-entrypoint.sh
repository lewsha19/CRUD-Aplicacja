#!/bin/sh
set -e

if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader > /dev/null 2>&1
fi

mkdir -p app/log
chmod -R 777 app/log

if [ ! -f "app/config/config.php" ]; then
    if [ -f "app/config/config_sample.php" ]; then
        cp app/config/config_sample.php app/config/config.php
        chmod 666 app/config/config.php
    fi
fi

if [ ! -f "app/database.sqlite" ]; then
    if [ -f "vendor/bin/runway" ]; then
        php vendor/bin/runway db:migrate > /dev/null 2>&1
    else
        touch app/database.sqlite
        chmod 666 app/database.sqlite
        if [ -d "migrations" ]; then
            for sql_file in migrations/*.sql; do
                if [ -f "$sql_file" ]; then
                    sqlite3 app/database.sqlite < "$sql_file" > /dev/null 2>&1
                fi
            done
        fi
    fi
fi

exec "$@"

