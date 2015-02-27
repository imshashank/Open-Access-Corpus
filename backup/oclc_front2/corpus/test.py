import urllib2,json
import MySQLdb, re
from pprint import pprint
import unicodedata
import httplib
from stdnum import issn
import find_doi as doi_validator
import urlparse
import time 


def file_len(fname):
	i=0
	with open(fname) as f:
		try:
			for i, l in enumerate(f):
				pass
		except:
			return 0
	return i + 1

def url_fix(url):
	if not url.startswith('http'):
		url = '%s%s' % ('http://', url)
	pieces = list(urlparse.urlparse(url))
	pieces[2] = re.sub(r'^[./]*', '/', pieces[2])
	pieces[-1] = ''
	return urlparse.urlunparse(pieces)
def exists(site):
	try:
		r = urllib2.urlopen(site)
	except urllib2.URLError as e:
		print e
		r = e
	try:
		if r.code in (200, 401, 403):
			return 200
		elif r.code == 404:
			print '[{}]: '.format(site), "Not Found!"
			return 404
	except:
		return 404


def check(x):
	n=0
	f = open('new.pytext', 'a')


	for line in open('corpus5k.pytext'):
		error=False
		article = {}
		record = eval(line)
		if n >= x: #to skip lines
			title = record['title'].encode('utf-8').rstrip()
			print title
			article['title']=title.decode('utf-8')

			abstract = record['abstract']
			if abstract != None:
				abstract = record['abstract'].encode('utf-8').rstrip()
				article['abstract'] = abstract.decode('utf-8')
			else:
				article['abstract'] = None
			print(abstract);

			authors = record['authors']
			authors_new = []
			if authors != None:
				for name in authors:
					name = name.encode('utf-8').rstrip()
					print name
					authors_new.append(name.decode('utf-8'))
			article['authors'] = authors_new

			is_published = record['is_published']
			article['is_published'] = is_published

			issns = record['issns']
			issns_new = []
			for name in issns:
				name = name.encode('utf-8').rstrip()
				print name
				#checks for validity of issn
				result = issn.is_valid(name)
				if result:
					issns_new.append(name.decode('utf-8'))
					print "issn valid"
			article['issns'] = issns_new

			issue = record['issue']
			if issue != None:
				issue = issue.encode('utf-8').rstrip()
				print issue
				article['issue'] = issue.decode('utf-8')
			else:
				article['issue'] = None

			journal = record['journal']
			if journal != None:
				journal = journal.encode('utf-8').rstrip()
				print journal
				article['journal'] = journal.decode('utf-8')
			else:
				article['journal'] = None

			volume = record['volume']
			if volume != None:
				volume = volume.encode('utf-8').rstrip()
				print volume
				article['volume'] = volume.decode('utf-8')
			else:
				article['volume'] = None

			page = record['page']
			if page != None: 
				article['page'] = page
			else:
				article['page'] = None

			language = record['language']
			lang_new = []
			for row in language:
				row = row.encode('utf-8').rstrip()
				print row
				lang_new.append(row.decode('utf-8'))
			article['language'] = lang_new

			merged_info = record['merged_info']
			article['merged_info'] = merged_info
			article['spellcheck'] = record['spellcheck']
			article['id'] = record['id']
			referenced = record['referenced']	
			article['referenced'] = referenced
			article['accept_text'] = record['accept_text']


			publisher = record['publisher']
			if publisher != None:
				publisher = publisher.encode('utf-8').rstrip()
				article['publisher'] = publisher.decode('utf-8')
			else:
				article['publisher'] = None



			tags_new = []
			tags = record['tags']
			for name in tags:
				name = name.encode('utf-8').rstrip()
				print name
				tags_new.append(name.decode('utf-8'))
			article['tags'] = tags_new

			year = record['year']
			article['year'] = None
			if year != None:
				year = year.encode('utf-8').rstrip()
				print year
				article['year'] = year

			alts = record['alts']

			article['alts'] = alts
			
			url = record['url']
			if url != None :
				url = url.encode('utf-8').rstrip()
				print url	
				#checks if URL valid
				url= url_fix(url)
				#print url
				try:
					if exists(url) != 200:
						print "url invalid"
						error_file = open('errors.pytext', 'a')
						print >>error_file,  n
						error_file.close()
						error = True
						#return 0
					else:
						article['url'] = url.decode('utf-8')
				except urllib2.URLError, e:
					print e.code
					error = True
					article['url'] = None
						
			doi = record['doi']
			new_doi = None
			if doi != None and not error:
				doi = doi.encode('utf-8').rstrip()
				article['doi'] = doi.decode('utf-8')
				print doi
				print "doi exists"
			else:
				try:
					print "google_doi"
					new_doi = doi_validator.google_title_to_doi(title)
					print new_doi
				except:
					print "except"

				if new_doi == None and not error:
					print "crossref_auth_title_to_doi"
					print authors[0]
					new_doi = doi_validator.crossref_auth_title_to_doi(authors[0],title)
					print new_doi

				if new_doi == None and journal != None and volume != None and page != None and not error:
					print "trying last method"
					new_doi = doi_validator.google_doi(journal, volume, page,title)
					print new_doi
			
				if new_doi != None and not error:
					article['doi'] = new_doi.decode('utf-8')
				else:
					article['doi'] = None
			#pprint (article)
			
			if not error:
				
				#f.write("%s\n" % article)
				print >>f,  article
				article = None
			

		n= n+1
		#if n >=14:
		#	break

x = file_len('new.pytext')
y=0
try:
	y = file_len('errors.pytext')
except e:
	print e
x =x +y
check(x)