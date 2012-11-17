from google.appengine.ext import db

__author__ = 'paul.rangel'


class Letters(db.Model):
    max =  db.FloatProperty()
    min = db.FloatProperty()
    created = db.DateTimeProperty()
    expires = db.DateTimeProperty()
    address = db.PostalAddressProperty()