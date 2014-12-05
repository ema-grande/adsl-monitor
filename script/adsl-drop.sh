#!/bin/bash
# droppydrop

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: error to log

. $CONF

CONN_FLAG=1		# 1 connect -1 not connect

while [ 1 ]
do
	# Every half an hour make speed test
	MINUTES=$(date +%M)
	if [ $MINUTES -eq 00 -o $MINUTES -eq 30 ]; then
		./$SCRIPT_ROOT/adsl-speed.sh
		sleep 60		#prevent multi speed test in 1 min
	fi
	# change in "sleep until speed test is done" find a way :o

	P=$(ping $PING_OPT $TARGET1 | grep -e "time=[0-9]" | sed 's/.*time=//g') # &> /dev/null
	PING1=$?
	ping $PING_OPT $TARGET2 &> /dev/null
	PING2=$?
	
	if [ $PING1 -eq 0 ]; then
		# Record ping if higher then some top latency
		P_INT=$(echo $P | cut -d" " -f1 | cut -d"." -f1)
		# FIXME: some error may occur if ping fail "integer expression expected"
		# this should be fixed
		[[ $P_INT -gt $PING_TOP ]] && mysql -h $DB_HOST -u $DB_USER -e \
			"INSERT INTO $DB_NAME.$PING_TABLE VALUES (NULL, CURRENT_TIMESTAMP, \"$P\");" 
	fi
	
	if [ $PING1 -eq 0 -a $PING2 -eq 0 -a $CONN_FLAG -ne 1 ]
	then
		# ADSL up
		CONN_FLAG=1
		# Record data
		SEC=$(( SECONDS - STARTCOUNT ))
		SPAN=$SEC
		mysql -h $DB_HOST -u $DB_USER -e \
			"INSERT INTO $DB_NAME.$DROP_TABLE VALUES (NULL, \"$DATADROP\", \"$SPAN\");"
	fi

	if [ $PING1 -ne 0 -a $PING2 -ne 0 -a $CONN_FLAG -ne -1 ]
	then
		# ADSL down
		STARTCOUNT=$SECONDS		# use bash $SECONDS to count disconnection time
		DATADROP=$(date +%F-%T)
		CONN_FLAG=-1
	fi

	# Check every $CONF->$REFRESH sec
	sleep $REFRESH
done
