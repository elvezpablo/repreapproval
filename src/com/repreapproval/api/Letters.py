from com.repreapproval.models.Letters import Letters

__author__ = 'paul.rangel'

from google.appengine.ext import webapp

from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas

class LettersList(webapp.RequestHandler):
    def get(self):
        hid = self.request.get('hid') # get the human requesting the info
        l = Letters.all();
        # get letters associated with the person requesting, validate human has permission
        l.filter("humans IN", hid)
        # TODO: get expired letters or not
        # TODO: list by created date
        pass

class LettersAdd(webapp.RequestHandler):
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


class LettersEdit(webapp.RequestHandler):
    def get(self):
        # TODO: validate data
        # TODO: validate permissions
        # agent can change max_price, expiration date and metadata

        # buyers can change address

        pass

class LettersDelete(webapp.RequestHandler):
    def get(self):
        # TODO: validate data
        # TODO: validate permissions
        pass




class GeneratePDF(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'application/pdf'
        self.response.headers['Content-Disposition'] = 'attachment; filename=paul1.pdf'
        c = canvas.Canvas(self.response.out, pagesize=letter )
        c.drawString(100, 300, "Hello paul")
        c.showPage()
        c.save()
