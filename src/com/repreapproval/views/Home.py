__author__ = 'paul.rangel'

from google.appengine.ext import webapp

class Home(webapp.RequestHandler):
    def get(self):
        print 'Content-Type: text/plain'
        print ''
        print 'Hello, world!'