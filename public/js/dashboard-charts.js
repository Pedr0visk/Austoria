/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/dashboard-charts.js":
/*!******************************************!*\
  !*** ./resources/js/dashboard-charts.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function () {
  var charts = {
    init: function init() {
      charts.ajaxGetSaleMonthlyData();
      charts.ajaxGetSaledItemsData();
      charts.ajaxGetPaymentsData();
    },
    ajaxGetPaymentsData: function ajaxGetPaymentsData(type) {
      type = 'month';
      var urlPath = window.location.origin + '/api/metrics/payments/' + type;
      var request = $.ajax({
        method: 'GET',
        url: urlPath
      });
      request.done(function (response) {
        charts.createPaymentMetricsChart(response);
      });
    },
    ajaxGetSaleMonthlyData: function ajaxGetSaleMonthlyData() {
      var date = new Date();
      var year = date.getFullYear();
      var urlPath = window.location.origin + '/api/metrics/sales/' + year;
      var request = $.ajax({
        method: 'GET',
        url: urlPath
      });
      request.done(function (response) {
        charts.createMetricsSalesChart(response);
      });
    },
    ajaxGetSaledItemsData: function ajaxGetSaledItemsData() {
      var date = new Date();
      var year = date.getFullYear();
      var urlPath = window.location.origin + '/api/metrics/sale-items';
      var request = $.ajax({
        method: 'GET',
        url: urlPath
      });
      request.done(function (response) {
        console.log(response);
        charts.createProductSaledChart(response);
      });
    },
    createPaymentMetricsChart: function createPaymentMetricsChart(response) {
      var ctx = document.getElementById('paymentChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: response.methods,
          datasets: [{
            label: '# ',
            data: response.payments,
            backgroundColor: ['rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)', 'rgba(54, 162, 235, 0.4)', 'rgba(255, 99, 132, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)'],
            borderColor: ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              time: {
                unit: 'date'
              },
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    },
    createProductSaledChart: function createProductSaledChart(response) {
      var ctx = document.getElementById('productsSaledChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: response.names,
          datasets: [{
            label: '# ',
            data: response.items_saled_quantity,
            backgroundColor: ['rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)', 'rgba(54, 162, 235, 0.4)', 'rgba(255, 99, 132, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)'],
            borderColor: ['rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              time: {
                unit: 'date'
              },
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    },
    createMetricsSalesChart: function createMetricsSalesChart(response) {
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: response.months,
          datasets: [{
            label: '# caixa mensal',
            data: response.total_amount_data,
            backgroundColor: ['rgba(54, 162, 235, 0.4)', 'rgba(255, 99, 132, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)', 'rgba(54, 162, 235, 0.4)', 'rgba(255, 99, 132, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(75, 192, 192, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(255, 159, 64, 0.4)'],
            borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              time: {
                unit: 'date'
              },
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    }
  };
  charts.init();
})();

/***/ }),

/***/ 1:
/*!************************************************!*\
  !*** multi ./resources/js/dashboard-charts.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/nilcelia/Documents/Projetos/Astoria/resources/js/dashboard-charts.js */"./resources/js/dashboard-charts.js");


/***/ })

/******/ });