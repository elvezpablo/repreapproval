from google.appengine._internal.django.utils import simplejson
from google.appengine.api.datastore_errors import BadValueError
from com.repreapproval.models.Human import Human

__author__ = 'paul.rangel'

from google.appengine.ext import webapp

class HumansList(webapp.RequestHandler):
    def get(self):
        humans = Human.all()
        self.response.headers['Content-Type'] = 'application/json'
        self.response.out.write(simplejson.dumps([h.to_dict() for h in humans]))

class HumansAdd(webapp.RequestHandler):
    def get(self):
        h = Human()

        h.name = self.request.get('name')
        h.type = self.request.get('type')
        try:
            h.email = self.request.get('email')
            h.save()
        except BadValueError:
            pass

        self.response.headers['Content-Type'] = 'application/json'
        self.response.out.write(simplejson.dumps([h.to_dict()]))


class HumansEdit(webapp.RequestHandler):
    def post(self):
        pass

class HumansDelete(webapp.RequestHandler):
    def post(self):
        pass


class HumansResponse(object):

    def setResponse(self, response):
        self.response = response