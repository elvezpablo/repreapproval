from google.appengine.ext import db

__author__ = 'paul.rangel'


class Meta(db.Model):
    letter = db.Key()
    key = db.StringProperty()
    value = db.StringProperty()