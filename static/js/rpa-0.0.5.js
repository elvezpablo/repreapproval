window.RPA = Ember.Application.create({
    VERSION: "0.0.5"
});
// holds the app test data
RPA.AppData = {};

RPA.ready = function() {
    console.log("RePreApproval VERSION: "+RPA.VERSION);
};


RPA.Router.map(function() {

    this.route("create", { path: "/create" });
    this.route("request", { path: "/request" });
    this.route("logout", { path: "/logout" });
    this.route("details", { path: "/details" });
    this.route("profile", { path: "/profile/:user_id" });
});



RPA.ApplicationController = Ember.Controller.extend({
    loggedIn : true

});

RPA.ApplicationRoute = Ember.Route.extend({
    model : function() {
        console.log("ApplicationRoute");
        return RPA.ProfileGenerator();
    },
    setupController : function(controller, profile) {
        console.log("ApplicationRoute: "+profile);
        controller.set('profile', profile );
    }
});

/**
 * Index
 */


RPA.IndexController = Ember.Controller.extend({
    currentTip : 0,
    currentText : function() {
        var tips = this.get('tips')
        return tips[this.get("currentTip")].text;
    }.property('content.currentText'),
    nextTip : function() {
        var current = this.get("currentTip"),
            tips = this.get("tips"), next;

    },
    previousTip : function() {
      var current = this.get("currentTip");  
    }


});

RPA.IndexRoute = Ember.Route.extend({
    model : function() {
        return {
            tips : RPA.AppData.getTips(),
            testimonials : ["a", "b"]
        };            
    },
    setupController : function(controller, model) {
        console.log("IndexRoute: ");
        console.log(model);
        controller.set('tips', model.tips );
        controller.set('testimonials', model.testimonials );        
    }
});


RPA.LoginRoute = Ember.Route.extend({
    model: function() {
        return RPA.AppData.getTips();
    },
    setupController: function(controller, profile) {
        console.log("LoginRoute: "+profile);
        controller.set('profile', profile);
    }
});


RPA.LoginView = Ember.View.create({
    templateName: "login"
});


RPA.TipModel = Ember.Object.extend({
    text : "",
    author : "",
    title : ""
});

RPA.TipsView = Ember.View.create({
    templateName: "tips"
});



RPA.AppData.getTips = function() {
    var tips = [
        {
            text : "Welcome to RePreApproval if this is your first time here we suggest that you watch our intro video. Don't worry it is quick an will get you up and running in no time!",
            author : "",
            title : ""
        },
        {
            text : "dude",
            author : "",
            title : ""
        },
        {
            text : "3",
            author : "",
            title : ""
        },
        {
            text : "4",
            author : "",
            title : ""
        }
    ];

    return tips.map(function(tip) {
        return RPA.TipModel.create(tip);
    });
    
}

/**
 * Profile
 */

RPA.ProfileController = Ember.Controller.extend({
    setupController: function(controller, profile) {
        console.log(profile);
        controller.set('profile', profile);
    }
});


RPA.ProfileModel = Ember.Object.extend({
    firstName : "",
    lastName : "",
    fullName : function() {
        var firstName = this.get('firstName'),
            lastName = this.get('lastName');
        return firstName+" "+lastName;
    }.property('firstName', 'lastName'),
    userId : -1

});

RPA.ProfilesRoute = Ember.Route.extend({
    model: function(params) {
        console.log(params.user_id);
        return  RPA.ProfileGenerator();
    }
});


RPA.ProfileGenerator = function() {
    return RPA.ProfileModel.create({
        firstName : "Joe",
        lastName : "Shmoe",
        id : 100
    })
};



/**
 * Create
 */
RPA.CreateController = Ember.Controller.extend({
    title : "One title"
});

RPA.CreateRoute = Ember.Route.extend({
    setUpController : function(controller, data) {
        controller.set('content',data );
    }
});
/**
 * Request
 */
RPA.RequestController = Ember.Controller.extend({
    title : "Two title"
});

RPA.RequestRoute = Ember.Route.extend({
    setUpController : function(controller, data) {
        controller.set('content',data );
    }
});
