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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ 3:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ua", function() { return ua; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isIE", function() { return isIE; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "urlParameter", function() { return urlParameter; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "contentsSize", function() { return contentsSize; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "breakpointMd", function() { return breakpointMd; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "breakpointLg", function() { return breakpointLg; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "breakpointXlg", function() { return breakpointXlg; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mqMd", function() { return mqMd; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mqMdDown", function() { return mqMdDown; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isMq", function() { return isMq; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isMqMd", function() { return isMqMd; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isMqMdDown", function() { return isMqMdDown; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mq", function() { return mq; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activeClass", function() { return activeClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "currentClass", function() { return currentClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "disabledClass", function() { return disabledClass; });
/**
 * @file グローバル変数を定義
 *
*/
// ユーザーエージェント
var ua = navigator.userAgent;
var isIE = ua.toLowerCase().indexOf('msie') !== -1 || ua.toLowerCase().indexOf('trident') !== -1 || ua.toLowerCase().indexOf('edge') !== -1; // URLパラメーター
// @use: /blueplanet/list.html?tabid=2012
//       urlParameter.tabid: "2012"

var urlParameter = function () {
  var url = location.search.substring(1).split('&');
  var param = [];

  for (var i = 0; url[i]; i++) {
    var k = url[i].split('=');
    param[k[0]] = k[1];
  }

  return param;
}(); // コンテンツサイズ

var contentsSize = 1000; // ブレイクポイント

var breakpointMd = 768;
var breakpointLg = 1024;
var breakpointXlg = 1286; // デバイス判定

var mqMd = window.matchMedia('(min-width:' + breakpointMd + 'px)');
var mqMdDown = window.matchMedia('(max-width:' + (breakpointMd - 1) + 'px)');
var isMq = mqMd.matches ? 'pc' : 'sp';
var isMqMd = isMq === 'pc' ? true : false;
var isMqMdDown = isMq === 'sp' ? true : false; // 限定デバイス判定
//
// 使い方 example
// mq.Pc.addListener( function(){} ); // ブレークポイントを経過した際に実行
// if( mq.Pc.matches ){ function(){} }; // mq.Pcに一致するwindowサイズの際に実行
//
// | ~1286 | ~1024 | ~768 | ~0   |
// |       Pc      |             |
// |       | Pcmd  |             |
// |               |  Tb  |      |
// |                      |  Sp  |
//

var mq = {
  Pc: window.matchMedia('(min-width: ' + breakpointLg + 'px)'),
  PcTb: window.matchMedia('(min-width: ' + breakpointMd + 'px)'),
  Pcmd: window.matchMedia('(max-width: ' + (breakpointXlg - 1) + 'px) and (min-width: ' + breakpointLg + 'px)'),
  PcmdTb: window.matchMedia('(max-width: ' + (breakpointXlg - 1) + 'px) and (min-width: ' + breakpointMd + 'px)'),
  Tb: window.matchMedia('(max-width: ' + (breakpointLg - 1) + 'px) and (min-width: ' + breakpointMd + 'px)'),
  TbSp: window.matchMedia('(max-width: ' + (breakpointLg - 1) + 'px)'),
  Sp: window.matchMedia('(max-width: ' + (breakpointMd - 1) + 'px)')
}; // state modifier クラス

var activeClass = 'is-active';
var currentClass = 'is-current';
var disabledClass = 'is-disabled';

/***/ }),

/***/ 8:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _data_variables__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(3);
/**
 * @file headで読み込むのに使用するjsファイル
 *
*/
// viewportを最適化する

var windowSize = window.innerWidth;
var metalist = document.getElementsByTagName('meta');
var viewSize = _data_variables__WEBPACK_IMPORTED_MODULE_0__["contentsSize"] + 40;

for (var i = 0; i < metalist.length; i++) {
  var name = metalist[i].getAttribute('name');

  if (name && name.toLowerCase() === 'viewport') {
    // タブレットを判定
    if (_data_variables__WEBPACK_IMPORTED_MODULE_0__["ua"].indexOf('iPad') > 0 || _data_variables__WEBPACK_IMPORTED_MODULE_0__["ua"].indexOf('Android') > 0 && _data_variables__WEBPACK_IMPORTED_MODULE_0__["ua"].indexOf('Mobile') < 0) {
      // viewportをPC幅に固定し、PCレイアウトを表示させる
      metalist[i].setAttribute('content', 'width=' + viewSize + '');
    } // 375pxより小さいデバイスを判定


    if (windowSize < 375) {
      // viewportを375px固定し、表示領域を縮小させて表示させる
      metalist[i].setAttribute('content', 'width=375');
    }
  }
}

/***/ })

/******/ });