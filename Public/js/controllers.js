app.controller('refreshCtrl', 
    ['$scope', '$timeout', function($scope, $timeout){
        //为前面绑定数据
        $scope.items = [
        {name:"shijiangcheng"},
        {name:"xingyannian"},
        {name:"panjie"},
        ];

        //定义doRefresh函数
        $scope.doRefresh = function(){
            //未使用HTTP，在这，延迟2S，模拟GET操作。
            $timeout(function(){}, 2000).then(function(){
                $scope.items.push({name:"xulinjie"});
                $scope.$broadcast('scroll.refreshComplete');
            });
        }
}])