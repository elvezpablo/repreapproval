import os
from google.appengine.ext.webapp import template
from google.appengine.ext import webapp
from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas
from Models import Human, Letters

__author__ = 'paul.rangel'

class Home(webapp.RequestHandler):
    def get(self):
        template_dir = "../templates/"
        humans = Human.all()
        template_values = {
            'humans' : humans
        }
        path = os.path.join(os.path.dirname(template_dir), 'index.html')
        self.response.out.write(template.render(path, template_values))

class Dev(webapp.RequestHandler):
    def get(self):
        template_dir = "../templates/"
        humans = Human.all()
        template_values = {
            'humans' : humans
        }
        path = os.path.join(os.path.dirname(template_dir), 'dev.html')
        self.response.out.write(template.render(path, template_values))



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