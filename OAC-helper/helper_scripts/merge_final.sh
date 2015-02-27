#!/bin/bash

STR="Hello World!"
echo $STR
END="_out.pytext"
for i in {1..206}
do
   F="../new_parsed/$i$END"
   echo $F
   cat $F >> corpus.pytext
done
