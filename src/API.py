import logging

from google.appengine.api.datastore_errors import BadValueError
from google.appengine.ext import db
import webapp2
import Email

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
        # This is throwing an error now but it is working, also of note it's hiding the error on the live server
        generator = PDF.GeneratePDF()
        generator.setResponse(self.response)
        generator.getPDF()

def human_key_by_email(human_email):
    # https://developers.google.com/appengine/docs/python/gettingstartedpython27/usingdatastore
    return db.Key.from_path('Human', human_email)

class RequestAdd(webapp2.RequestHandler):
    def post(self):
        # dude
        # again
        # look for matching human by email
        requestEmail = self.request.get('requestEmail')
        humans = Models.Human.all()
        humans.filter('email =', requestEmail)
#        humans = db.GqlQuery("SELECT * "
#                            "FROM Human "
#                            "WHERE ANCESTOR IS :1 "
#                            "LIMIT 1",
#            human_key_by_email(requestEmail))

        for human in humans.run(limit=1):
            self.response.out.write("saving request since we found a matching human!")
            lr = Models.LetterRequest(parent=human)
            lr.price = float(self.request.get('requestPrice'))
            lr.email = self.request.get('requestEmail')
            lr.address = self.request.get('requestAddress')
            lr.put()
#        else:
#            self.response.out.write("no matching human by email in db for email :1",requestEmail)

            # if a human result,
            # then post a request referencing human.id

            # else
            # abort... bad email messaging

#        pass

class RequestList(webapp2.RequestHandler):
    def get(self):
        requests = Models.LetterRequest.all()
        response = Response.JSONResponse(self.response)
        response.setDictModel(requests)
        response.execute()


class HumansList(webapp2.RequestHandler):
    def get(self):
        humans = Models.Human.all()
        response = Response.JSONResponse(self.response)
        response.setDictModel(humans)
        response.execute()


class HumansAdd(webapp2.RequestHandler):
    def post(self):
        h = Models.Human()
        h.name = self.request.get('name')
        # TODO: generate temp password and send in email
        h.password = self.request.get('password')
        h.type = self.request.get('type')
        try:
            h.email = self.request.get('email')
            h.save()
        except BadValueError:
            logging.error("Email format is bad")
            pass

        # TODO: this throws an error that the email can't be set because the user isn't valid admin user has been added but app engine still doesn't like it, need to revisit
#        mailer = Email.SignUpMailer()
#        mailer.name = h.name
#        mailer.email = h.email
#        mailer.send()

        response = Response.JSONResponse(self.response)
        response.setDictModel(h)
        response.setMessage("Invite email sent!")
        response.execute()


class HumansEdit(webapp2.RequestHandler):
    def post(self):
        pass

class HumansDelete(webapp2.RequestHandler):
    def post(self):
        pass


