con ={}
i=0
file_name = "concepts.pytext"
for line in open(file_name):
	record = eval(line)
	for x in record:
		temp=[]
		if isinstance(x, list):
			con[record[0]]=x
	i = i+1
	if i >1000:
		break

for x in con:		
	print con[x]