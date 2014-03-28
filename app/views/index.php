<!DOCTYPE html>
<html lang="en" ng-app="shoppingList">
  <head>
    <meta charset="utf-8">
    <title>AngularJS: Shopping List Application Demo</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
    <script src="//heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js"></script>
    <script src="js/app.js"></script>

  </head>

  <body>
  	<div class="container" ng-controller="ShopCtrl">
  		<h1>My Shopping List</h1>
  		<div class="main">
	  		<ul class="list-unstyled">
          <li id="loading"></li>
	  			<li ng-repeat="item in items">
	  				<input type="checkbox" id="item-{{item.id}}" ng-model="item.is_done" ng-change="toggleBought(item.id, item.is_done)">
	  				<label for="item-{{item.id}}" class="{{isBought(item.is_done)}}">{{item.name}}<span></span></label>
	  			</li>
	  		</ul>
	  		<form class="form-horizontal" ng-submit="addItem()">
	  			<input type="text" ng-model="itemEntry" ng-model-instant placeholder="Type and hit Enter to add item">
	  		</form>
	  	</div>

	  	<div class="footer">
	  		<button class="btn btn-lg btn-danger" ng-click="clearBought()">Remove Bought</button>
	  	</div>
  	</div>

    <script type="text/javascript">
      var cl = new CanvasLoader('loading');
      cl.setDiameter(100); // default is 40
      cl.setDensity(12); // default is 40
      cl.setRange(0.7); // default is 1.3
      cl.setSpeed(1); // default is 2
      cl.show(); // Hidden by default
    </script>
  </body>
</html>