import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata
import timeit


db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need

cur = db.cursor() 
#conn = db.cursor() 
s=100000
n=0
x=0
start = timeit.timeit()


for line in open('newaa.pytext'):
	record = eval(line)
	if not (x <= s):
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

		count = 0
		if(count == 0):
			# print q
			try:

				q = 'CREATE (article:Article {article_id:"{0}",alternate_id:"{1}",title:"{2}", abstract:"{3}", url="{4}",  doi="{5}", language="{6}", year:{7}, page="{8}", is_published="{9}"  })' .format(article_id,alternate_id,title,abstract,url,doi,language,year,page,is_published)
				#q= "INSERT INTO `corpus`.`articles` (`article_id`, `alternate_id`,`title`, `abstract`, `url`, `doi`, `language`, `year`, `page`, `is_published`, `alts`) VALUES (NULL, '{0}','{1}','{2}','{3}','{4}','{5}','{6}','{7}','{8}','{9}');"  .format(alternate_id,title,abstract,url,doi,language,year,page,is_published,alts)
				print q
				
			except  Exception, e :
	  				article_id = None
	  		
		if article_id is not None:
		
			#author_table
			for name in authors:
				name = MySQLdb.escape_string(name.encode('utf-8').rstrip())
				print name
				q = 'CREATE (author:Author {author_id:{0}, author_name:{1}}) '.format(author_id,name)
				print q
				q = 'CREATE (article)-[:AUTHORED_BY]-> (author)'
				print q

			
			if journal is not None:
				journal = MySQLdb.escape_string(journal.encode('utf-8').rstrip())

				journal = str(journal)
				q = 'CREATE (journal:Journal {journal_id:, journal_name:""})'.format(journal_id,journal_name)
				print q
		
			#publisher table
			if publisher is not None:
				publisher = MySQLdb.escape_string(publisher.encode('utf-8').rstrip())
				q = 'CREATE (publisher:Publisher {publisher_id:, publisher_name:""})'.format(publisher_id,publisher)
				print q


			for tag in tags:
				tag = MySQLdb.escape_string(tag.encode('utf-8').rstrip())
				q ='CREATE (tags:Tags {tags_id:{0}, tags_name:"{1}"})'. .format(tag_id,tag)
				print q
				
	else:
		print "skipping record"
		print x
	x = x+1
	n=n+1
	if n > 1000:
		print n
		#break

end = timeit.timeit()
print end - start


'''
CREATE (article:Article {article_id:"",alternate_id:"",title:"A Few Good Men",url="", year:1992, language="", abstract:"In "})

#author
CREATE (author:Author {author_id:, author_name:""})

#publisher
CREATE (publisher:Publisher {publisher_id:, publisher_name:""})

#journal
CREATE (journal:Journal {journal_id:, journal_name:""})

#tags
CREATE (tags:Tags {tags_id:, tags_name:""})

#concepts
CREATE (concepts:Concepts {concepts_id:, concepts_name:""})

#issns
RETURN article;

CREATE
  (article)-[:AUTHORED_BY]-> (author),
  (article)-[:PUBLISHED_BY]-> (publisher),
  (article)-[:PUBLISHED_IN]-> (journal),
  (article)-[:TAGGED_BY]-> (tags),
  (article)-[:CATEGORIZED_IN]-> (concepts),

  (JackN)-[:ACTED_IN {roles:['Col. Nathan R. Jessup']}]->(AFewGoodMen),
  (DemiM)-[:ACTED_IN {roles:['Lt. Cdr. JoAnne Galloway']}]->(AFewGoodMen),
  (KevinB)-[:ACTED_IN {roles:['Capt. Jack Ross']}]->(AFewGoodMen),
  (KieferS)-[:ACTED_IN {roles:['Lt. Jonathan Kendrick']}]->(AFewGoodMen),
  (NoahW)-[:ACTED_IN {roles:['Cpl. Jeffrey Barnes']}]->(AFewGoodMen),
  (CubaG)-[:ACTED_IN {roles:['Cpl. Carl Hammaker']}]->(AFewGoodMen),
  (KevinP)-[:ACTED_IN {roles:['Lt. Sam Weinberg']}]->(AFewGoodMen),
  (JTW)-[:ACTED_IN {roles:['Lt. Col. Matthew Andrew Markinson']}]->(AFewGoodMen),
  (JamesM)-[:ACTED_IN {roles:['Pfc. Louden Downey']}]->(AFewGoodMen),
  (ChristopherG)-[:ACTED_IN {roles:['Dr. Stone']}]->(AFewGoodMen),
  (AaronS)-[:ACTED_IN {roles:['Man in Bar']}]->(AFewGoodMen),
  (RobR)-[:DIRECTED]->(AFewGoodMen),
  (AaronS)-[:WROTE]->(AFewGoodMen)
			'''


