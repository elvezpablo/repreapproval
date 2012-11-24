from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas

__author__ = 'paul.rangel'



class GeneratePDF(object):
    def setResponse(self, response):
        self.response = response
    def getPDF(self):
        self.response.headers['Content-Type'] = 'application/pdf'
        self.response.headers['Content-Disposition'] = 'attachment; filename=paul2.pdf'
        try:
            c = canvas.Canvas(self.response.out, pagesize=letter )
            # TODO: this throws an Internal Server Error on the dev server but it still works
            c.drawString(100, 300, "Hello paul")
            c.showPage()
            c.save()
        except ImportError:
            logging.warn("PDF Pringing error")

