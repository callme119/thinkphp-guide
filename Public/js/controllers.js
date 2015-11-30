

app.config(function($stateProvider, $urlRouterProvider){
    $stateProvider
    .state('tabs',
    {
        url: "/tab",
        abstract: true,
        templateUrl: "templates/tabs.html"
    })
    .state("tabs.about",{
        url: "/about",
        views:{
            "about-tab":{
                templateUrl: "templates/about.html"
            }
        }
    })
    .state('tabs.home',{
        url: "/home",
        views:{
            'home-tab':{
                templateUrl: "templates/home.html",
                controller: "HomeTabCtrl"
            }
        }
    })
    .state("tabs.facts",{
        url: "/facts",
        views: {
            "home-tab":{
                templateUrl: "templates/facts.html"
            }
        }
    })
    .state("tabs.facts2",{
        url: "/fact2",
        views:{
            'home-tab':{
                templateUrl: "templates/facts2.html"
            }
        }
    })

    .state('tabs.navstack', {
          url: "/navstack",
          views: {
            'about-tab': {
              templateUrl: "templates/nav-stack.html"
            }
          }
        })
        .state('tabs.contact', {
          url: "/contact",
          views: {
            'contact-tab': {
              templateUrl: "templates/contact.html"
            }
          }
        });
       $urlRouterProvider.otherwise("/tab/about");
});

app.controller("HomeTabCtrl", ['$scope', function(){
    console.log('HomeTabCtrl');
}]);