#!/bin/bash
# Init db and table

deps="mysql"
for p in $deps; do
	command -v $p > /dev/null || {
		echo "This script need \"$p\""
	exit 1
	}
done

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: log error

. $CONF

queryCreateDB="CREATE DATABASE IF NOT EXISTS $DB_NAME;"
queryDropTalbe="CREATE TABLE IF NOT EXISTS $DB_NAME.$DROP_TABLE (
	ID int(11) NOT NULL PRIMARY KEY,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	durata int(10) unsigned NOT NULL
	);"
queryPingTable="CREATE TABLE IF NOT EXISTS $DB_NAME.$PING_TABLE (
	ID int(11) NOT NULL PRIMARY KEY,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	ping text NOT NULL
	);"
querySpeedTable="CREATE TABLE IF NOT EXISTS $DB_NAME.$SPEED_TABLE (
	ID int(11) NOT NULLPRIMARY KEY ,
	ping text NOT NULL,
	dl text NOT NULL,
	up text NOT NULL,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	);"


mysql -h $DB_HOST -u $DB_USER -e "$queryCreateDB"
mysql -h $DB_HOST -u $DB_USER -e "$queryDropTalbe"
mysql -h $DB_HOST -u $DB_USER -e "$queryPingTable"
mysql -h $DB_HOST -u $DB_USER -e "$querySpeedTable"
