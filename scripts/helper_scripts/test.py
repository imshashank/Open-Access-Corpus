import MySQLdb, re


db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base
journal = "science"
q= "select * from article_journal where journal_name like '%{0}%' LIMIT 1".format(journal)

print q
cur = db.cursor() 
cur.execute(q)
for row in cur.fetchall():
	count= row[0]
	
