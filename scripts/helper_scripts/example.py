import MySQLdb, re


db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base
cur = db.cursor() 

q = "SELECT count(*) from articles where url like '%arxiv%' ;"
cur.execute(q)

for row in cur.fetchall():
	print row[0]

'''

q = 'ALTER IGNORE TABLE issns ADD UNIQUE INDEX unique_issn (issn, journal_id); '
cur.execute(q)


#q = 'ALTER IGNORE TABLE article_journal ADD UNIQUE INDEX unique_journal (article_id, journal_id); '
#cur.execute(q)


#q = 'ALTER IGNORE TABLE article_tags ADD UNIQUE INDEX unique_tag (article_id, tag_id); '
#cur.execute(q)

#q = 'ALTER IGNORE TABLE publisher_article ADD UNIQUE INDEX unique_publisher(article_id, publisher_id, journal_id); '
#cur.execute(q)




#q = 'ALTER IGNORE TABLE author_article ADD UNIQUE INDEX unique_article (article_id, author_id);' 
#cur.execute(q)

#for row in cur.fetchall():
#	print row[0]

'''