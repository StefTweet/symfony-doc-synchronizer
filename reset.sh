#!/bin/bash
set -e

rm -rf app/cache/*

php app/console doctrine:database:drop --force || true
php app/console doctrine:database:create
php app/console doctrine:schema:create
