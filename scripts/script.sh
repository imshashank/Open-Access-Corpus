#! /bin/bash

x=0
y=0
for i in {0..20}
do
	x=$(( $i * 100000 ))

	y=`expr $x + 100000`
	echo "nohup python new.py "$x" "$y"  >/dev/null 2>&1 &"
	nohup python new.py "$x" "$y"  >/dev/null 2>&1 &
done
