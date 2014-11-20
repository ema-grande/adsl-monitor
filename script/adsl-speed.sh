#!/bin/bash
# Are you speedy?

# TODO: dependencie speedtest_cli 

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: error to log

. $CONF

# TODO: change this
TMPFILE=$(dirname $0)"/speedtest.tmp"
ADSLPINGPATH=$(dirname $0)"/adsl-ping.sh"
SPEEDTESTPATH="/media/raid/netserver/src/script/speedtest_cli.py"
SPEEDTESTOPT="--simple"

ping -c 1 -w 2 $TARGET1 > /dev/null 2> /dev/null
PI=$?

if [ $PI -ne 0 ]; then
	# no connection
	P="NAN"
	DL="NAN"
	UP="NAN"
else
#	serverID=$(python $SPEEDTESTPATH --list | grep -i "telecom italia" | head -n 1 | cut -d")" -f1)
#	SPEEDTESTOPT="$SPEEDTESTOPT --server $serverID "

	python $SPEEDTESTPATH $SPEEDTESTOPT > $TMPFILE
	P=$(cat $TMPFILE | grep Ping | cut -d":" -f2 | cut -d"." -f1 | sed 's/^ //')
	P="$P ms"
	DL=$(cat $TMPFILE | grep Download | cut -d":" -f2 | sed 's/^ //')
	UP=$(cat $TMPFILE | grep Upload | cut -d":" -f2 | sed 's/^ //')
	rm $TMPFILE
fi
mysql -h $DBHOST -u $DBUSER -e \
	"INSERT INTO $DBNAME.$SPEEDTABLE VALUES (NULL, \"$P\", \"$DL\", \"$UP\", CURRENT_TIMESTAMP);"

# If speedtest return high ping record some other ping until < 700
PNUM=$(echo "$P" | cut -d" " -f1)
[ $PNUM -gt 700 ] && $ADSLPINGPATH &
