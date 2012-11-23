#!/usr/bin/env python
import sys
from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app
from com.repreapproval.views.Dev import Dev

from com.repreapproval.views.Home import Home
from com.repreapproval.api.Letters import Letters
from com.repreapproval.api.Humans import HumansList, HumansAdd, HumansEdit, HumansDelete


sys.path.insert(0, '../libs/reportlab.zip')

from reportlab.pdfgen import canvas

application = webapp.WSGIApplication(
    [
        ('/api/v[0-9]/humans/add', HumansAdd),
        ('/api/v[0-9]/humans/edit', HumansEdit),
        ('/api/v[0-9]/humans/delete', HumansDelete),
        ('/api/v[0-9]/humans/*', HumansList),
        ('/api/v[0-9]/letters/*', Letters),
        ('/api/v[0-9]/letters/*', Letters),
        ('/dev', Dev),
        ('/', Home)],
    debug=True)

def main():
    run_wsgi_app(application)

if __name__ == "__main__":
    main()