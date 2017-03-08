var congressApp = angular.module('congressApp', ['angularUtils.directives.dirPagination', 'ngAnimate', 'ngSanitize', 'ui.bootstrap']);

function myController($scope, $http) {
    // $scope.sort1=state_name;
    $scope.currentPage = 1;
    // $scope.currentPage2 = 1;
    // $scope.currentPage3 = 1;
    $scope.pageSize = 10;
    $http({
        method: 'GET',
        url: "http://localhost/backend.php?scope=state",
    }).then(function successCallback(response) {
        // console.log("response is ");
        // console.log(response);
        $scope.results = response.data.results;
        $scope.total = response.data.results.length;
    }, function errorCallback(response) {
        alert("error message: " + response);
    });
    $scope.getDetails = function(bioguide_id) {
        $http({
            method: 'GET',
            url: "http://localhost/backend.php?bioguide_id=" + bioguide_id
        }).then(function successCallback(response) {
                $scope.detail = JSON.parse(response.data.personal_info).results[0];
                $scope.top5committees = JSON.parse(response.data.top5com).results;
                $scope.sponsored_bills = JSON.parse(response.data.bills).results;
                $scope.today = new Date();
                $scope.term_start = new Date($scope.detail.term_start);
                $scope.term_end = new Date($scope.detail.term_end);
                $scope.term_percentage = Math.round(($scope.today - $scope.term_start) / ($scope.term_end - $scope.term_start) * 100);
            },
            function errorCallback(response) {
                alert("error message: " + response);
            });
    }


    $http({
        method: 'GET',
        url: "http://localhost/backend.php?bills=" + true,
    }).then(function successCallback(response) {
            $scope.active_bills = JSON.parse(response.data.active_bills).results;
            $scope.new_bills = JSON.parse(response.data.new_bills).results;
        },
        function errorCallback(response) {
            alert("error message: " + response);
        });

    $scope.getBillDetails = function(bill_id) {
        $http({
            method: 'GET',
            url: "http://localhost/backend.php?bill_id=" + bill_id
        }).then(function successCallback(response) {
                $scope.bill_details = response.data.results[0];
            },
            function errorCallback(response) {
                alert("error message: " + response);
            });
    }

    $http({
        method: 'GET',
        url: "http://localhost/backend.php?committees=" + true,
    }).then(function successCallback(response) {
            $scope.all_committees = response.data.results;
        },
        function errorCallback(response) {
            alert("error message: " + response);
        });


    $scope.favorite_legislators = JSON.parse(localStorage.getItem('legislators'));
    $scope.favorite_bills = JSON.parse(localStorage.getItem('bills'));
    $scope.favorite_committees = JSON.parse(localStorage.getItem('committees'));
    // console.log($scope.favorite_committees);

    $scope.parse_json = function(json_str) {
        return JSON.parse(json_str);
    }

    $scope.addToFavorite = function(type, key, json_obj) {
        // localStorage.clear();
        // type 1 legislators
        // type 2 bills
        // type 3 committees
        if (typeof(Storage) !== "undefined") {
            var json_str = JSON.stringify(json_obj);
            // parse json string to obj
            var retrived = JSON.parse(localStorage.getItem(type));
            if (retrived == null) {
                var retrived = {};
            }
            retrived[key] = json_str;
            localStorage.setItem(type, JSON.stringify(retrived));
            $scope.favorite_legislators = JSON.parse(localStorage.getItem('legislators'));
            $scope.favorite_bills = JSON.parse(localStorage.getItem('bills'));
            $scope.favorite_committees = JSON.parse(localStorage.getItem('committees'));
        } else {
            alert("Sorry, your browser does not support Web Storage...");
        }

    }

    $scope.containsItem = function(type, key) {
        if (typeof(Storage) !== "undefined") {
            if (localStorage.getItem(type) == null) {
                value = null
            } else {
                var retrived = JSON.parse(localStorage.getItem(type));
                var value = retrived[key];
            }
            if (value != null) {
                // console.log("true returned")
                return true;
            } else {
                // console.log("false returned")
                return false;
            }
        } else {

        }
    }

    $scope.removeFromFavorite = function(type, key) {
        if (typeof(Storage) !== "undefined") {
            var retrived = JSON.parse(localStorage.getItem(type));
            delete retrived[key];
            localStorage.setItem(type, JSON.stringify(retrived));
            $scope.favorite_legislators = JSON.parse(localStorage.getItem('legislators'));
            $scope.favorite_bills = JSON.parse(localStorage.getItem('bills'));
            $scope.favorite_committees = JSON.parse(localStorage.getItem('committees'));
        } else {
            alert("Sorry, your browser does not support Web Storage...");
        }
    }
}

function OtherController($scope) {
    $scope.PageChangeHandler = function(num) {
        console.log("Page changed to" + num);
    };
}

congressApp.controller('myController', myController);
congressApp.controller('OtherController', OtherController);

$(document).ready(function() {
    $("#navbar_toggle").click(function() {
        $("#navbar").toggle();
    });
});

function changeTab(tab_name) {
    // console.log("tab name is " + tab_name);
    if (tab_name == 'legislators') {
        $('#legi_tab').tab('show');
    } else if (tab_name == 'bills') {
        $('#bill_tab').tab('show');
    } else if (tab_name == 'committees') {
        $('#com_tab').tab('show');
    }
}

// $(document).ready(function() {
//     $("#btntest").click(function() {
//         $('#myNavbar ul li:eq(0) a').tab('show');
//         $('#D000626').click();
//     });
// });
