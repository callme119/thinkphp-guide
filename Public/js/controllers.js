app.controller('checkboxCtrl', 
    ['$scope',
    function($scope){
        $scope.devList = [
        {text:"HTML5",checked:true},
        {text:"CSS3",checked:false},
        {text:"JavaScript",checked:false}
        ];

        $scope.pushNotificationChange = function() {
            console.log("changed", $scope.pushNotification.checked);
        };

        $scope.pushNotificaton = { checked: true};
        $scope.emailNotification = "Subscribed";
    }]);