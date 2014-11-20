#!/bin/bash
# droppydrop


user="adsl"
db="adsl"
table="DISCONNECT"
target1=8.8.8.8
target2=208.67.222.222
refresh=2
connflag=1		# 1 connect -1 not connect

while [ 1 ]
do
	ping -c 1 -w 3 $target1 > /dev/null 2> /dev/null
	ping1=$?
	ping -c 1 -w 3 $target2 > /dev/null 2> /dev/null
	ping2=$?
	
	if [ $ping1 -eq 0 -a $ping2 -eq 0 -a $connflag -ne 1 ]
	then
		# ADSL up
		connflag=1

		# Record data
		sec=$(( SECONDS - startCount ))
		durata=$sec
		mysql -u $user -e "INSERT INTO $db.$table VALUES (NULL, \"$dataDisc\", \"$durata\");"
	fi

	if [ $ping1 -ne 0 -a $ping2 -ne 0 -a $connflag -ne -1 ]
	then
		# ADSL down
		startCount=$SECONDS
		dataDisc=$(date +%F-%T)
		connflag=-1
	fi

	# Check every $refresh sec
	sleep $refresh
done
