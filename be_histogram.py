# Data imports
import json
import urllib
import ntpath
import unicodedata
import os
from os import listdir
import os.path
import pandas as pd

####
# DATA FUNCTIONS

_dir        = 'exp-behance/wp-content/cache/'
_histmemory = 'exp-behance-py/data/hist_memory.json'
_data       = json.load( open( _histmemory ) ) if os.path.isfile( _histmemory ) else { "buckets" : [{}] }
_ranges     = {
	"r1"   : [ 1000000 , 900000 ],
	"r2"   : [ 899999 , 800000 ],
	"r3"   : [ 799999 , 700000 ],
	"r4"   : [ 699999 , 600000 ],
	"r5"   : [ 599999 , 500000 ],
	"r6"   : [ 499999 , 400000 ],
	"r7"   : [ 399999 , 300000 ],
	"r8"   : [ 299999 , 200000 ],
	"r9"   : [ 199999 , 100000 ],
	"r9B"  : [ 99999 , 0 ],
	"r10"  : [ 99999 , 90000 ],
	"r11"  : [ 89999 , 80000 ],
	"r12"  : [ 79999 , 70000 ],
	"r13"  : [ 69999 , 60000 ],
	"r14"  : [ 59999 , 50000 ],
	"r15"  : [ 49999 , 40000 ],
	"r16"  : [ 39999 , 30000 ],
	"r17"  : [ 29999 , 20000 ],
	"r18"  : [ 19999 , 10000 ],
	"r19B" : [ 9999 , 0 ],
	"r19"  : [ 9999 , 9000 ],
	"r20"  : [ 8999 , 8000 ],
	"r21"  : [ 7999 , 7000 ],
	"r22"  : [ 6999 , 6000 ],
	"r23"  : [ 5999 , 5000 ],
	"r24"  : [ 4999 , 4000 ],
	"r25"  : [ 3999 , 3000 ],
	"r26"  : [ 2999 , 2000 ],
	"r27"  : [ 1999 , 1000 ],
	"r27B" : [ 999 , 0 ],
	"r28"  : [ 999 , 900 ],
	"r29"  : [ 899 , 800 ],
	"r30"  : [ 799 , 700 ],
	"r31"  : [ 699 , 600 ],
	"r32"  : [ 599 , 500 ],
	"r33"  : [ 499 , 400 ],
	"r34"  : [ 399 , 300 ],
	"r35"  : [ 299 , 200 ],
	"r36"  : [ 199 , 100 ],
	"r36"  : [ 99 , 0 ],
	"r37"  : [ 99 , 90 ],
	"r38"  : [ 89 , 80 ],
	"r39"  : [ 79 , 70 ],
	"r40"  : [ 69 , 60 ],
	"r41"  : [ 59 , 50 ],
	"r42"  : [ 49 , 40 ],
	"r43"  : [ 39 , 30 ],
	"r44"  : [ 29 , 20 ],
	"r45"  : [ 19 , 10 ],
	"r46"  : [ 9 , 0 ]
}


# Get Every File in the cache directory
for file in listdir( _dir ) :
	if file.endswith( '.json' ) :
		jsondata = open( _dir + file )
		data = json.load( jsondata )
		if "projects" in data :
			for project in data[ "projects" ] :

				_projectrange = []
				_views = int( project[ "stats" ][ "views" ] )

				for _range in _ranges :
					if _ranges[_range][1] <= _views <= _ranges[_range][0] :
						_projectrange = _ranges[_range]

						# if type( project[ "covers" ] ) is dict :
						# 	for key , value in project[ "covers" ].items() :
						# 		####
						# 		## Get the url of the smallest image and store it in the "img" directory
						# 		if key == "202" :
						# 			print project["covers"]
						# 			_imagename = os.path.basename( project["covers"]["202"] );
						# 			_data[ "projects" ][ 0 ][ _imagename ] = [ project ]

						_key     = str( _projectrange )
						_project = { 
							"id"            : project[ "id" ],
							"views"         : project[ "stats" ][ "views" ], 
							"appreciations" : project[ "stats" ][ "appreciations" ], 
							"comments"      : project[ "stats" ][ "comments" ]
						}

						if _key in _data[ "buckets" ][ 0 ] :
							_data[ "buckets" ][ 0 ][ _key ].append( _project )

						else :
							_data[ "buckets" ][ 0 ][ _key ] = [ _project ]

				_id = str( project[ "id" ] )
				print 'Fetching Project ' + _id
				print 'Views: ' + str( _views )
				print 'Range: ' + str( _projectrange )
				print '_______________________________'
		
with open( _histmemory , 'w+' ) as outfile :	
	json.dump( _data , outfile , indent = 4 )


# END DATA FUNCTIONS
####
