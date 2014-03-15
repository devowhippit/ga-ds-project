import json
import urllib
import ntpath
import unicodedata
from os import listdir

_dir = 'exp-behance/wp-content/cache/'

####
## Get Every File in the cache directory
for file in listdir( _dir ) :
	if file.endswith( '.json' ) :
		jsondata = open( _dir + file )
		data = json.load( jsondata )
		####
		## Go through every project in each cache
		if "projects" in data :
			for project in data[ "projects" ] :
				if type( project[ "covers" ] ) is dict : 
					for key , value in project[ "covers" ].items() :
						####
						## Get the url of the smallest image and store it in the "img" directory
						if key == "202" : 
							url = value.encode()
							urllib.urlretrieve( url , _dir + "img/" + url.split('/')[-1] )