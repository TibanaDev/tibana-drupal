#! /usr/bin/env sh

set -e

MYSQL_DATABASE=drupal8 /helpers/sql-import.sh --host=database --port=3306 /dump.sql.gz
