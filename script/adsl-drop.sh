#!/bin/bash
# droppydrop

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: error to log

. $CONF

CONNFLAG=1		# 1 connect -1 not connect

while [ 1 ]
do
	P=$(ping $PINGOPT $TARGET1 | grep -e "time=[0-9]" | sed 's/.*time=//g') # > /dev/null 2> /dev/null
	PING1=$?
	ping $PINGOPT $TARGET2 > /dev/null 2> /dev/null
	PING2=$?
	
	# Record ping if higher then x
	PINT=$(echo $P | cut -d" " -f1 | cut -d"." -f1)
	[ $PINT -gt $PINGTOP ] && mysql -h $DBHOST -u $DBUSER -e \
		"INSERT INTO $DBNAME.$PINGTABLE VALUES (NULL, CURRENT_TIMESTAMP, \"$P\");"
	
	if [ $PING1 -eq 0 -a $PING2 -eq 0 -a $CONNFLAG -ne 1 ]
	then
		# ADSL up
		CONNFLAG=1


		# Record data
		SEC=$(( SECONDS - STARTCOUNT ))
		DURATA=$SEC
		mysql -h $DBHOST -u $DBUSER -e \
			"INSERT INTO $DBNAME.$DROPTABLE VALUES (NULL, \"$DATADROP\", \"$DURATA\");"
	fi

	if [ $PING1 -ne 0 -a $PING2 -ne 0 -a $CONNFLAG -ne -1 ]
	then
		# ADSL down
		STARTCOUNT=$SECONDS
		DATADROP=$(date +%F-%T)
		CONNFLAG=-1
	fi

	# Check every $CONF->$REFRESH sec
	sleep $REFRESH
done
