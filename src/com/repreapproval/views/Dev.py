import os
from google.appengine.ext.webapp import template
from com.repreapproval.models.Human import Human


__author__ = 'paul.rangel'

from google.appengine.ext import webapp

class Dev(webapp.RequestHandler):
    def get(self):
        template_dir = "../templates/"
        humans = Human.all()
        template_values = {
            'humans' : humans
        }
        path = os.path.join(os.path.dirname(template_dir), 'dev.html')
        self.response.out.write(template.render(path, template_values))