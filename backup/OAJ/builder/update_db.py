import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata
import threading
from datetime import datetime


def read(skip,end,file_name):

	db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com",
                 user="corpus", 
                      passwd="OCLC_123", 
                      db="corpus")

	cur = db.cursor() 
	n=0
	x=0

	for line in open(file_name):
		record = eval(line)
		if record['last_updated'] != None :
			q = "SELECT * from corpus.`articles` where alternate_id = '%s'" %record['id'];
			print q
			cur.execute(q)
			data = {}
			for row in cur.fetchall():
				article_id= row[1]
				data['article_id'] = article_id

				alternate_id= row[1]
				data['alternate_id'] = alternate_id

				title= row[2]
				data['title'] = title

				abstract= row[3]
				data['abstract'] = abstract

				doi= row[5]
				data['doi'] = doi
			#array = urllib2.urlopen('http://54.204.34.166/OAJ/web_end/rest/get_article_by_alternate_id/%s' % record['id']).read()
			#print array
			#data  = json.loads(array)[0]

			if data != None:
				alternate_id = record['id']
				title = record['title'].encode('utf-8')
				abstract = record['abstract']
				if abstract != None:
					abstract = record['abstract'].encode('utf-8')
				doi = record['doi'] 
				title_changed = False
				abstract_changed = False
				doi_changed = False
				query = ''
				multiple = False
				if record['title'] != data['title']:
					print "diff title"
					title_changed = True
					query= query + " title='{0}' ".format(title)
					print query
					multiple = True

				if record['abstract'] != data['abstract'] and record['abstract'] != None:
					#print data['abstract']
					#print "diff abstract"
					#print record['abstract'].encode('utf-8')
					abstract_changed = True
					abstract = MySQLdb.escape_string(record['abstract'].encode('utf-8'))

					if multiple:
						query= query + ", abstract='{0}' ".format(abstract)
					else:
						query= query + " abstract='{0}' ".format(abstract)
					print query

				if record['doi'] != data['doi'] and record['doi'] != None :
					print "diff doi"
					doi_changed = True
					if multiple:
						query= query + " ,doi='{0}' ".format(doi)
					else:
						query= query + " doi='{0}' ".format(doi)
					print query
				
				if title_changed or abstract_changed or doi_changed:
					print "query is "
					q = "UPDATE corpus.`articles` SET " + query +  "WHERE alternate_id='{0}';".format(alternate_id)
					print q
					cur.execute(q)
					db.commit()
			else:
				print record['id']

				#break

			#q = "UPDATE corpus.`articles` SET title='{0}', abstract={1}, doi={2} WHERE alternate_id='{3}';".format(title,abstract,doi,alternate_id)
			#print q
	cur.close()

			

read(0,0,'./data/78_out.pytext')
'''

threads = []

for n in range(1,5):
	print "thread " + str(n)
	tem = "/mnt/corpus/" + str(n) + '.pytext'
	t = threading.Thread(target=read, args = (0,0,tem))
	t.daemon = True
	t.start()
	threads.append(t)

print "Waiting..."

for t in threads:
    t.join()

print "complete"
'''
