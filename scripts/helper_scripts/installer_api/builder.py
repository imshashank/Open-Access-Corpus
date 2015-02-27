import urllib2,json
import MySQLdb, re
import unicodedata
import timeit
import include

'''

db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base
'''
db = MySQLdb.Connection(host=DB_HOST, # your host, usually localhost
                 user=DB_USER, # your username
                      passwd=DB_PASS, # your password
                      db=DB_NAME) # name of the data base


file_name = CORPUS_FILE
# you must create a Cursor object. It will let
#  you execute all the queries you need

cur = db.cursor() 
#conn = db.cursor() 
s=10
n=0
x=0
start = timeit.timeit()

for line in open(file_name):
	record = eval(line)
	if x <= s:
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
		#title1 = re.sub(r'[^0-9a-zA-Z+_. ]+','%', title)
		#title1 = str(unicodedata.normalize('NFKD', record['title']).encode('ascii','ignore'))
		# print title1
		title = MySQLdb.escape_string(title)
		article_id = True
		'''
		q= "Select count(*) from articles where title like '%{0}%'".format(title1)
		cur.execute(q)
		for row in cur.fetchall():
			count= row[0]
			break
		'''
		count = 0
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
				#print q
				cur.execute(q)
			except  Exception, e :
	  				# print("Something went wrong: {0}".format(e))
	  				article_id = None
	  			#	break
			
		#else:
			# print "article exists"
		if article_id is not None:
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

			
			if journal is not None:
				journal = MySQLdb.escape_string(journal.encode('utf-8').rstrip())

				journal = str(journal)
				q = "Select count(*) from `corpus`.`journal` where journal_name like '%{0}%' LIMIT 1;".format(journal)
				print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break

				if count == 0  :
					try:
						print journal
						q = "INSERT INTO `corpus`.`journal` (`journal_id`, `journal_name`) VALUES (NULL, '{0}');" .format(journal)
						cur.execute(q)
					except Exception,e:
						print e
					# print q
			#else:
					# print "journal exists"
			#else:
				# print "journal none"
		#article_journal table
			if journal is not None:
				q = "Select journal_id from `corpus`.`journal` where journal_name like '%{0}%' LIMIT 1 ;".format(journal)
				print q
				cur.execute(q)
				for row in cur.fetchall():
					journal_id= row[0]
					break
				q = "Select count(*) from `corpus`.`article_journal` where article_id like '{0}' and journal_id like '{1}' LIMIT 1 ;".format(article_id,journal_id)
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break
				if count == 0  :
					q = "INSERT INTO `corpus`.`article_journal` (`article_id`, `journal_id`) VALUES ('{0}', '{1}');" .format(article_id,journal_id)
					cur.execute(q)
					print q
			#	else:
					# print "article & journal exists"
		#	else:
				# print "journal none"

			#publisher table
			if publisher is not None:
				publisher = MySQLdb.escape_string(publisher.encode('utf-8').rstrip())
				q = "Select count(*) from `corpus`.`publisher` where publisher_name like '%{0}%' LIMIT 1;".format(publisher)
				print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break

				if count == 0  :
					try:
						print publisher 
						q = "INSERT INTO `corpus`.`publisher` (`publisher_id`, `publisher_name`) VALUES (NULL, '{0}');" .format(publisher)
						cur.execute(q)
					except Exception,e:
						print e

					#print q
			#	else:
					# print "publisher exists"
		#	else:
				# print "publisher none"
			#author_table
			for issn in issns:
				issn = issn.encode('utf-8')
				q = "Select count(*) from `corpus`.`issns` where issn like '%{0}%' LIMIT 1;".format(issn)
				# print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break

				if(count == 0):
					q = "INSERT INTO `corpus`.`issns` (`issn`, `journal_id`) VALUES ('{0}', '{1}');" .format(issn,journal_id)
					cur.execute(q)
					# print q
			#	else:
					# print "issn exists"

	#publisher_article table
			if publisher is not None:
				print publisher
				q = "Select publisher_id from `corpus`.`publisher` where publisher_name like '%{0}%' LIMIT 1;".format(publisher)
				# print q
				cur.execute(q)
				db.commit()
				for row in cur.fetchall():
					publisher_id = row[0]
					break
				# print publisher_id
				q = "Select count(*) from `corpus`.`publisher_article` where article_id like '{0}' and publisher_id like '{1}' and journal_id like '{2}' LIMIT 1 ;".format(article_id,publisher_id,journal_id)
				# print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break
				if count == 0  :
					q = "INSERT INTO `corpus`.`publisher_article` (`article_id`, `publisher_id`, `journal_id`) VALUES ('{0}', '{1}', '{2}');" .format(article_id,publisher_id,journal_id)
					cur.execute(q)
					print q
				#else:
					# print "article & publisher exists"
		#	else:
				# print "publisher none"

		#tags_table
			for tag in tags:
				tag = MySQLdb.escape_string(tag.encode('utf-8').rstrip())
				q = "Select count(*) from `corpus`.`tags` where tags_name like '%{0}%' LIMIT 1;".format(tag)
				#print q
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break

				if(count == 0):

					try:
						q = "INSERT INTO `corpus`.`tags` (`tags_id`, `tags_name`) VALUES (NULL, '{0}');" .format(tag)
						cur.execute(q)
					except Exception,e:
						print e
			#	else:
					# print "tag exists"

			for tag in tags:
				tag = MySQLdb.escape_string(tag.encode('utf-8').rstrip())
				q = "Select tags_id from `corpus`.`tags` where tags_name like '%{0}%' LIMIT 1 ;".format(tag)
				## print q
				cur.execute(q)
				for row in cur.fetchall():
					tag_id= row[0]
					break

				q = "Select count(*) from `corpus`.`article_tags` where article_id like '{0}' and tag_id like '{1}' LIMIT 1 ;".format(article_id,tag_id)
				cur.execute(q)
				for row in cur.fetchall():
					count= row[0]
					break
				if count == 0  :
					q = "INSERT INTO `corpus`.`article_tags` (`article_id`, `tag_id`) VALUES ('{0}', '{1}');" .format(article_id,tag_id)
					cur.execute(q)
					print q
			#	else:
					# print "tag_id and article_id exists"
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