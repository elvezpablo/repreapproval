/**
 *
 * User: paul.rangel
 * Date: 11/24/12
 * Time: 7:22 AM
 *
 */

var App = Ember.Application.create();

App.ApplicationController = Ember.Controller.extend();
App.ApplicationView = Ember.View.extend({
    templateName: 'application'
});

App.Router = Ember.Router.extend({
    root: Ember.Route.extend({
        index: Ember.Route.extend({
            route: '/'
        })
    })
});

App.initialize();