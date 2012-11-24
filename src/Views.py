import os

import Models


__author__ = 'paul.rangel'

import webapp2
import jinja2

jinja_environment = jinja2.Environment(loader=jinja2.FileSystemLoader(os.path.dirname("templates/")))

class Home(webapp2.RequestHandler):
    def get(self):
        humans = Models.Human.all()
        template_values = {
            'humans' : humans
        }
        template = jinja_environment.get_template('index.html')
        self.response.out.write(template.render(template_values))

class Dev(webapp2.RequestHandler):
    def get(self):
        humans = Models.Human.all()
        template_values = {
            'humans' : humans
        }

        template = jinja_environment.get_template('dev.html')
        self.response.out.write(template.render(template_values))