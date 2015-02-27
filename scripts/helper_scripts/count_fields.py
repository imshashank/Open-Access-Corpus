
def check_count(file_name):
	count_doi = 0
	count_journal = 0
	count_publisher = 0
	count_url = 0
	n = 0
	for line in open(file_name):
		n = n+1
		#print n
		record = eval(line)
		article_id = record['id']
		doi = record['doi']
		url_valid = record['url_valid']

		if doi != None :
			count_doi = count_doi +1
		publisher = record['publisher']
		if publisher != None :
			count_publisher = count_publisher +1
		journal = record['journal']
		if journal != None :
			count_journal = count_journal +1
		if url_valid :
			count_url = count_url +1


	print "doi"
	print count_doi
	print "publishers"
	print count_publisher
	print "journal"
	print count_journal
	print "valid url"
	print count_url


check_count('/mnt/final/corpus.pytext')
