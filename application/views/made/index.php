<!DOCTYPE html>
<html ng-app>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>Angular JS</title>
<link type="text/css" rel="stylesheet" href="/static/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-beta.10/angular.min.js"></script>
<!-- script src="/static/js/angular/cookies.js"></script>
<script src="/static/js/angular/resource.js"></script -->
<script>
var todoList = [
    { done : true, title : "Angular First" },
    { done : false, title : "Angular Second" },
    { done : false, title : "Angular Third" },
];

function todoCtrl($scope) {
    $scope.appsName = "Angular JS ToDoList";
    $scope.todoList = todoList;
    $scope.addNewToDo = function(newTitle) {
        todoList.push({ done : false, title : newTitle });
        $scope.newTitle = '';
    }
    $scope.archive = function() {
        for(var i=$scope.todoList.length-1; i>=0; i--) {
            if($scope.todoList[i].done) {
                $scope.todoList.splice(i,1);
            }
        }
    }
    $scope.remain = function() {
        var remaincnt = 0;
        /*for(var i=$scope.todoList.length-1; i>=0; i--) {
            if(!$scope.todoList[i].done) {
                remaincnt++;
            }
        }*/
        angular.forEach($scope.todoList, function(value, key) {
            if(value.done === false) remaincnt++;
        });

        return remaincnt;
    }
}
</script>
</head>

<div>
<body class="well" ng-controller="todoCtrl">
<h1>{{appsName}}</h1>

<p>전체할일 {{todoList.length}}건 | 남은할일 {{remain()}}건 [ <a href="" ng-click="archive()">보관하기</a> ]</p>

<ul class="list-unstyled">
    <li ng-repeat="todo in todoList" class="checkbox">
        <input type="checkbox" ng-model="todo.done">{{todo.title}}
    </li>
</ul>
<ul class="list-unstyled">
    <li class="checkbox"><input type="checkbox"> angular js study</li>
    <li class="checkbox"><input type="checkbox"> angular js testing</li>
</ul>

<form action="" name="angForm" class="form-inline">
    <div class="form-group">
        <label class="sr-only" for="angItem">새로등록</label>
        <input type="text" class="form-control" name="angItem" placeholder="새로운 거 등록" ng-model="newTitle">
    </div>
    <button type="submit" class="btn btn-success" ng-click="addNewToDo(newTitle)">등록</button>
</form>
</body>
</html>
