from google.appengine.ext import db
from com.repreapproval.models.DictModel import DictModel

__author__ = 'paul.rangel'



class Letters(DictModel):
    max_price =  db.FloatProperty()
    requests = db.ListProperty(db.Key)
    created = db.DateTimeProperty()
    printed = db.DateTimeProperty()
    expires = db.DateTimeProperty()
    address = db.PostalAddressProperty()
    humans = db.ListProperty(db.Key)


class LetterRequest(DictModel):
    price = db.FloatProperty()
    date = db.DateTimeProperty()
