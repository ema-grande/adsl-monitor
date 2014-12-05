#!/bin/bash
# Are you speedy?

# TODO: dependencie speedtest_cli

# Read conf vars
CONF="$(dirname "$0")/conf"
[ ! -e "$CONF" ] && exit	# TODO: log error

. $CONF

# TODO: change this
TMP_FILE="$SCRIPT_ROOT/speedtest.tmp"
SPEED_TEST_PATH="$SCRIPT_ROOT/speedtest-cli/speedtest_cli.py"
# Control if speedtest_cli is reachable
deps=$SPEED_TEST_PATH
for p in $deps; do
	command -v $p > /dev/null || {
		echo "This script need \"$p\""
	exit 1
	}
done


[ ! -e $SPEED_TEST_PATH ] && exit  # TODO: log error
SERVER_ID=$(python $SPEED_TEST_PATH --list | grep -i "telecom italia" | head -n 1 | cut -d")" -f1)
SPEED_TEST_OPT="--simple" #--server $SERVER_ID"

ping $PING_OPT $TARGET1 &> /dev/null
PI=$?

if [ $PI -ne 0 ]; then
	# no connection
	P="NAN"
	DL="NAN"
	UP="NAN"
else
	python $SPEED_TEST_PATH $SPEED_TEST_OPT > $TMP_FILE
	P=$(cat $TMP_FILE | grep Ping | cut -d":" -f2 | cut -d"." -f1 | sed 's/^ //')
	P="$P ms"
	DL=$(cat $TMP_FILE | grep Download | cut -d":" -f2 | sed 's/^ //')
	UP=$(cat $TMP_FILE | grep Upload | cut -d":" -f2 | sed 's/^ //')
	rm $TMP_FILE
fi
mysql -h $DB_HOST -u $DB_USER -e \
	"INSERT INTO $DB_NAME.$SPEED_TABLE VALUES (NULL, \"$P\", \"$DL\", \"$UP\", CURRENT_TIMESTAMP);"
