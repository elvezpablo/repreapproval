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