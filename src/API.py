import logging

from google.appengine.api.datastore_errors import BadValueError
import webapp2


import Models
import PDF
import Response

__author__ = 'paul.rangel'

class LettersList(webapp2.RequestHandler):
    def get(self):
        hid = self.request.get('hid') # get the human requesting the info
        l = Models.Letters.all();
        # get letters associated with the person requesting, validate human has permission
        l.filter("humans IN", hid)
        # TODO: get expired letters or not
        # TODO: list by created date
        pass

class LettersAdd(webapp2.RequestHandler):
    def get(self):
        arguments = self.request.arguments()
        # agent must add the max price and expiration
        # optionally they can add the remaining
        required = ['max_price','expiration', 'agent', 'buyer']
        optional = ['requested_price', ]

        # TODO: validate data
        self.request.get
        # TODO: validate permissions
        pass


class LettersEdit(webapp2.RequestHandler):
    def get(self):
        # TODO: validate data
        # TODO: validate permissions
        # agent can change max_price, expiration date and metadata

        # buyers can change address

        pass

class LettersDelete(webapp2.RequestHandler):
    def get(self):
        # TODO: validate data
        # TODO: validate permissions
        pass

class LettersPrint(webapp2.RequestHandler):
    def get(self):
        # TODO: validate data
        # TODO: validate permissions
        generator = PDF.GeneratePDF()
        generator.setResponse(self.response)
        generator.getPDF()


class HumansList(webapp2.RequestHandler):
    def get(self):
        humans = Models.Human.all()
        response = Response.JSONResponse(self.response,humans)
        logging.debug("bro")
        response.execute()


class HumansAdd(webapp2.RequestHandler):
    def get(self):
        h = Models.Human()

        h.name = self.request.get('name')
        h.type = self.request.get('type')
        try:
            h.email = self.request.get('email')
            h.save()
        except BadValueError:
            logging.error("Email format is bad")
            pass

        response = Response.JSONResponse(self.response,h)
        response.execute()


class HumansEdit(webapp2.RequestHandler):
    def post(self):
        pass

class HumansDelete(webapp2.RequestHandler):
    def post(self):
        pass


