import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata

db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com",
                 user="corpus", 
                      passwd="OCLC_123", 
                      db="corpus")


def exists(site):
	try:
		r = urllib2.urlopen(site)
	except Exception,e :
		print e
		r = e
		print r.code
	try:
		if r.code in (200, 401, 403,104):
			return 200
		elif r.code == 404:
			return 404
	except:
		return 404

print exists('http://arxiv.org/abs/1104.2118')

'''
cur = db.cursor() 
file_name = '../new_corpus/parsed/1_out.pytext'
#f1 = open('../new_corpus/parsed/1_out.pytext', 'a+')

for line in open(file_name):
	record = eval(line)
	is_updated = False
	title_updated = False
	doi_updated = False
	url_updated = False

	
	print "record"
	if record['last_updated'] != '':
		alternate_id = record['id'].encode('utf-8')
		title = record['title'].encode('utf-8')
		abstract = record['abstract'].encode('utf-8')
		doi = record['doi']
		url_valid = record['url_valid']
		if doi is not None:
			doi = record['doi'].encode('utf-8')
		q = "select * from articles where alternate_id like '{0}' LIMIT 1;".format(alternate_id)
		cur.execute(q)
		for row in cur.fetchall():

			title_db = row[2]
			if title != title_db:
				title_updated = True

			abstract_db = row[3]
			doi_db = row[5]
			article_id_db = row[0]
			if doi_db == None and doi != None:
				doi_updated = True
			url_db = row[4]

			if url_valid:
				url_updated = True

			#query
			if url_updated or title_updated:
				print "{0}test".format(title)
				q = "UPDATE table_name SET title = {0}, doi={1} WHERE alternate_id = {2}".format(title,doi,alternate_id)
				print q

			if not url_valid and url_db.find('arxiv') > 0:
					print "found"
				print url_db
				q = "INSERT INTO `corpus`.`url_valid` (`article_id`, `url_valid`) VALUES ('{0}', '{1}');" .format(url_valid,article_id_db)
				print q
	#break
db.commit()
cur.close()
'''