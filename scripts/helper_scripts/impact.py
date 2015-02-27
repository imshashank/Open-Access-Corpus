import csv
import urllib2, urllib
import json

f_out = open('impact_out.csv', 'w')
fields = {}
with open('impact.csv', 'rB') as f:
	#writer = csv.writer(open("out_file", 'w'))

	reader = csv.reader(f)
	for row in reader:
	#replace multiple spaces
	#['newId', ' TITLE', ' DATE', ' TOPICS', ' PLACES', ' BODY']
		print row[1]
		journal = urllib.quote(row[1])
		req = "http://open-academia.org/rest/get_journal_by_name/{0}".format(journal)
		print req
		response = urllib2.urlopen(req)
		data = json.load(response)
		if data != '' :
			print "saving data"
			fields['journal_id']=data
			fields['journal_name']=row[1]
			fields['impact_factor']=row[3]
			fields['eigenfactor']=row[4]
			print >> f_out, fields
			f_out.flush()
		print data