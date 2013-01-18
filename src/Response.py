import collections
import json

__author__ = 'paul.rangel'

class JSONResponse(object):

    def __init__(self, response):
        self.setResponse(response)
        self.json = [{
            "version" : "1",
            "data" : [],

        }]
        self.message = None

    def setResponse(self, response):
        self.response = response

    def setDictModel(self, dictModel):
        self.dictModel = dictModel

    def setMessage(self, message):
        self.message = message

    def getData(self):
        if isinstance(self.dictModel, collections.Iterable):
            return [h.to_dict() for h in self.dictModel]
        else:
            return [self.dictModel.to_dict()]

    def execute(self):
        if self.message is not None:
            self.json[0]["message"] = self.message
        self.json[0]["data"] = self.getData()

        self.response.headers['Content-Type'] = 'application/json'
        self.response.out.write(json.dumps(self.json,False,True,True,True,None,5))


