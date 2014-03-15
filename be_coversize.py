# Data imports
import json
import urllib
import ntpath
import unicodedata
import os
from os import listdir
import os.path
import pandas as pd

_file = 'color_memory.json'
_data = json.load( open( _file ) )

print len(_data["covers"])