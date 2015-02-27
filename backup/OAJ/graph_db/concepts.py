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
con ={}

file_name = "concepts.pytext"
for line in open(file_name):
		record = eval(line)
		for x in record:
			if isinstance(x, list):
				for y in x:
					con[y[0]]=0

for key in con:
	print key
	try:
		q1 = "INSERT INTO `corpus`.`concepts` (`concept_id`, `concept_name`) VALUES (null, '%s');" %(key.encode('utf-8'))
		print q1
		cur.execute(q1)
		db.commit()
	except Exception as e:
		print e
		

'''
file_name = "concepts.pytext"
for line in open(file_name):
		record = eval(line)
		for x in record:
			if isinstance(x, list):
				for y in x:
					try:
					#q1 = "INSERT INTO `corpus`.`concepts` (`concept_id`, `concept_name`) VALUES (null, '{0}');".format(y[0].encode('utf-8'))
						q1 = "INSERT INTO `corpus`.`concepts` (`concept_id`, `concept_name`) VALUES (null, '%s');" %(y[0].encode('utf-8'))
						print q1
						cur.execute(q1)
					except Exception as e:
						print e
					print y
					db.commit()
'''
