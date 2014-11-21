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

queryCreateDB="CREATE DATABASE IF NOT EXISTS $DBNAME;"
queryDropTalbe="CREATE TABLE IF NOT EXISTS $DBNAME.$DROPTABLE (
	ID int(11) NOT NULL PRIMARY KEY,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	durata int(10) unsigned NOT NULL
	);"
queryPingTable="CREATE TABLE IF NOT EXISTS $DBNAME.$PINGTABLE (
	ID int(11) NOT NULL PRIMARY KEY,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	ping text NOT NULL
	);"
querySpeedTable="CREATE TABLE IF NOT EXISTS $DBNAME.$SPEEDTABLE (
	ID int(11) NOT NULLPRIMARY KEY ,
	ping text NOT NULL,
	dl text NOT NULL,
	up text NOT NULL,
	time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
	);"


mysql -h $DBHOST -u $DBUSER -e "$queryCreateDB"
mysql -h $DBHOST -u $DBUSER -e "$queryDropTalbe"
mysql -h $DBHOST -u $DBUSER -e "$queryPingTable"
mysql -h $DBHOST -u $DBUSER -e "$querySpeedTable"
