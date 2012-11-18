from google.appengine.ext import db
from com.repreapproval.models.DictModel import DictModel

__author__ = 'paul.rangel'


class Letters(DictModel):
    max =  db.FloatProperty()
    min = db.FloatProperty()
    created = db.DateTimeProperty()
    expires = db.DateTimeProperty()
    address = db.PostalAddressProperty()