#!/bin/bash
# pingyping

user="adsl"
db="adsl"
table="PING"
target=8.8.8.8
refresh=2

while [[ 1 ]]; do
	p=$(ping -c 1 $target | grep -e "time=[0-9]" | sed 's/.*time=//g')
	pint=$(echo $p | cut -d" " -f1 | cut -d"." -f1)

	[ $pint -lt 700 ] && break
	mysql -u $user -e "INSERT INTO $db.$table VALUES (NULL, CURRENT_TIMESTAMP, \"$p\");"
	# Wait some secs we dont want to flood mysql
	sleep $refresh
done
