import collections
import simplejson

__author__ = 'paul.rangel'

class JSONResponse(object):

    def __init__(self, response, dictModel):
        self.setResponse(response)
        self.setDictModel(dictModel)
        self.json = [{
            "version" : "1",
            "data" : [],

        }]

    def setResponse(self, response):
        self.response = response

    def setDictModel(self, dictModel):
        self.dictModel = dictModel

    def getData(self):
        if isinstance(self.dictModel, collections.Iterable):
            return [h.to_dict() for h in self.dictModel]
        else:
            return [self.dictModel.to_dict()]

    def execute(self):
        self.json[0]["data"] = self.getData()
        self.response.headers['Content-Type'] = 'application/json'
        self.response.out.write(simplejson.dumps(self.json))


