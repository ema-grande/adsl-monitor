#!/bin/bash
# pingyping

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: error to log

. $CONF

while [[ 1 ]]; do
	P=$(ping -c 1 $TARGET1 | grep -e "time=[0-9]" | sed 's/.*time=//g')
	PINT=$(echo $P | cut -d" " -f1 | cut -d"." -f1)
	PINT=850
	[ $PINT -lt 700 ] && break
	mysql -h $DBHOST -u $DBUSER -e \
		"INSERT INTO $DBNAME.$PINGTABLE VALUES (NULL, CURRENT_TIMESTAMP, \"$P\");"
	# Wait some secs we dont want to flood mysql
	sleep $REFRESH
done
