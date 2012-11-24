#!/usr/bin/env python
import os
import sys

from API import HumansAdd, HumansEdit, HumansDelete, HumansList
from Views import Dev, Home

from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app

application = webapp.WSGIApplication(
    [
        ('/api/v[0-9]/humans/add', HumansAdd),
        ('/api/v[0-9]/humans/edit', HumansEdit),
        ('/api/v[0-9]/humans/delete', HumansDelete),
        ('/api/v[0-9]/humans/*', HumansList),
        #('/api/v[0-9]/letters/*', Letters),
        #('/api/v[0-9]/letters/*', Letters),
        ('/dev', Dev),
        ('/', Home)],
    debug=True)

def main():
    run_wsgi_app(application)

if __name__ == "__main__":
    sys.path.insert(0, '/libs/reportlab.zip')
    sys.path.append(os.path.join(os.path.dirname(__file__), 'src'))
    main()