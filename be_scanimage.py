import struct
import Image
import scipy
import scipy.misc
import scipy.cluster
import json
import os
from os import listdir
import os.path

# Source for Code
# http://stackoverflow.com/questions/3241929/python-find-dominant-most-common-color-in-an-image

_dir         = 'exp-behance/wp-content/cache/img/'
_file        = '01162821265814847.gif'
_clusters    = 5
_colormemory = 'exp-behance-py/static/data/color_memory.json'
_hexcodes    = []
_data        = json.load( open( _colormemory ) ) if os.path.isfile( _colormemory ) else { "covers" : [{}] }

# print _data

for file in listdir( _dir ) :
	# try :

	# Check for Duplicates
	# duplicate = False
	# for cover in _data[ 'covers' ] :
	# 	# print file
	# 	# print cover[ 'name' ]
	# 	duplicate = True if str(cover[ 'name' ]) == str(file) else False
	# 	# print duplicate

	# if duplicate == True : # skip if we have it already
	# 	print 'skipping image ' + file
	# 	continue
	# else :

	print 'reading image ' + file
	im    = Image.open( _dir + file )
	ar    = scipy.misc.fromimage( im )
	shape = ar.shape

	try : # try to read it, if we can't skip it... usually occurs with gifs (perhaps absence of transparency)
		ar    = ar.reshape( scipy.product( shape[ :2 ] ) , shape[ 2 ] )
	except :
		print 'could not read ' + file + ', skipping.'
		_data['covers'][ 0 ][ file ] = ( { 'clusters' : False , 'freq' : False } )
		continue
	
	codes , dist = scipy.cluster.vq.kmeans( ar , _clusters )
	_hexcodes    = []
	for code in codes :
		_hexcodes.append( '' . join( chr( c ) for c in code ).encode( 'hex' ) )

	# print 'finding clusters'
	# print 'cluster centres:\n' , codes
	# print 'cluster centres:\n'
	# print _hexcodes
	
	####
	## 1. Assign Codes
	## 2. Count Occurrences
	vecs , dist   = scipy.cluster.vq.vq( ar , codes )     
	counts , bins = scipy.histogram( vecs , len( codes ) )
	
	####
	## Find Most Frequent Color
	index_max = scipy.argmax( counts )
	peak      = codes[ index_max ]
	color     = '' . join( chr( c ) for c in peak ).encode( 'hex' )
	_data[ 'covers' ][ 0 ][ file ] = ( { 'clusters' : _hexcodes , 'freq' : color } )
	
	print 'most frequent is %s (#%s)' % ( peak , color )
	print '_______________________________'

	# with open( _colormemory , 'w+' ) as outfile :	
	# 	json.dump( _data , outfile , indent = 4 )

	# except IOError as e :
	# 	print "I/O error({0}): {1}".format( e.errno, e.strerror )
	# 	continue

with open( _colormemory , 'w+' ) as outfile :	
	json.dump( _data , outfile , indent = 4 )








