import urllib2,json

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

print exists('http://hepmon.com/view/?id=209')
