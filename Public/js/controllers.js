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

app.controller('MyCtrl', 
    ['$scope', 
    '$ionicGesture', 
    function($scope, $ionicGesture){
    $scope.lastEventCall = "请尝试在主体内容上进行拖拽";
    var events = [
        {event: "dragup",text:"触发了向上拖拽"},
        {event: "dragdown",text:"触发了向下拖拽"},
        {event: "dragleft",text:"触发了向左拖拽"},
        {event: "dragright",text:"触发了向右拖拽"},
        {event: "swipeup",text:"触发了向上滑动"},
        {event: "swipedown",text:"触发了向下滑动"},
        {event: "swipeleft",text:"触发了向左滑动"},
        {event: "swiperight",text:"触发了向右滑动"}
        ];

    var element = angular.element(document.querySelector("#eventPlaceholder"));
    angular.forEach(events, function(value, key){
            $ionicGesture.on(value.event, function(event){
                $scope.$apply(function(){
                    $scope.lastEventCall = value.text;
                });
            },element);
    });
}])