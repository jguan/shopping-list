var app = angular.module('shoppingList', ['SharedServices'] );

angular.module('SharedServices', [])
    .config(function ($httpProvider) {
        $httpProvider.responseInterceptors.push('myHttpInterceptor');
        var spinnerFunction = function (data, headersGetter) {
            // todo start the spinner here
            $('#loading').show();
            return data;
        };
        $httpProvider.defaults.transformRequest.push(spinnerFunction);
    })
	// register the interceptor as a service, intercepts ALL angular ajax http calls
    .factory('myHttpInterceptor', function ($q, $window) {
        return function (promise) {
            return promise.then(function (response) {
                // do something on success
                // todo hide the spinner
                $('#loading').hide();
                return response;

            }, function (response) {
                // do something on error
                // todo hide the spinner
                $('#loading').hide();
                return $q.reject(response);
            });
        };
    });

function ShopCtrl($scope, $http) {

	$http({ method: 'GET', url: '/shop/', cache: true }).
		success(function(data, status) {
			$scope.items = data;
		}).
		error(function(data, status) {
			console.log('Status: ' + status);
		});

	$scope.getTotalItems = function() {
		return $scope.items.length;
	};

	$scope.clearBought = function() {
		$scope.items = _.filter($scope.items, function(item) {
			if(item.is_done) {
				$http.delete('/shop/' + item.id).error(function(data, status) {
					console.log(status);
				});
			}
			return !item.is_done;
		});
	};

	$scope.addItem = function() {
		$http.post('/shop', { name: $scope.itemEntry } ).success(function(newItemID, status) {
			if(newItemID) {
				$scope.items.push({name: $scope.itemEntry, is_done: false, id: newItemID });
				$scope.itemEntry = '';
				console.log($scope.items);
			} else {
				console.log('There was a problem. Status: ' + status + '; Data: ' + data);
			}
		}).error(function(data, status) {
			console.log('status: ' + status);
		});
	};

	$scope.isBought = function(bought) {
		return (bought==1) ? 'bought' : 'not-bought';
	};

	$scope.itemSlug = function(text) {
		return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
	};

	$scope.toggleBought = function(id, bought) {
      $http.put('/shop/' + id, { is_done: bought } ).success(function(data, status) {
          if(data) {
              console.log($scope.items);
          } else {
              console.log('There was a problem. Status: ' + status + '; Data: ' + data);
          }
      }).error(function(data, status) {
          console.log('status: ' + status);
      });
};

}