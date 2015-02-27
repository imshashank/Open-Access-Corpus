def check_hash(file_name,eng_file,file_out):
	ids = {}
	n = 0
	f_out = open(file_out, 'a+')
	for line in open(file_name):
		#ids[alternate_id] = True
		n = n+1
		record = eval(line)
		alternate_id = record['id']
		ids[alternate_id] = True

		print n
		if n >100:
			break
	n = 0
	for line in open(eng_file):
		n = n+1
		record = eval(line)
		alternate_id = record['id']
		id_res = ids.get(alternate_id,False)
		if id_res:
			#add to a file
			print "record found"
			print >>f_out,  record
			f_out.flush()
		print n
		if n >100:
			break
		'''
		alternate_id = record['alternate_id']
		id_res = ids.get(alternate_id,False)
		if id_res:
			print alternate_id
			print >>title_error, title_dup
		else:
			ids[alternate_id] = True
		'''

		
check_hash('/mnt/corpus.pytext', '/mnt/english.pytext', '/mnt/english_out.pytext')
