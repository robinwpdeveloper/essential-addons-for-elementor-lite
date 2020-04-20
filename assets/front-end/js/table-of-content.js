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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/table-of-content.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/table-of-content.js":
/*!************************************!*\
  !*** ./src/js/table-of-content.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("(function ($) {\n  jQuery(document).ready(function () {\n    /**\n     * add ID in main content heading tag\n     * @param selector\n     * @param supportTag\n     */\n    function eael_toc_content(selector, supportTag) {\n      var listId = document.getElementById(\"eael-toc-list\");\n\n      if (selector === null || supportTag === undefined || !listId) {\n        return null;\n      }\n\n      var allSupportTag = [];\n      var mainSelector = document.querySelectorAll(selector),\n          listIndex = 0;\n\n      for (var j = 0; j < mainSelector.length; j++) {\n        var featchTag = mainSelector[j].querySelectorAll(supportTag);\n        Array.prototype.push.apply(allSupportTag, featchTag);\n      }\n\n      allSupportTag = Array.prototype.slice.call(allSupportTag);\n      allSupportTag.forEach(function (el) {\n        el.id = listIndex + \"-\" + eael_build_id();\n        el.classList.add(\"eael-heading-content\");\n        listIndex++;\n      }); //build toc list hierarchy\n\n      eael_list_hierarchy(selector, supportTag);\n      var firstChild = $(\"ul.eael-toc-list > li\");\n\n      if (firstChild.length < 1) {\n        document.getElementById(\"eael-toc\").classList.add(\"eael-toc-disable\");\n      }\n\n      firstChild.each(function () {\n        this.classList.add(\"eael-first-child\");\n      });\n    }\n    /**\n     * Make toc list\n     * @param selector\n     * @param supportTag\n     */\n\n\n    function eael_list_hierarchy(selector, supportTag) {\n      var tagList = supportTag;\n      var parentLevel = '';\n      var allHeadings = [];\n      var listId = document.getElementById(\"eael-toc-list\");\n      var mainContent = document.querySelectorAll(selector),\n          baseTag = parentLevel = tagList.trim().split(\",\")[0].substr(1, 1),\n          ListNode = listId;\n      listId.innerHTML = \"\";\n\n      for (var j = 0; j < mainContent.length; j++) {\n        var featchTag = mainContent[j].querySelectorAll(tagList);\n        Array.prototype.push.apply(allHeadings, featchTag);\n      }\n\n      if (allHeadings.length > 0) {\n        document.getElementById(\"eael-toc\").classList.remove(\"eael-toc-disable\");\n      }\n\n      for (var i = 0, len = allHeadings.length; i < len; ++i) {\n        var currentHeading = allHeadings[i];\n        var latestLavel = parseInt(currentHeading.tagName.substr(1, 1));\n        var diff = latestLavel - parentLevel;\n\n        if (diff > 0) {\n          var containerLiNode = ListNode.lastChild;\n\n          if (containerLiNode) {\n            var createUlNode = document.createElement(\"UL\");\n            containerLiNode.appendChild(createUlNode);\n            ListNode = createUlNode;\n            parentLevel = latestLavel;\n          }\n        }\n\n        var sequenceParent = false;\n\n        if (diff < 0) {\n          while (0 !== diff++) {\n            if (ListNode.parentNode.parentNode) {\n              ListNode = ListNode.parentNode.parentNode;\n            }\n          }\n\n          parentLevel = latestLavel;\n          sequenceParent = true;\n        }\n\n        if (ListNode.tagName !== \"UL\") {\n          ListNode = listId;\n        }\n\n        if (currentHeading.textContent.trim() === \"\") {\n          continue;\n        }\n\n        var liNode = document.createElement(\"LI\");\n        var anchorTag = document.createElement(\"A\");\n        var spanTag = document.createElement(\"SPAN\");\n\n        if (baseTag === parentLevel || sequenceParent) {\n          liNode.setAttribute(\"itemscope\", \"\");\n          liNode.setAttribute(\"itemtype\", \"http://schema.org/ListItem\");\n          liNode.setAttribute(\"itemprop\", \"itemListElement\");\n        }\n\n        var Linkid = \"#\" + i + \"-\" + eael_build_id();\n        anchorTag.className = \"eael-toc-link\";\n        anchorTag.setAttribute(\"itemprop\", \"item\");\n        anchorTag.setAttribute(\"href\", Linkid);\n        spanTag.appendChild(document.createTextNode(currentHeading.textContent));\n        anchorTag.appendChild(spanTag);\n        liNode.appendChild(anchorTag);\n        ListNode.appendChild(liNode);\n      }\n    } // expand collapse\n\n\n    $(document).on(\"click\", \"ul.eael-toc-list a\", function (e) {\n      e.preventDefault();\n      $(document).off(\"scroll\");\n      var target = this.hash;\n      history.pushState(\"\", document.title, window.location.pathname + window.location.search);\n      var parentLi = $(this).parent();\n\n      if (parentLi.is(\".eael-highlight-parent.eael-highlight-active\")) {\n        window.location.hash = target;\n        return false;\n      }\n\n      $(\".eael-highlight-active, .eael-highlight-parent\").removeClass(\"eael-highlight-active eael-highlight-parent\");\n      $(this).closest(\".eael-first-child\").addClass(\"eael-highlight-parent\");\n      $(this).parent().addClass(\"eael-highlight-active\");\n      window.location.hash = target;\n    }); //some site not working with **window.onscroll**\n\n    window.addEventListener('scroll', function (e) {\n      eaelTocSticky();\n    });\n    var stickyScroll = $('#eael-toc').data('stickyscroll');\n    /**\n     * check sticky\n     */\n\n    function eaelTocSticky() {\n      var eaelToc = document.getElementById(\"eael-toc\");\n\n      if (!eaelToc) {\n        return;\n      }\n\n      stickyScroll = stickyScroll !== undefined ? stickyScroll : 200;\n\n      if (window.pageYOffset >= stickyScroll && !eaelToc.classList.contains('eael-toc-disable')) {\n        eaelToc.classList.add(\"eael-sticky\");\n      } else {\n        eaelToc.classList.remove(\"eael-sticky\");\n      }\n    }\n    /**\n     *\n     * @param content\n     * @returns {string}\n     */\n\n\n    function eael_build_id() {\n      return \"eael-table-of-content\";\n    }\n    /**\n     *\n     * @returns {null|selector}\n     */\n\n\n    function eael_toc_check_content() {\n      var contentSelectro = '.site-content';\n\n      if ($(\".site-content\")[0]) {\n        contentSelectro = \".site-content\";\n      } else if ($(\".elementor-inner\")[0]) {\n        contentSelectro = \".elementor-inner\";\n      } else if ($(\"#site-content\")[0]) {\n        contentSelectro = \"#site-content\";\n      }\n\n      return contentSelectro;\n    } //toc auto collapse\n\n\n    $(\"body\").click(function (e) {\n      var target = $(e.target);\n      var eaToc = $(\"#eael-toc\");\n\n      if (eaToc.hasClass(\"eael-toc-auto-collapse\") && eaToc.hasClass(\"eael-sticky\") && !eaToc.hasClass(\"collapsed\") && $(target).closest(\"#eael-toc\").length === 0) {\n        eaToc.toggleClass(\"collapsed\");\n      }\n    });\n    $(document).on(\"click\", \".eael-toc-close ,.eael-toc-button\", function (event) {\n      event.stopPropagation();\n      $(\".eael-toc\").toggleClass(\"collapsed\");\n    });\n\n    function eael_build_toc($settings) {\n      var pageSetting = $settings.settings,\n          title = pageSetting.eael_ext_toc_title,\n          toc_style_class = \"eael-toc-list eael-toc-list-\" + pageSetting.eael_ext_table_of_content_list_style,\n          icon = pageSetting.eael_ext_table_of_content_header_icon.value,\n          el_class = pageSetting.eael_ext_toc_position === \"right\" ? \" eael-toc-right\" : \" \";\n      toc_style_class += pageSetting.eael_ext_toc_collapse_sub_heading === \"yes\" ? \" eael-toc-collapse\" : \" \";\n      toc_style_class += pageSetting.eael_ext_toc_list_icon === \"number\" ? \" eael-toc-number\" : \" eael-toc-bullet\";\n      return '<div id=\"eael-toc\" class=\"eael-toc eael-toc-disable ' + el_class + '\">' + '<div class=\"eael-toc-header\"><span class=\"eael-toc-close\">×</span><h2 class=\"eael-toc-title\">' + title + \"</h2></div>\" + '<div class=\"eael-toc-body\"><ul id=\"eael-toc-list\" class=\"' + toc_style_class + '\"></ul></div>' + '<button class=\"eael-toc-button\"><i class=\"' + icon + '\"></i><span>' + title + \"</span></button>\" + \"</div>\";\n    }\n\n    var intSupportTag = $(\"#eael-toc\").data(\"eaeltoctag\");\n\n    if (intSupportTag !== \"\") {\n      eael_toc_content(eael_toc_check_content(), intSupportTag);\n    } //editor mode\n\n\n    if (isEditMode) {\n      var eael_toc_list_collapse = function eael_toc_list_collapse(newValue) {\n        var list = $(\".eael-toc-list\");\n\n        if (newValue === \"yes\") {\n          list.addClass(\"eael-toc-collapse\");\n        } else {\n          list.removeClass(\"eael-toc-collapse\");\n        }\n      };\n\n      var ea_toc_title_change = function ea_toc_title_change(newValue) {\n        elementorFrontend.elements.$document.find(\".eael-toc-title\").text(newValue);\n        elementorFrontend.elements.$document.find(\".eael-toc-button span\").text(newValue);\n      };\n\n      elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope, $) {\n        var tocLoad = $('#eael-toc #eael-toc-list');\n        var TocList = tocLoad.find('li.eael-first-child');\n\n        if (TocList.length < 1 && tocLoad.length >= 1) {\n          var tagList = $(\"#eael-toc\").data(\"eaeltoctag\");\n\n          if (tagList) {\n            eael_toc_content(eael_toc_check_content(), tagList);\n          }\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_table_of_content\", function (newValue) {\n        var tocGlobal = $(\".eael-toc-global\");\n\n        if (tocGlobal.length > 0) {\n          tocGlobal.attr(\"id\", \"eael-toc-temp\").removeClass(\"eael-toc\").hide();\n          $(\".eael-toc-global #eael-toc-list\").attr(\"id\", \"\");\n        }\n\n        $(\"#eael-toc\").remove();\n\n        if (newValue === \"yes\") {\n          var $settings = elementor.settings.page.getSettings();\n          $(\"body\").append(eael_build_toc($settings));\n          eael_toc_content(eael_toc_check_content(), $settings.settings.eael_ext_toc_supported_heading_tag.join(\", \"));\n        } else {\n          if (tocGlobal.length > 0) {\n            tocGlobal.addClass(\"eael-toc\").attr(\"id\", \"eael-toc\").show();\n          }\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_position\", function (newValue) {\n        if (newValue === \"right\") {\n          $(\"#eael-toc\").addClass(\"eael-toc-right\");\n        } else {\n          $(\"#eael-toc\").removeClass(\"eael-toc-right\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_table_of_content_list_style\", function (newValue) {\n        var list = $(\".eael-toc-list\");\n        list.removeClass(\"eael-toc-list-bar eael-toc-list-arrow\");\n\n        if (newValue !== \"none\") {\n          list.addClass(\"eael-toc-list-\" + newValue);\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_collapse_sub_heading\", eael_toc_list_collapse);\n      elementor.settings.page.addChangeCallback(\"eael_ext_table_of_content_header_icon\", function (newValue) {\n        var iconElement = $(\".eael-toc-button i\");\n        iconElement.removeClass().addClass(newValue.value);\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_list_icon\", function (newValue) {\n        var list = $(\".eael-toc-list\");\n\n        if (newValue === \"number\") {\n          list.addClass(\"eael-toc-number\").removeClass(\"eael-toc-bullet\");\n        } else {\n          list.addClass(\"eael-toc-bullet\").removeClass(\"eael-toc-number\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_word_wrap\", function (newValue) {\n        var list = $(\".eael-toc-list\");\n\n        if (newValue === \"yes\") {\n          list.addClass(\"eael-toc-word-wrap\");\n        } else {\n          list.removeClass(\"eael-toc-word-wrap\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_close_button_text_style\", function (newValue) {\n        var toc = $(\"#eael-toc\");\n\n        if (newValue === \"bottom_to_top\") {\n          toc.addClass(\"eael-bottom-to-top\");\n        } else {\n          toc.removeClass(\"eael-bottom-to-top\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_box_shadow\", function (newValue) {\n        var toc = $(\"#eael-toc\");\n\n        if (newValue === \"yes\") {\n          toc.addClass(\"eael-box-shadow\");\n        } else {\n          toc.removeClass(\"eael-box-shadow\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_auto_collapse\", function (newValue) {\n        var toc = $(\"#eael-toc\");\n\n        if (newValue === \"yes\") {\n          toc.addClass(\"eael-toc-auto-collapse\");\n        } else {\n          toc.removeClass(\"eael-toc-auto-collapse\");\n        }\n      });\n      elementor.settings.page.addChangeCallback(\"eael_ext_toc_title\", ea_toc_title_change);\n    }\n  });\n})(jQuery);\n\n//# sourceURL=webpack:///./src/js/table-of-content.js?");

/***/ })

/******/ });