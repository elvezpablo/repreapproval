__author__ = 'paul.rangel'

from google.appengine.ext import webapp

from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas

class Letters(webapp.RequestHandler):
    def get(self):
        self.response.headers['Content-Type'] = 'application/pdf'
        self.response.headers['Content-Disposition'] = 'attachment; filename=paul1.pdf'
        c = canvas.Canvas(self.response.out, pagesize=letter )
        c.drawString(100, 300, "Hello paul")
        c.showPage()
        c.save()