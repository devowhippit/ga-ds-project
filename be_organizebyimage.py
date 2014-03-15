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

_dir      = 'exp-behance/wp-content/cache/'
_projects = 'exp-behance-py/static/data/projectbyimage.json'
_data     = json.load( open( _projects ) ) if os.path.isfile( _projects ) else { "projects" : [{}] }

# Get Every File in the cache directory
for file in listdir( _dir ) :
	if file.endswith( '.json' ) :
		jsondata = open( _dir + file )
		data = json.load( jsondata )
		if "projects" in data :
			for project in data[ "projects" ] :
				if type( project[ "covers" ] ) is dict :
					for key , value in project[ "covers" ].items() :
						####
						## Get the url of the smallest image and store it in the "img" directory
						if key == "202" :

							print project["covers"]

							_imagename = os.path.basename( project["covers"]["202"] );

							_data[ "projects" ][ 0 ][ _imagename ] = [ project ]

							# _project = { 
							# 	"id"            : project[ "id" ],
							# 	"views"         : project[ "stats" ][ "views" ], 
							# 	"appreciations" : project[ "stats" ][ "appreciations" ], 
							# 	"comments"      : project[ "stats" ][ "comments" ]
							# }

							# _projectrange = []
							# _views = int( project[ "stats" ][ "views" ] )

							# for _range in _ranges :
							# 	if _ranges[_range][1] <= _views <= _ranges[_range][0] :
							# 		_projectrange = _ranges[_range]

							# 		_key     = str( _projectrange )
							# 		_project = { 
							# 			"id"            : project[ "id" ],
							# 			"views"         : project[ "stats" ][ "views" ], 
							# 			"appreciations" : project[ "stats" ][ "appreciations" ], 
							# 			"comments"      : project[ "stats" ][ "comments" ]
							# 		}

							# 		if _key in _data[ "buckets" ][ 0 ] :
							# 			_data[ "buckets" ][ 0 ][ _key ].append( _project )

							# 		else :
							# 			_data[ "buckets" ][ 0 ][ _key ] = [ _project ]

							_id = str( project[ "id" ] )
							print 'Fetching Project ' + _id
							print 'Name: ' + _imagename
							print '_______________________________'
		
with open( _projects , 'w+' ) as outfile :	
	json.dump( _data , outfile , indent = 4 )


# END DATA FUNCTIONS
####
