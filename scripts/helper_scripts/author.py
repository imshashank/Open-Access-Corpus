import urllib2
import MySQLdb, re
import unicodedata
import timeit
import threading
import pprint
from datetime import datetime


def auth_add(file_name):
	db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
	                 user="corpus", # your username
	                      passwd="OCLC_123", # your password
	                      db="corpus") # name of the data base

	cur = db.cursor() 

	n=0
	x=0

	
	for line in open(file_name):
		startTime = datetime.now()
		try:
			#print line
			line = eval(line)
			q = line['queries'][0]
			print q
			#break
		#q = "Select author_id from `corpus`.`authors` where author_name like '%{0}%' LIMIT 1;".format(name)
			
			cur.execute(q)
			for row in cur.fetchall():
				author_id= row[0]
				break
			print author_id;


			#q = "INSERT INTO `corpus`.`author_article` (`author_id`, `article_id`) VALUES ('{0}', '{1}');" .format(author_id,article_id)
			q = line['queries'][1]
			q = q.replace('None', str(author_id))
			print q
			#sql_q.append(q) 
			cur.execute(q)
			
			## print q
				#print "author and article exists in author_table"
		except Exception, e :
			print e
		print(datetime.now()-startTime)

file_name= 'author_sql'
auth_add(file_name)

