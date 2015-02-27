#!/usr/bin/env python3.0

import os, sys

def file_len(fname):
    i=0
    try:
        with open(fname) as f:
            for i, l in enumerate(f):
                pass
    except:
        return 0
    return i + 1

def remove_lines(number,file):
    #number = int(sys.argv[1])
   # file = sys.argv[2]
    count = 0

    with open(file,'r+b', buffering=0) as f:
        f.seek(0, os.SEEK_END)
        end = f.tell()
        while f.tell() > 0:
            f.seek(-1, os.SEEK_CUR)
            print(f.tell())
            char = f.read(1)
            if char != b'\n' and f.tell() == end:
                print ("No change: file does not end with a newline")
                exit(1)
            if char == b'\n':
                count += 1
            if count == number + 1:
                f.truncate()
                print ("Removed " + str(number) + " lines from end of file")
                exit(0)
            f.seek(-1, os.SEEK_CUR)

    if count < number + 1:
        print("No change: requested removal would leave empty file")
        exit(3)


for n in range(1,2):
    out = '/mnt/final/' +str(n) + '_out.pytext'
    print out
    #err = ''.join('errors/',str(n), '_errors.pytext')

    x = file_len(out)
    print x
    remove = x - 10000

    if remove > 0 :
        print "remove lines"
        print remove
        remove_lines(remove,out)

    # print x
    
print "complete"
