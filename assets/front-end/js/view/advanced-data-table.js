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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/view/advanced-data-table.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/view/advanced-data-table.js":
/*!********************************************!*\
  !*** ./src/js/view/advanced-data-table.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _typeof(obj) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && \"function\" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? \"symbol\" : typeof obj; }, _typeof(obj); }\nfunction _readOnlyError(name) { throw new TypeError(\"\\\"\" + name + \"\\\" is read-only\"); }\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, \"prototype\", { writable: false }); return Constructor; }\nfunction _toPropertyKey(arg) { var key = _toPrimitive(arg, \"string\"); return _typeof(key) === \"symbol\" ? key : String(key); }\nfunction _toPrimitive(input, hint) { if (_typeof(input) !== \"object\" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || \"default\"); if (_typeof(res) !== \"object\") return res; throw new TypeError(\"@@toPrimitive must return a primitive value.\"); } return (hint === \"string\" ? String : Number)(input); }\nvar advancedDataTable = /*#__PURE__*/function () {\n  function advancedDataTable() {\n    _classCallCheck(this, advancedDataTable);\n    // register hooks\n    elementorFrontend.hooks.addAction(\"frontend/element_ready/eael-advanced-data-table.default\", this.initFrontend.bind(this));\n  }\n\n  // init frontend features\n  _createClass(advancedDataTable, [{\n    key: \"initFrontend\",\n    value: function initFrontend($scope, $) {\n      var table = $scope[0].querySelector(\".ea-advanced-data-table\");\n      var search = $scope[0].querySelector(\".ea-advanced-data-table-search\");\n      var pagination = $scope[0].querySelector(\".ea-advanced-data-table-pagination\");\n      var classCollection = {};\n      if (!ea.isEditMode && table !== null) {\n        // search\n        this.initTableSearch(table, search, pagination);\n\n        // sort\n        this.initTableSort(table, pagination, classCollection);\n\n        // paginated table\n        this.initTablePagination(table, pagination, classCollection);\n\n        // woocommerce\n        this.initWooFeatures(table);\n      }\n      if ($(table).hasClass('ea-advanced-data-table-static')) {\n        $(table).find('th, td').each(function () {\n          $(this).html($(this).text());\n        });\n      }\n    }\n\n    // frontend - search\n  }, {\n    key: \"initTableSearch\",\n    value: function initTableSearch(table, search, pagination) {\n      if (search) {\n        search.addEventListener(\"input\", function (e) {\n          var input = e.target.value.toLowerCase();\n          var hasSort = table.classList.contains(\"ea-advanced-data-table-sortable\");\n          var offset = table.rows[0].parentNode.tagName.toLowerCase() == \"thead\" ? 1 : 0;\n          if (table.rows.length > 1) {\n            if (input.length > 0) {\n              if (hasSort) {\n                table.classList.add(\"ea-advanced-data-table-unsortable\");\n              }\n              if (pagination && pagination.innerHTML.length > 0) {\n                pagination.style.display = \"none\";\n              }\n              for (var i = offset; i < table.rows.length; i++) {\n                var matchFound = false;\n                if (table.rows[i].cells.length > 0) {\n                  for (var j = 0; j < table.rows[i].cells.length; j++) {\n                    if (table.rows[i].cells[j].textContent.toLowerCase().indexOf(input) > -1) {\n                      matchFound = true;\n                      break;\n                    }\n                  }\n                }\n                if (matchFound) {\n                  table.rows[i].style.display = \"table-row\";\n                } else {\n                  table.rows[i].style.display = \"none\";\n                }\n              }\n            } else {\n              if (hasSort) {\n                table.classList.remove(\"ea-advanced-data-table-unsortable\");\n              }\n              if (pagination && pagination.innerHTML.length > 0) {\n                pagination.style.display = \"\";\n                var paginationType = pagination.classList.contains(\"ea-advanced-data-table-pagination-button\") ? \"button\" : \"select\";\n                var currentPage = paginationType == \"button\" ? pagination.querySelector(\".ea-advanced-data-table-pagination-current\").dataset.page : pagination.querySelector(\"select\").value;\n                var startIndex = (currentPage - 1) * table.dataset.itemsPerPage + 1;\n                var endIndex = currentPage * table.dataset.itemsPerPage;\n                for (var _i = 1; _i <= table.rows.length - 1; _i++) {\n                  if (_i >= startIndex && _i <= endIndex) {\n                    table.rows[_i].style.display = \"table-row\";\n                  } else {\n                    table.rows[_i].style.display = \"none\";\n                  }\n                }\n              } else {\n                for (var _i2 = 1; _i2 <= table.rows.length - 1; _i2++) {\n                  table.rows[_i2].style.display = \"table-row\";\n                }\n              }\n            }\n          }\n        });\n      }\n    }\n\n    // frontend - sort\n  }, {\n    key: \"initTableSort\",\n    value: function initTableSort(table, pagination, classCollection) {\n      if (table.classList.contains(\"ea-advanced-data-table-sortable\")) {\n        table.addEventListener(\"click\", function (e) {\n          var target = null;\n          if (e.target.tagName.toLowerCase() === \"th\") {\n            target = e.target;\n          }\n          if (e.target.parentNode.tagName.toLowerCase() === \"th\") {\n            target = e.target.parentNode;\n          }\n          if (e.target.parentNode.parentNode.tagName.toLowerCase() === \"th\") {\n            target = e.target.parentNode.parentNode;\n          }\n          if (target === null) {\n            return;\n          }\n          var index = target.cellIndex;\n          var currentPage = 1;\n          var startIndex = 1;\n          var endIndex = table.rows.length - 1;\n          var sort = \"\";\n          var classList = target.classList;\n          var collection = [];\n          var origTable = table.cloneNode(true);\n          if (classList.contains(\"asc\")) {\n            target.classList.remove(\"asc\");\n            target.classList.add(\"desc\");\n            sort = \"desc\";\n          } else if (classList.contains(\"desc\")) {\n            target.classList.remove(\"desc\");\n            target.classList.add(\"asc\");\n            sort = \"asc\";\n          } else {\n            target.classList.add(\"asc\");\n            sort = \"asc\";\n          }\n          if (pagination && pagination.innerHTML.length > 0) {\n            var paginationType = pagination.classList.contains(\"ea-advanced-data-table-pagination-button\") ? \"button\" : \"select\";\n            currentPage = paginationType == \"button\" ? pagination.querySelector(\".ea-advanced-data-table-pagination-current\").dataset.page : pagination.querySelector(\"select\").value;\n            startIndex = (currentPage - 1) * table.dataset.itemsPerPage + 1;\n            endIndex = endIndex - (currentPage - 1) * table.dataset.itemsPerPage >= table.dataset.itemsPerPage ? currentPage * table.dataset.itemsPerPage : endIndex;\n          }\n\n          // collect header class\n          classCollection[currentPage] = [];\n          table.querySelectorAll(\"th\").forEach(function (el) {\n            if (el.cellIndex != index) {\n              el.classList.remove(\"asc\", \"desc\");\n            }\n            classCollection[currentPage].push(el.classList.contains(\"asc\") ? \"asc\" : el.classList.contains(\"desc\") ? \"desc\" : \"\");\n          });\n\n          // collect table cells value\n          for (var i = 1; i <= table.rows.length - 1; i++) {\n            var value = void 0;\n            var cell = table.rows[i].cells[index];\n            var data = cell.innerText;\n            var regex = new RegExp(\"([0-9]{4}[-./*](0[1-9]|1[0-2])[-./*]([0-2]{1}[0-9]{1}|3[0-1]{1})|([0-2]{1}[0-9]{1}|3[0-1]{1})[-./*](0[1-9]|1[0-2])[-./*][0-9]{4})\");\n            if (data.match(regex)) {\n              dataString = data.split(/[\\.\\-\\/\\*]/);\n              if (dataString[0].length == 4) {\n                dataString[0] + \"-\" + dataString[1] + \"-\" + dataString[2], _readOnlyError(\"data\");\n              } else {\n                dataString[2] + \"-\" + dataString[1] + \"-\" + dataString[0], _readOnlyError(\"data\");\n              }\n              value = Date.parse(data);\n            } else if (isNaN(parseInt(data))) {\n              value = data.toLowerCase();\n            } else {\n              value = parseFloat(data);\n            }\n            collection.push({\n              index: i,\n              value: value\n            });\n          }\n\n          // sort collection array\n          if (sort == \"asc\") {\n            collection.sort(function (x, y) {\n              return x.value > y.value ? 1 : -1;\n            });\n          } else if (sort == \"desc\") {\n            collection.sort(function (x, y) {\n              return x.value < y.value ? 1 : -1;\n            });\n          }\n\n          // sort table\n          collection.forEach(function (row, index) {\n            table.rows[1 + index].innerHTML = origTable.rows[row.index].innerHTML;\n          });\n        });\n      }\n    }\n\n    // frontend - pagination\n  }, {\n    key: \"initTablePagination\",\n    value: function initTablePagination(table, pagination, classCollection) {\n      if (table.classList.contains(\"ea-advanced-data-table-paginated\")) {\n        var paginationHTML = \"\";\n        var paginationType = pagination.classList.contains(\"ea-advanced-data-table-pagination-button\") ? \"button\" : \"select\";\n        var currentPage = 1;\n        var startIndex = table.rows[0].parentNode.tagName.toLowerCase() == \"thead\" ? 1 : 0;\n        var endIndex = currentPage * table.dataset.itemsPerPage;\n        var maxPages = Math.ceil((table.rows.length - 1) / table.dataset.itemsPerPage);\n        pagination.insertAdjacentHTML(\"beforeend\", ''); // insert pagination\n        if (maxPages > 1) {\n          if (paginationType == \"button\") {\n            for (var i = 1; i <= maxPages; i++) {\n              paginationHTML += \"<a href=\\\"#\\\" data-page=\\\"\".concat(i, \"\\\" class=\\\"\").concat(i == 1 ? \"ea-advanced-data-table-pagination-current\" : \"\", \"\\\">\").concat(i, \"</a>\");\n            }\n            pagination.insertAdjacentHTML(\"beforeend\", \"<a href=\\\"#\\\" data-page=\\\"1\\\">&laquo;</a>\".concat(paginationHTML, \"<a href=\\\"#\\\" data-page=\\\"\").concat(maxPages, \"\\\">&raquo;</a>\"));\n          } else {\n            for (var _i3 = 1; _i3 <= maxPages; _i3++) {\n              paginationHTML += \"<option value=\\\"\".concat(_i3, \"\\\">\").concat(_i3, \"</option>\");\n            }\n            pagination.insertAdjacentHTML(\"beforeend\", \"<select>\".concat(paginationHTML, \"</select>\"));\n          }\n        }\n\n        // make initial item visible\n        for (var _i4 = 0; _i4 <= endIndex; _i4++) {\n          if (_i4 >= table.rows.length) {\n            break;\n          }\n          table.rows[_i4].style.display = \"table-row\";\n        }\n\n        // paginate on click\n        if (paginationType == \"button\") {\n          pagination.addEventListener(\"click\", function (e) {\n            e.preventDefault();\n            if (e.target.tagName.toLowerCase() == \"a\") {\n              currentPage = e.target.dataset.page;\n              offset = table.rows[0].parentNode.tagName.toLowerCase() == \"thead\" ? 1 : 0;\n              startIndex = (currentPage - 1) * table.dataset.itemsPerPage + offset;\n              endIndex = currentPage * table.dataset.itemsPerPage;\n              pagination.querySelectorAll(\".ea-advanced-data-table-pagination-current\").forEach(function (el) {\n                el.classList.remove(\"ea-advanced-data-table-pagination-current\");\n              });\n              pagination.querySelectorAll(\"[data-page=\\\"\".concat(currentPage, \"\\\"]\")).forEach(function (el) {\n                el.classList.add(\"ea-advanced-data-table-pagination-current\");\n              });\n              for (var _i5 = offset; _i5 <= table.rows.length - 1; _i5++) {\n                if (_i5 >= startIndex && _i5 <= endIndex) {\n                  table.rows[_i5].style.display = \"table-row\";\n                } else {\n                  table.rows[_i5].style.display = \"none\";\n                }\n              }\n              table.querySelectorAll(\"th\").forEach(function (el, index) {\n                el.classList.remove(\"asc\", \"desc\");\n                if (typeof classCollection[currentPage] != \"undefined\") {\n                  if (classCollection[currentPage][index]) {\n                    el.classList.add(classCollection[currentPage][index]);\n                  }\n                }\n              });\n            }\n          });\n        } else {\n          if (pagination.hasChildNodes()) {\n            pagination.querySelector(\"select\").addEventListener(\"input\", function (e) {\n              e.preventDefault();\n              currentPage = e.target.value;\n              offset = table.rows[0].parentNode.tagName.toLowerCase() == \"thead\" ? 1 : 0;\n              startIndex = (currentPage - 1) * table.dataset.itemsPerPage + offset;\n              endIndex = currentPage * table.dataset.itemsPerPage;\n              for (var _i6 = offset; _i6 <= table.rows.length - 1; _i6++) {\n                if (_i6 >= startIndex && _i6 <= endIndex) {\n                  table.rows[_i6].style.display = \"table-row\";\n                } else {\n                  table.rows[_i6].style.display = \"none\";\n                }\n              }\n              table.querySelectorAll(\"th\").forEach(function (el, index) {\n                el.classList.remove(\"asc\", \"desc\");\n                if (typeof classCollection[currentPage] != \"undefined\") {\n                  if (classCollection[currentPage][index]) {\n                    el.classList.add(classCollection[currentPage][index]);\n                  }\n                }\n              });\n            });\n          }\n        }\n      }\n    }\n\n    // woocommerce features\n  }, {\n    key: \"initWooFeatures\",\n    value: function initWooFeatures(table) {\n      table.querySelectorAll(\".nt_button_woo\").forEach(function (el) {\n        el.classList.add(\"add_to_cart_button\", \"ajax_add_to_cart\");\n      });\n      table.querySelectorAll(\".nt_woo_quantity\").forEach(function (el) {\n        el.addEventListener(\"input\", function (e) {\n          var product_id = e.target.dataset.product_id;\n          var quantity = e.target.value;\n          $(\".nt_add_to_cart_\".concat(product_id), $(table)).data(\"quantity\", quantity);\n        });\n      });\n    }\n  }]);\n  return advancedDataTable;\n}();\nea.hooks.addAction(\"init\", \"ea\", function () {\n  if (ea.elementStatusCheck('eaelAdvancedDataTable')) {\n    return false;\n  }\n  new advancedDataTable();\n});\n\n//# sourceURL=webpack:///./src/js/view/advanced-data-table.js?");

/***/ })

/******/ });