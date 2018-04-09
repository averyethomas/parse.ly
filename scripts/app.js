var app = angular.module('angularApp', []);

app.controller('parselyCtrl', ['$scope', '$http', function ($scope, $http) {
    
    var apiKey = 'texasmonthly.com';
    var accessToken = 'J44znyy0vsL7tsYzacxIjtVZhQA4uT8kQqN2ZK72Sko';

    var URL = 'https://api.parsely.com/v2/analytics/posts?apikey=' + apiKey +'&secret=' + accessToken + '&page=1&limit=10&sort=views&period_start=24h'
    $scope.topPosts = [];

    $scope.getPosts = function(){
        $http({
            method: 'GET',
            url: URL,
        }).
            success(function(data, status, headers, config){
                $scope.topPosts = data.data;
        }).
            error(function(data, status, headers, config){
                console.log('There was an error. No posts available.');
            });
    };
    
    $scope.getPosts();
    
}]);