# Flask imports

import sys

from flask import Flask, url_for, render_template

# from flaskext.flatpages import FlatPages
# from flask_frozen import Freezer

# DEBUG = True
# FLATPAGES_AUTO_RELOAD = DEBUG
# FLATPAGES_EXTENSION = '.html'

app = Flask(__name__)
# freezer = Freezer(app)


@app.route( '/behance-stats-comparison' )
def hello_world() :
	return render_template( 'exp-behance.html' )

@app.route( '/behance-presentation' )
def presentation() :
	return render_template( 'exp-behance-presentation.html' )

with app.test_request_context() :
	# print url_for('static',filename='lib/farbtastic/farbtastic.css')
	# print url_for('static',filename='css/grid.css')
	# print url_for('static',filename='css/forms.css')
	print url_for('static',filename='css/main.css')
	print url_for('static',filename='css/main.min.css')
	print url_for('static',filename='js/vendor/isotope.pkgd.min.js')
	print url_for('static',filename='js/vendor/jquery.xcolor.min.js')
	print url_for('static',filename='js/vendor/jquery-1.11.0.min.js')
	print url_for('static',filename='js/vendor/modernizr-2.7.0.min.js')
	print url_for('static',filename='js/vendor/raphael-min.js')
	print url_for('static',filename='js/vendor/morris-0.4.3.min.js')
	print url_for('static',filename='js/main.js')
	print url_for('static',filename='data/color_memory.json')
	print url_for('static',filename='data/hist_memory.json')

if __name__ == '__main__' :
	# app.debug = True
	# if len(sys.argv) > 1 and sys.argv[1] == "build":
	# 	freezer.freeze()
	# else:
	# 	app.run( debug = True )
	app.run( debug = True )
