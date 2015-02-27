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
	f1 = open('author_sql', 'a+')
	n=0
	x=0

	for line in open(file_name):
		record = eval(line)
		if not (x < skip):
			print "record"
			print x
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

		
			print title
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
				try:
					
					q= "INSERT INTO `corpus`.`articles` (`article_id`, `alternate_id`,`title`, `abstract`, `url`, `doi`, `language`, `year`, `page`, `is_published`, `alts`) VALUES (NULL, '{0}','{1}','{2}','{3}','{4}','{5}','{6}','{7}','{8}','{9}');"  .format(alternate_id,title,abstract,url,doi,language,year,page,is_published,alts)
					#print q
					cur.execute(q)
				except  Exception, e :
		  				print("Something went wrong: {0}".format(e))
		  				article_id = None
		  				#break

			startTime = datetime.now()
			if article_id is not None:
				q = "Select article_id from `corpus`.`articles` where title like '{0}' LIMIT 1 ;".format(title)
				cur.execute(q)
				for row in cur.fetchall():
					new_article_id = row[0]
					break
				article_id = new_article_id
				print "article_id"
				print article_id
				print(datetime.now()-startTime)

				startTime = datetime.now()

				for name in authors:
					try:
						q = "INSERT INTO `corpus`.`authors` (`author_id`, `author_name`) VALUES (NULL, '{0}');" .format(name)
						
						print "adding author"
						cur.execute(q)
					except Exception,e:
						print e
					
				print "author time"
				print(datetime.now()-startTime)
				
			#author_article
				startTime = datetime.now()
				
				for name in authors:
					if name is not '':
						name = MySQLdb.escape_string(name.encode('utf-8').rstrip())
						q = "Select author_id from `corpus`.`authors` where author_name like '{0}' LIMIT 1;".format(name)
						
						
						cur.execute(q)
						for row in cur.fetchall():
							author_id= row[0]
							break
						print author_id;
					
						try:
							q = "INSERT INTO `corpus`.`author_article` (`author_id`, `article_id`) VALUES ('{0}', '{1}');" .format(author_id,article_id)
							
							print q
							cur.execute(q)
							
						except Exception,e:
							print e

						
					else:
						print "name is empty"

				
							
				print "second author time"
				print(datetime.now()-startTime)
				startTime = datetime.now()
				journal_id = ''
				if journal is not None:
					journal = MySQLdb.escape_string(journal.encode('utf-8').rstrip())

					journal = str(journal)
				
					try:
						print journal
						q = "INSERT INTO `corpus`.`journal` (`journal_id`, `journal_name`) VALUES (NULL, '{0}');" .format(journal)
						cur.execute(q)
					except Exception,e:
						print e
				
				print "journal  time"
				print(datetime.now()-startTime)


				startTime = datetime.now()
				if journal is not None:
					if journal != '':
						q = "Select journal_id from `corpus`.`journal` where journal_name like '{0}' LIMIT 1 ;".format(journal)
						#print q
						cur.execute(q)

						for row in cur.fetchall():
							journal_id= row[0]
							break
					try:
						q = "INSERT INTO `corpus`.`article_journal` (`article_id`, `journal_id`) VALUES ('{0}', '{1}');" .format(article_id,journal_id)
						cur.execute(q)
						print q
					except:
						print e
						

				print "second journal time"
				print(datetime.now()-startTime)

				#publisher table
				publisher_id = ''
				if publisher is not None:
					publisher = MySQLdb.escape_string(publisher.encode('utf-8').rstrip())
				
					try:
						#print publisher 
						q = "INSERT INTO `corpus`.`publisher` (`publisher_id`, `publisher_name`) VALUES (NULL, '{0}');" .format(publisher)
						cur.execute(q)
					except Exception,e:
						print e

		#publisher_article table
				if publisher is not None:
					#print publisher
					if publisher != '':
						q = "Select publisher_id from `corpus`.`publisher` where publisher_name like '{0}' LIMIT 1;".format(publisher)
						print q
						cur.execute(q)
						db.commit()
						for row in cur.fetchall():
							publisher_id = row[0]
							break
					print publisher_id
					try:
						q = "INSERT INTO `corpus`.`publisher_article` (`article_id`, `publisher_id`, `journal_id`) VALUES ('{0}', '{1}', '{2}');" .format(article_id,publisher_id,journal_id)
						print q
						cur.execute(q)
						#break
					except Exception,e:
						print e
						

				#author_table
				for issn in issns:
					try:
						q = "INSERT INTO `corpus`.`issns` (`issn`, `journal_id`) VALUES ('{0}', '{1}');" .format(issn,journal_id)
						print q
						cur.execute(q)
					except Exception,e:
						print e

				for tag in tags:
				
					try:
						q = "INSERT INTO `corpus`.`tags` (`tags_id`, `tags_name`) VALUES (NULL, '{0}');" .format(tag)
						cur.execute(q)
					except Exception,e:
						print e
		
				for tag in tags:
					tag = MySQLdb.escape_string(tag.encode('utf-8').rstrip())
					q = "Select tags_id from `corpus`.`tags` where tags_name like '{0}' LIMIT 1 ;".format(tag)
					cur.execute(q)
					for row in cur.fetchall():
						tag_id= row[0]
						break

					try:
						q = "INSERT INTO `corpus`.`article_tags` (`article_id`, `tag_id`) VALUES ('{0}', '{1}');" .format(article_id,tag_id)
						cur.execute(q)
					except Exception,e:
						print e
						
		else:
			print "skipping record"
			print x
		x = x+1
		n=n+1
		print end
		if n >= end and end is not 0:
			print n
			break
		
	db.commit()
	cur.close()
	

#read(0,0,'/Library/WebServer/Documents/corpus/oclc_project/new_corpus/old_corpus/1.pytext')


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