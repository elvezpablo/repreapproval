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
    email = db.EmailProperty()
    type = db.StringProperty() #  Agent, Realtor, Buyer

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


class Meta(DictModel):
    record = db.ReferenceProperty()
    name = db.StringProperty()
    value = db.StringProperty()