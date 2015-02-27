import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata
import timeit


db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base


cur = db.cursor() 

#ALTER TABLE `authors` ADD UNIQUE(`author_name`);

#q = "ALTER TABLE author_article ADD FOREIGN KEY (author_id) REFERENCES authors(author_id);"

#q = "ALTER TABLE article_tags ADD FOREIGN KEY (article_id) REFERENCES articles(article_id)"

#q = "ALTER TABLE article_tags ADD FOREIGN KEY (tag_id) REFERENCES tags(tags_id)"

#q = "ALTER TABLE publisher_article ADD FOREIGN KEY (article_id) REFERENCES articles(article_id)"

#q = "ALTER TABLE publisher_article ADD FOREIGN KEY (publisher_id) REFERENCES publisher(publisher_id)"

#q = "ALTER TABLE article_journal ADD FOREIGN KEY (article_id) REFERENCES articles(article_id)"

#q = "ALTER TABLE article_journal ADD FOREIGN KEY (journal_id) REFERENCES journal(journal_id)"


q = "INSERT INTO `corpus`.`article_tags` (`article_id`, `tag_id`) VALUES ('1115896', '59966'); INSERT INTO `corpus`.`article_tags` (`article_id`, `tag_id`) VALUES ('1115896', '38558'); INSERT INTO `corpus`.`article_tags` (`article_id`, `tag_id`) VALUES ('1115896', '315319');"
#q = "ALTER TABLE author_article ADD FOREIGN KEY (article_id) REFERENCES articles(article_id);"
#q= "ALTER IGNORE TABLE `authors` ADD UNIQUE(`author_name`);"
#q= "SELECT COUNT(*) FROM articles"
#/usr/local/mysql/bin/mysqldump  -h oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com -u corpus -pOCLC_123 --no-data corpus > dump1.sql
#q = "SELECT author_id,author_name, COUNT(*) c FROM authors GROUP BY author_name HAVING c > 1;"

result = cur.execute(q)
pprint (result)
for row in cur.fetchall():
	pprint (row)