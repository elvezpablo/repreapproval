import logging

__author__ = 'paul.rangel'

from google.appengine.api import mail

class SignUpMailer(object):
    def __init__(self):
        self.name = None
        self.email = None

    def send(self):
        self.m = mail.EmailMessage()
        # this is set in the Permission of the appengine admin console
        self.m.sender = "Support <prangel@gmail.com>"
        self.m.to = self.email
        self.m.subject = "You have been signed up!"
        self.m.body = """
        Welcome %s !

        You have been signed up for the life changing repreapprval.com

        """ % self.name
        logging.log("sent!")
        self.m.send()
