angular.module('ngAppMain', [])
    .config(appconfig)
    .controller('Ctrl', ['$scope','$http', function($scope, $http) {
        $scope.short_link = '';
        $scope.full_link = '';
        $scope.date = '';
        $scope.link_created = false;
        $scope.error = false;
        $scope.save_link = '';

        //отправляем данные
        $scope.sendLink = function() {
            if ($scope.full_link == '' ||
                $scope.short_link == '' ||
                $scope.save_link == ''
            ) {
                return;
            }

            $http.post($scope.save_link, {
                short_link: $scope.short_link,
                date: $scope.date,
                full_link: $scope.full_link
            }).then(function successCallback(response) {
                $scope.link_created = true;
                console.log('data:', response);

            }, function errorCallback(response) {
                $scope.error = response;
                console.error('Нет связи с сервером.', response);
            });
        };
    }]);

appconfig.$inject = ['$httpProvider'];
function appconfig($httpProvider){
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.common['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content');
}