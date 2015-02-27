import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata
import timeit


db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base
# /usr/local/mysql/bin/mysql -u corpus -p -h oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com 
mysqldump -u corpus -p -h oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com  corpus > corpus.sql
# you must create a Cursor object. It will let
#  you execute all the queries you need

cur = db.cursor() 
#conn = db.cursor() 
s=100000
n=0
x=0
start = timeit.timeit()

for line in open('newac.pytext'):
	record = eval(line)
	if not (x <= s):
		print "record"
		print x
	#p# print (record)
		title = record['title'].encode('utf-8').rstrip()
		abstract = record['abstract']
		if abstract is not None:
			abstract = MySQLdb.escape_string(record['abstract'].encode('utf-8').rstrip())
		
		authors = record['authors']
		alternate_id = record['id'].encode('utf-8').rstrip()

		doi = record['doi']
		if doi is not None:
			doi = record['doi'].encode('utf-8').rstrip()

		is_published = record['is_published']
		if is_published == True:
			is_published = 1
		else:
			is_published = 0
		issns = record['issns']
		issue = record['issue']
		journal = record['journal']
		language = record['language']
		if language == "[]":
			langauge = None
		else :
			for row in language:
				language = row.encode('utf-8').rstrip()
				break
		merged_info = record['merged_info']
		page = record['page']
		if page == None: 
			page = 0;
		else:
			page = page.encode('utf-8')
		publisher = record['publisher']
		tags = record['tags']
		volume = record['volume']
		year = record['year']
		if year == None:
			year = 0

		alts = MySQLdb.escape_string(str(record['alts']))
		alts=''
		url =  MySQLdb.escape_string(record['url'].encode('utf-8'))

		#article_table
		print title
		title1 = re.sub(r'[^0-9a-zA-Z+_. ]+','%', title)
		#title1 = str(unicodedata.normalize('NFKD', record['title']).encode('ascii','ignore'))
		# print title1
		title = MySQLdb.escape_string(title)
		article_id = True
		
		q= "Select count(*) from articles where title like '%{0}%'".format(title1)
		cur.execute(q)
		for row in cur.fetchall():
			count= row[0]
			break
		
		#count = 0
		if(count == 0):
			# print q
			try:
				# print title
				# print abstract
				# print url
				# print doi
				# print language
				# print year
				# print page
				# print is_published
				# print alts
				q= "INSERT INTO `corpus`.`articles` (`article_id`, `alternate_id`,`title`, `abstract`, `url`, `doi`, `language`, `year`, `page`, `is_published`, `alts`) VALUES (NULL, '{0}','{1}','{2}','{3}','{4}','{5}','{6}','{7}','{8}','{9}');"  .format(alternate_id,title,abstract,url,doi,language,year,page,is_published,alts)
				print q
				#cur.execute(q)
			except  Exception, e :
	  				# print("Something went wrong: {0}".format(e))
	  				article_id = None
	  			#	break
			
		#else:
			# print "article exists"
		if article_id is not None :
			q = "Select article_id from `corpus`.`articles` where title like '{0}' LIMIT 1 ;".format(title)
			cur.execute(q)
			for row in cur.fetchall():
				new_article_id = row[0]
				break
			article_id = new_article_id
			print "article_id"
			print article_id

			#author_table
			for name in authors:
				name = MySQLdb.escape_string(name.encode('utf-8').rstrip())
				print name
				q = "Select count(*) from `corpus`.`authors` where author_name like '%{0}%' LIMIT 1;".format(name)
				#print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break

				if(count == 0):
					try:
						q = "INSERT INTO `corpus`.`authors` (`author_id`, `author_name`) VALUES (NULL, '{0}');" .format(name)
						print "adding author"
						cur.execute(q)
						db.commit()
					except Exception,e:
						print e
						print "author already present"
						# print q
					#else:
						# print "author exists"
				#else:
					# print "author name is empty"
		

		#author_article
			for name in authors:
				#print name
				if name is not '':
					name = MySQLdb.escape_string(name.encode('utf-8').rstrip())
					q = "Select author_id from `corpus`.`authors` where author_name like '%{0}%' LIMIT 1;".format(name)
					cur.execute(q)
					for row in cur.fetchall():
						author_id= row[0]
						break
					print author_id;
					q = "Select count(*) from `corpus`.`author_article` where author_id like '{0}' and article_id like '{1}' LIMIT 1 ;".format(author_id,article_id)
					cur.execute(q)
				## print q
					for row in cur.fetchall():
						count= row[0]
						break

					if count ==0:
						q = "INSERT INTO `corpus`.`author_article` (`author_id`, `article_id`) VALUES ('{0}', '{1}');" .format(author_id,article_id)
						print q
						cur.execute(q)
						## print q
					else:
						print "author and article exists in author_table"
				else:
					print "name is empty"

			
	else:
		print "skipping record"
		print x
	x = x+1
	n=n+1
	if n > 1000:
		print n
		#break
	
db.commit()
cur.close()
end = timeit.timeit()
print end - start