from google.appengine.ext import db
from com.repreapproval.models.DictModel import DictModel

__author__ = 'paul.rangel'

class Human(DictModel):
    name = db.StringProperty()
    password = db.StringProperty()
    email = db.EmailProperty()
    type = db.StringProperty() #  Agent, Realtor, Buyer

