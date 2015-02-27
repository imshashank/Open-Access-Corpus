a=1
for i in x*; do
  new=$(printf "%d.pytext" ${a})
 # echo $a
 # echo $new
  mv ${i} ${new}
  a=`expr $a + 1`
done
