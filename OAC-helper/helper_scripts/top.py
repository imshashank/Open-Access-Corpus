from __future__ import division
import csv,json
import urllib2,operator

def getD(a_id):
	link = 'http://open-academia.org/rest/get_concepts_by_alternate_id/'
	link=link+a_id
	data= urllib2.urlopen(link)
	return json.load(data)

out_file = open('top_concept.pytext','w')
i = 0
bin = dict()
with open('docs.tsv', 'rb') as csvfile:
    spamreader = csv.reader(csvfile, delimiter='\t', quotechar='|')
    for row in spamreader:
        print row[0]
        bin[str(row[0])] =True

out = []
for k in bin:
	
	top_k ={}
	top_count={}
	with open('docs.tsv', 'rb') as csvfile:
		spamreader = csv.reader(csvfile, delimiter='\t', quotechar='|')
		print k

		for row in spamreader:
			if k == row[0]:
				#find the concepts
				d = getD(row[2])
				print d
				for x in d:
					if top_count.get(x[0])!= None:
						top_count[x[0]] = (top_count.get(x[0])+ 1) 
					else:
						top_count[x[0]]= 1

					if top_k.get(x[0])!= None:
						top_k[x[0]] = (top_k.get(x[0])+ float(x[1])) /2
					else:
						top_k[x[0]]= float(x[1])
					#print x[0]
					#print x[1]
				print str(row[2])
	#find top for give k

	#x = {1: 2, 3: 4, 4:3, 2:1, 0:0}
	sorted_x = sorted(top_count.items(), key=operator.itemgetter(1),reverse=True)
	print "these are the tops by count"
	print sorted_x
	sorted_y = sorted(top_k.items(), key=operator.itemgetter(1),reverse=True)
	print "these are the tops"
	print sorted_y
	#find max
	max_v = 0
	temp = {}
	i =0
	for y in sorted_y:
		max_v = y[1]
		break
	count = 0
	for y in sorted_y:
		if y[1]==max_v or count < 5:
			temp[y[0]]=top_count.get(y[0])
		count =count+1

	sorted_temp= sorted(temp.items(), key=operator.itemgetter(1),reverse=True)
	print sorted_temp
	i = 0
	final= []
	final.append(str(k))
	print k
	for x in sorted_temp:
		final.append(str(x[0])+'-'+str(top_k.get(x[0])))
		print x[0]
		print top_k.get(x[0])
		if i>4:
			break
		i = i+1

	print final
	print >> out_file,final
	out.append(final)
	#break

with open("output.csv", "wb") as f:
    writer = csv.writer(f)
    writer.writerows(final)		
 



