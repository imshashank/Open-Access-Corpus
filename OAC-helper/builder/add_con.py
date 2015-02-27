import time
#import pytz
import datetime


con ={}
i=0
print "loading concepts"
file_name = "concepts.pytext"

for line in open(file_name):
	print i
	record = eval(line)
	for x in record:
		temp=[]
		if isinstance(x, list):
			con[record[0]]=x
	i = i+1
	#if i > 100000:
#		break
print "concepts loaded"


def check(x,file_name,out_file,error_file):
	n=0
	f = open(out_file, 'a+')
	for line in open(file_name):

		error=True
		anything_changed = True
		record = eval(line)
	
		print "parsing record " + str(n)
		try:
			record['concepts'] = con[record['id']]
		except:
			record['concepts']=''
		
		
		if anything_changed:
			timezone = " EST"
			date =  (time.strftime("%d-%m-%Y"))
			date = ''.join((date, timezone))
			record['last_updated'] = date
			record['version'] = '0.2'
		
		print "writing to file"
		print >>f,  record
		f.flush()
		print "written to file"
	
		n= n+1

		#if n >10:
		#	break




check(0,'corpus.pytext','out.pytext','err.pytext')

'''
for n in range(0,1):
	print "thread " + str(n)
	tem = "./" + str(n) + '.pytext'
	# print tem
	out = './parsed/' +str(n) + '_out.pytext'
	err = './errors/' + str(n) + '_errors.pytext'
	#err = ''.join('errors/',str(n), '_errors.pytext')

	x = file_len(out)
	print x
	if x < 111110000:
		t = threading.Thread(target=check, args = (x,tem,out,err))
		t.daemon = True
		t.start()
		threads.append(t)
	else:
		print "file parsed, skipping"

print "Waiting..."

for t in threads:
    t.join()
'''
print "complete"

 