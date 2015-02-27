import pprint

def check_hash(file_name,titles_error,urls_error):
	titles = {}
	urls = {}
	n = 0
	for line in open(file_name):
		n = n+1
		title_error = open(titles_error, 'a+')
		url_error = open(urls_error, 'a+')
		record = eval(line)
		article_id = record['id']
		title = record['title'].encode('utf-8').rstrip()
		title_res = titles.get(title,False)
		if title_res:
			title_dup = {}
			print n
			print "duplicate article"
			title_dup['original'] = title_res
			title_dup['duplicate'] = article_id
			print article_id
			print >>title_error, title_dup
		else:
			titles[title] = article_id

		url = record['url']
		url_res = urls.get(url,False)
		if url_res:
			print "duplicate link"
			url_dup = {}
			url_dup['original'] = url_res
			url_dup['duplicate'] = article_id
			print url_res
			print article_id
			print >>url_error,  url_dup
		else:
			urls[url] = article_id

check_hash('/mnt/final/corpus.pytext', '/var/www/html/OAJ/new_corpus/dup_error/err_test.pytext', '/var/www/html/OAJ/new_corpus/err_test/url_error.pytext')
