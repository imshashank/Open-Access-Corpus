import urllib2,json
import re,MySQLdb
from pprint import pprint
import unicodedata
import timeit
from py2neo import Graph
from py2neo import Node, Relationship


'''
MATCH (article:Article{alternate_id:"00059PP9VIC1FJ4R"}) 
RETURN article


MATCH (article:Article )-[:AUTHORED_BY]->(author:Author)
RETURN article,author

'''

# you must create a Cursor object. It will let
#  you execute all the queries you need



def g():
	graph = Graph()

	#conn = db.cursor() 
	s=100000
	n=0
	x=0
	i =0
	start = timeit.timeit()
	for line in open('corpus.pytext'):
		record = eval(line)
		
		print "record"

		
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
		concepts = record['concepts']
		volume = record['volume']
		year = record['year']
		if year == None:
			year = 0

		alts = MySQLdb.escape_string(str(record['alts']))
		alts=''
		url =  MySQLdb.escape_string(record['url'].encode('utf-8'))

		title = MySQLdb.escape_string(title)
		article_id = True
		

		count = 0
		if(count == 0):
			# print q
			print alternate_id

			q = "CREATE (article:Article {alternate_id:'%s',title:'%s', abstract:'%s', url:'%s',  doi:'%s', language:'%s', year:%s, page:'%s', is_published:'%s' } )"%(alternate_id,title,abstract,url,doi,language,year,page,is_published)
			article = Node("Article", alternate_id =alternate_id,title=title, abstract=abstract, url=url,  doi=doi, language=language, year=year, page=page, is_published=is_published)
			print article
			print q
			if i ==0:
				try:
					q = 'CREATE CONSTRAINT ON (article:Article) ASSERT article.alternate_id IS UNIQUE'
					graph.cypher.execute(q)
				except:
					pass
			print q
			try:
				graph.create(article)
			except:
				q ='MATCH (article:Article{alternate_id:"%s"}) RETURN article'%(alternate_id)
				for record in graph.cypher.execute(q):
					article = (record[0])

							
		if article_id is not None:
		
			for name in authors:
				name = name.replace("'", "")
				name = MySQLdb.escape_string(name.encode('utf-8').rstrip())
				author = Node("Author", author_name=name)
				
				try:
					graph.create(author)
				except:
					q ='MATCH (author:Author{author_name:"%s"}) RETURN author'%(name)
					print q
					for record in graph.cypher.execute(q):
						author = (record[0])

				if i ==0:
					try:
						q = 'CREATE CONSTRAINT ON (author:Author) ASSERT author.author_name IS UNIQUE'
						print q
					except:
						pass
				alice_knows_bob = Relationship(article, "AUTHORED_BY", author)
				try:
					graph.create_unique(alice_knows_bob)
				except:
					pass

			
			if journal is not None:
				journal_name = journal.replace("'", "")
				journal_name = MySQLdb.escape_string(journal_name.encode('utf-8').rstrip())
				
				journal = Node("Journal", journal_name=journal_name)
				try:
					graph.create(journal)
				except:
					q ='MATCH (journal:Journal {journal_name:"%s"}) RETURN journal'%(journal_name)

					for record in graph.cypher.execute(q):
						journal = (record[0])
					
				if i ==0:
					try:
						q = 'CREATE CONSTRAINT ON (journal:Journal) ASSERT journal.journal_name IS UNIQUE'
						graph.cypher.execute(q)

					except:
						pass
				alice_knows_bob = Relationship(article, "PUBLISHED_IN", journal)
				try:
					graph.create_unique(alice_knows_bob)
				except:
					pass

		
			#publisher table
			if publisher is not None:
				publisher_name = MySQLdb.escape_string(publisher.encode('utf-8').rstrip())
				publisher = Node("Publisher", publisher_name=publisher_name)
				try:
					graph.create(publisher)
				except:
					q = 'MATCH (publisher:Publisher { publisher_name:"%s"}) RETURN publisher'%(publisher_name)
					for record in graph.cypher.execute(q):
						publisher = (record[0])

				if i ==0:
					try:
						q = 'CREATE CONSTRAINT ON (publisher:Publisher ) ASSERT publisher.publisher_name IS UNIQUE'
						graph.cypher.execute(q)
						print q
					except:
						pass
				alice_knows_bob = Relationship(article, "PUBLISHED_BY", publisher)
				try:
					graph.create_unique(alice_knows_bob)
				except:
					pass
		
			
			for tag in tags:
				tag_name = MySQLdb.escape_string(tag.encode('utf-8').rstrip())
				
				tag = Node("Tags", tags_name=tag_name)
				try:
					graph.create(tag)
				except:
					q ='MATCH (tags:Tags {tags_name:"%s"}) RETURN tags '%(tag_name)
					for record in graph.cypher.execute(q):
						tag = (record[0])

				if i ==0:
					try:
						q = 'CREATE CONSTRAINT ON (tags:Tags ) ASSERT tag.tag_name IS UNIQUE'
						graph.cypher.execute(q)
					except:
						pass
				alice_knows_bob = Relationship(article, "TAGGED_BY", tag)
				graph.create(alice_knows_bob)
			
			for concept in concepts:
				try:
					print concept
					score = concept[1]
					concepts_name=concept[0]
					
					concepts_name = MySQLdb.escape_string(concepts_name.encode('utf-8').rstrip())
					concept = Node("Concepts", concepts_name=concepts_name)
					try:
						graph.create(concept)
					except:
						q ='MATCH (concepts:Concepts {concepts_name:"%s"}) RETURN concepts'%(concepts_name)
						print q
						for record in graph.cypher.execute(q):
							concept = (record[0])
						
					if i ==0:
						try:
							q = 'CREATE CONSTRAINT ON (concepts:Concepts ) ASSERT concepts.concepts_name IS UNIQUE'
							graph.cypher.execute(q)
						except:
							pass
					property_dictionary = {"score": score}


					alice_knows_bob = Relationship(article, ("CATEGORIZED_IN",property_dictionary), concept)
					try:
						graph.create_unique(alice_knows_bob)
					except:
						pass
				except Exception as e:
					print "error"
					print e
					return 0

		print x
		x = x+1
		n=n+1
		i = i+1
		#if n > 10:
		#	print n
			#break

	end = timeit.timeit()
	print end - start
g()

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


