from google.appengine.ext import db

__author__ = 'paul.rangel'

'''
    This is for json conversion of models
    see:

    http://stackoverflow.com/questions/1531501/json-serialization-of-google-app-engine-models

'''

class DictModel(db.Model):
    def to_dict(self):
        return dict([(p, unicode(getattr(self, p))) for p in self.properties()])

class Human(DictModel):
    name = db.StringProperty()
    password = db.StringProperty()
    email = db.EmailProperty() # make unique
    type = db.StringProperty() # Agent, Realtor, Buyer
    agent = db.Key() # if you are a buyer, you MUST have an agent/realtor/whatever we call it - 'agent' in the db case  --> store this as a key ... so on a form in admin where an agent adds a client/buyer, it will automatically use an agent key to fill out a client.agent

class Letters(DictModel):
    approvedPrice =  db.FloatProperty()
    created = db.DateTimeProperty()
    printed = db.DateTimeProperty()
    expires = db.DateTimeProperty()
    address = db.PostalAddressProperty()
    humanId = db.ListProperty(db.Key)
    letterRequestId = db.ListProperty(db.Key)

class LetterRequest(DictModel):
    price = db.FloatProperty()
    address = db.PostalAddressProperty()
    date = db.DateTimeProperty()
#    humanId = db.ListProperty(db.Key) no need to store human key as this model is a child of human model in googleAppEngine DB (should work? - double check)
    approved = db.BooleanProperty()

class Meta(DictModel):
    record = db.ReferenceProperty()
    name = db.StringProperty()
    value = db.StringProperty()