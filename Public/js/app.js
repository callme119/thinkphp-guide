var app = angular.module('yunzhiclub', ['ionic']);

app.constant('$ionicLoadingConfig', {
    template: 'Default Loading ......'
});

app.controller('MyCtrl' , function($scope, $ionicModal){
    $ionicModal.fromTemplateUrl('my-modal.html',{
        scope: $scope,
        animation: 'slide-in-up'
    }).then(function(modal){
        $scope.modal = modal;
    });

    $scope.openModal = function(){
        $scope.modal.show();
    };

    $scope.closeModal = function(){
        $scope.modal.hide();
    };
});