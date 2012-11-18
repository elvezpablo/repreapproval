from google.appengine.ext import db
from com.repreapproval.models.DictModel import DictModel

__author__ = 'paul.rangel'


class Meta(DictModel):
    record = db.ReferenceProperty()
    key = db.StringProperty()
    value = db.StringProperty()