import MySQLdb
db = MySQLdb.Connection(host="oclc-corpus.caswnd4dnxjz.us-east-1.rds.amazonaws.com", # your host, usually localhost
                 user="corpus", # your username
                      passwd="OCLC_123", # your password
                      db="corpus") # name of the data base
cur = db.cursor()
#q = 'CREATE TABLE IF NOT EXISTS `concepts` (`concept_id` int(20) NOT NULL AUTO_INCREMENT, `concept_name` varchar(100) NOT NULL,PRIMARY KEY (`concept_id`),UNIQUE KEY `concept_name` (`concept_name`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
#cur.execute(q)

# = "INSERT INTO `corpus`.`concepts` (`concept_id`, `concept_name`) VALUES (NULL, 'Brazil');"
#cur.execute(q)
#q = 'CREATE TABLE IF NOT EXISTS `concepts` (`concept_id` int(20) NOT NULL AUTO_INCREMENT,`concept_name` varchar(100) NOT NULL,PRIMARY KEY (`concept_id`),UNIQUE KEY `concept_name` (`concept_name`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;'
#cur.execute(q)
#q = "Select * from concepts"
#print q
#ur.execute(q)
#for row in cur.fetchall():
#		print row[0]
#		print row[1]
concepts_id={}
q = "select * from concepts"
cur.execute(q)
for row in cur.fetchall():
	concepts_id[row[1]]=row[0]

#for key in concepts_id:
#	print key
							

file_name = "concepts.pytext"
for line in open(file_name):
		record = eval(line)
		for x in record:
			if not isinstance(x, list):
				aid = x
			if isinstance(x, list):
				queries = []

				for y in x:
					try:
					#q1 = "INSERT INTO `corpus`.`concepts` (`concept_id`, `concept_name`) VALUES (null, '{0}');".format(y[0].encode('utf-8'))
						#get id of concept
						'''
						q = "SELECT * FROM `concepts` WHERE `concept_name` LIKE '{0}' LIMIT 1".format(y[0].encode('utf-8'))
						cur.execute(q)
						for row in cur.fetchall():
							concept_id = row[0]
							break
						'''
						#print y[0]
						c_id = concepts_id[y[0]]
						if c_id!= '':
							temp = []
							temp.append(aid)
							temp.append(c_id)
							temp.append(y[1])
							queries.append(temp)
							q1 = "INSERT INTO `corpus`.`article_concept` (`alternate_id`, `concept_id`,`score`) VALUES ('{0}','{1}','{2}');" .format(aid,c_id,y[1])
							#print q1
							
							#cur.execute(q1)
					except Exception as e:
						print e
					print y
				try:
					print queries
					cur.executemany("""INSERT INTO `corpus`.`article_concept` (`alternate_id`, `concept_id`,`score`) VALUES (%s,%s,%s);""",queries)

					#cur.execute(queries)
					db.commit()
				except Exception as e:
					print e
				

