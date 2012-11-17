#!/usr/bin/env python
import sys

sys.path.insert(0, '../libs/reportlab.zip')

import reportlab
import reportlab.pdfbase.pdfmetrics
from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas
from reportlab.pdfbase import pdfmetrics

from google.appengine.ext import webapp
from google.appengine.ext.webapp.util import run_wsgi_app


"""
a change
"""

class PdfPage(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'application/pdf'
        self.response.headers['Content-Disposition'] = 'attachment; filename=paul1.pdf'
        c = canvas.Canvas(self.response.out, pagesize=letter )
        c.drawString(100, 300, "Hello paul")
        c.showPage()
        c.save()


class Home(webapp.RequestHandler):
    def get(self):
        print 'Content-Type: text/plain'
        print ''
        print 'Hello, world!'


application = webapp.WSGIApplication(
    [('/pdf',PdfPage),('/', Home)],
    debug=True)

def main():
    run_wsgi_app(application)

if __name__ == "__main__":
    main()