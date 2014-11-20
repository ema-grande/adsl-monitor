#!/bin/bash
# Are you speedy?

# TODO: dependencie speedtest_cli 

user="adsl"
db="adsl"
table="SPEED"
target=8.8.8.8

tmpFile=$(dirname $0)"/speedtest.tmp"
adslpingPath=$(dirname $0)"/adsl-ping.sh"
speedtestPath="/media/raid/netserver/src/script/speedtest_cli.py"
speedtestOpt="--simple"

ping -c 1 -w 2 $target > /dev/null 2> /dev/null
pi=$?

if [ $pi -ne 0 ]; then
	# no connection
	p="NAN"
	dl="NAN"
	up="NAN"
else
#	serverID=$(python $speedtestPath --list | grep -i "telecom italia" | head -n 1 | cut -d")" -f1)
#	speedtestOpt="$speedtestOpt --server $serverID "

	python $speedtestPath $speedtestOpt > $tmpFile
	p=$(cat $tmpFile | grep Ping | cut -d":" -f2 | cut -d"." -f1 | sed 's/^ //')
	p="$p ms"
	dl=$(cat $tmpFile | grep Download | cut -d":" -f2 | sed 's/^ //')
	up=$(cat $tmpFile | grep Upload | cut -d":" -f2 | sed 's/^ //')
	rm $tmpFile
fi
mysql -u $user -e "INSERT INTO $db.$table VALUES (NULL, \"$p\", \"$dl\", \"$up\", CURRENT_TIMESTAMP);"

# If speedtest return high ping record some other ping until < 700
pnum=$(echo "$p" | cut -d" " -f1)
[ $pnum -gt 700 ] && $adslpingPath &
