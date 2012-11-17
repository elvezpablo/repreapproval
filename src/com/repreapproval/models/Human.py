from google.appengine.ext import db

__author__ = 'paul.rangel'

class Human(db.Model):
    fullname = db.StringProperty()
    email = db.EmailProperty()
    type = db.StringListProperty(required=True) #  Agent, Realtor, Buyer

