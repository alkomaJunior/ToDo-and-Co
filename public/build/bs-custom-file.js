(self["webpackChunk"] = self["webpackChunk"] || []).push([["bs-custom-file"],{

/***/ "./assets/js/bs-custom-file.js":
/*!*************************************!*\
  !*** ./assets/js/bs-custom-file.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var bs_custom_file_input__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bs-custom-file-input */ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js");
/* harmony import */ var bs_custom_file_input__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(bs_custom_file_input__WEBPACK_IMPORTED_MODULE_0__);


var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(document).ready(function () {
  bs_custom_file_input__WEBPACK_IMPORTED_MODULE_0___default().init();
});

/***/ }),

/***/ "./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js":
/*!************************************************************************!*\
  !*** ./node_modules/bs-custom-file-input/dist/bs-custom-file-input.js ***!
  \************************************************************************/
/***/ (function(module) {

/*!
 * bsCustomFileInput v1.3.4 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
(function (global, factory) {
   true ? module.exports = factory() :
  0;
}(this, (function () { 'use strict';

  var Selector = {
    CUSTOMFILE: '.custom-file input[type="file"]',
    CUSTOMFILELABEL: '.custom-file-label',
    FORM: 'form',
    INPUT: 'input'
  };

  var textNodeType = 3;

  var getDefaultText = function getDefaultText(input) {
    var defaultText = '';
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      defaultText = label.textContent;
    }

    return defaultText;
  };

  var findFirstChildNode = function findFirstChildNode(element) {
    if (element.childNodes.length > 0) {
      var childNodes = [].slice.call(element.childNodes);

      for (var i = 0; i < childNodes.length; i++) {
        var node = childNodes[i];

        if (node.nodeType !== textNodeType) {
          return node;
        }
      }
    }

    return element;
  };

  var restoreDefaultText = function restoreDefaultText(input) {
    var defaultText = input.bsCustomFileInput.defaultText;
    var label = input.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      element.textContent = defaultText;
    }
  };

  var fileApi = !!window.File;
  var FAKE_PATH = 'fakepath';
  var FAKE_PATH_SEPARATOR = '\\';

  var getSelectedFiles = function getSelectedFiles(input) {
    if (input.hasAttribute('multiple') && fileApi) {
      return [].slice.call(input.files).map(function (file) {
        return file.name;
      }).join(', ');
    }

    if (input.value.indexOf(FAKE_PATH) !== -1) {
      var splittedValue = input.value.split(FAKE_PATH_SEPARATOR);
      return splittedValue[splittedValue.length - 1];
    }

    return input.value;
  };

  function handleInputChange() {
    var label = this.parentNode.querySelector(Selector.CUSTOMFILELABEL);

    if (label) {
      var element = findFirstChildNode(label);
      var inputValue = getSelectedFiles(this);

      if (inputValue.length) {
        element.textContent = inputValue;
      } else {
        restoreDefaultText(this);
      }
    }
  }

  function handleFormReset() {
    var customFileList = [].slice.call(this.querySelectorAll(Selector.INPUT)).filter(function (input) {
      return !!input.bsCustomFileInput;
    });

    for (var i = 0, len = customFileList.length; i < len; i++) {
      restoreDefaultText(customFileList[i]);
    }
  }

  var customProperty = 'bsCustomFileInput';
  var Event = {
    FORMRESET: 'reset',
    INPUTCHANGE: 'change'
  };
  var bsCustomFileInput = {
    init: function init(inputSelector, formSelector) {
      if (inputSelector === void 0) {
        inputSelector = Selector.CUSTOMFILE;
      }

      if (formSelector === void 0) {
        formSelector = Selector.FORM;
      }

      var customFileInputList = [].slice.call(document.querySelectorAll(inputSelector));
      var formList = [].slice.call(document.querySelectorAll(formSelector));

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        Object.defineProperty(input, customProperty, {
          value: {
            defaultText: getDefaultText(input)
          },
          writable: true
        });
        handleInputChange.call(input);
        input.addEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i = 0, _len = formList.length; _i < _len; _i++) {
        formList[_i].addEventListener(Event.FORMRESET, handleFormReset);

        Object.defineProperty(formList[_i], customProperty, {
          value: true,
          writable: true
        });
      }
    },
    destroy: function destroy() {
      var formList = [].slice.call(document.querySelectorAll(Selector.FORM)).filter(function (form) {
        return !!form.bsCustomFileInput;
      });
      var customFileInputList = [].slice.call(document.querySelectorAll(Selector.INPUT)).filter(function (input) {
        return !!input.bsCustomFileInput;
      });

      for (var i = 0, len = customFileInputList.length; i < len; i++) {
        var input = customFileInputList[i];
        restoreDefaultText(input);
        input[customProperty] = undefined;
        input.removeEventListener(Event.INPUTCHANGE, handleInputChange);
      }

      for (var _i2 = 0, _len2 = formList.length; _i2 < _len2; _i2++) {
        formList[_i2].removeEventListener(Event.FORMRESET, handleFormReset);

        formList[_i2][customProperty] = undefined;
      }
    }
  };

  return bsCustomFileInput;

})));
//# sourceMappingURL=bs-custom-file-input.js.map


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js"], () => (__webpack_exec__("./assets/js/bs-custom-file.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYnMtY3VzdG9tLWZpbGUuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7O0FBQUE7O0FBQ0EsSUFBTUMsQ0FBQyxHQUFHQyxtQkFBTyxDQUFDLG9EQUFELENBQWpCOztBQUVBRCxDQUFDLENBQUNFLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVk7QUFDMUJKLEVBQUFBLGdFQUFBO0FBQ0gsQ0FGRDs7Ozs7Ozs7OztBQ0hBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEVBQUUsS0FBNEQ7QUFDOUQsRUFBRSxDQUMrRDtBQUNqRSxDQUFDLHNCQUFzQjs7QUFFdkI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUEsc0JBQXNCLHVCQUF1QjtBQUM3Qzs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsT0FBTztBQUNQOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBLFFBQVE7QUFDUjtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQSxLQUFLOztBQUVMLGlEQUFpRCxTQUFTO0FBQzFEO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQSx3REFBd0QsU0FBUztBQUNqRTtBQUNBO0FBQ0E7QUFDQTtBQUNBLFdBQVc7QUFDWDtBQUNBLFNBQVM7QUFDVDtBQUNBO0FBQ0E7O0FBRUEsK0NBQStDLFdBQVc7QUFDMUQ7O0FBRUE7QUFDQTtBQUNBO0FBQ0EsU0FBUztBQUNUO0FBQ0EsS0FBSztBQUNMO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBO0FBQ0EsT0FBTzs7QUFFUCx3REFBd0QsU0FBUztBQUNqRTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBLGlEQUFpRCxhQUFhO0FBQzlEOztBQUVBO0FBQ0E7QUFDQTtBQUNBOztBQUVBOztBQUVBLENBQUM7QUFDRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qcy9icy1jdXN0b20tZmlsZS5qcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvYnMtY3VzdG9tLWZpbGUtaW5wdXQvZGlzdC9icy1jdXN0b20tZmlsZS1pbnB1dC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgYnNDdXN0b21GaWxlSW5wdXQgZnJvbSAnYnMtY3VzdG9tLWZpbGUtaW5wdXQnO1xyXG5jb25zdCAkID0gcmVxdWlyZSgnanF1ZXJ5Jyk7XHJcblxyXG4kKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XHJcbiAgICBic0N1c3RvbUZpbGVJbnB1dC5pbml0KClcclxufSlcclxuIiwiLyohXG4gKiBic0N1c3RvbUZpbGVJbnB1dCB2MS4zLjQgKGh0dHBzOi8vZ2l0aHViLmNvbS9Kb2hhbm4tUy9icy1jdXN0b20tZmlsZS1pbnB1dClcbiAqIENvcHlyaWdodCAyMDE4IC0gMjAyMCBKb2hhbm4tUyA8am9oYW5uLnNlcnZvaXJlQGdtYWlsLmNvbT5cbiAqIExpY2Vuc2VkIHVuZGVyIE1JVCAoaHR0cHM6Ly9naXRodWIuY29tL0pvaGFubi1TL2JzLWN1c3RvbS1maWxlLWlucHV0L2Jsb2IvbWFzdGVyL0xJQ0VOU0UpXG4gKi9cbihmdW5jdGlvbiAoZ2xvYmFsLCBmYWN0b3J5KSB7XG4gIHR5cGVvZiBleHBvcnRzID09PSAnb2JqZWN0JyAmJiB0eXBlb2YgbW9kdWxlICE9PSAndW5kZWZpbmVkJyA/IG1vZHVsZS5leHBvcnRzID0gZmFjdG9yeSgpIDpcbiAgdHlwZW9mIGRlZmluZSA9PT0gJ2Z1bmN0aW9uJyAmJiBkZWZpbmUuYW1kID8gZGVmaW5lKGZhY3RvcnkpIDpcbiAgKGdsb2JhbCA9IGdsb2JhbCB8fCBzZWxmLCBnbG9iYWwuYnNDdXN0b21GaWxlSW5wdXQgPSBmYWN0b3J5KCkpO1xufSh0aGlzLCAoZnVuY3Rpb24gKCkgeyAndXNlIHN0cmljdCc7XG5cbiAgdmFyIFNlbGVjdG9yID0ge1xuICAgIENVU1RPTUZJTEU6ICcuY3VzdG9tLWZpbGUgaW5wdXRbdHlwZT1cImZpbGVcIl0nLFxuICAgIENVU1RPTUZJTEVMQUJFTDogJy5jdXN0b20tZmlsZS1sYWJlbCcsXG4gICAgRk9STTogJ2Zvcm0nLFxuICAgIElOUFVUOiAnaW5wdXQnXG4gIH07XG5cbiAgdmFyIHRleHROb2RlVHlwZSA9IDM7XG5cbiAgdmFyIGdldERlZmF1bHRUZXh0ID0gZnVuY3Rpb24gZ2V0RGVmYXVsdFRleHQoaW5wdXQpIHtcbiAgICB2YXIgZGVmYXVsdFRleHQgPSAnJztcbiAgICB2YXIgbGFiZWwgPSBpbnB1dC5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoU2VsZWN0b3IuQ1VTVE9NRklMRUxBQkVMKTtcblxuICAgIGlmIChsYWJlbCkge1xuICAgICAgZGVmYXVsdFRleHQgPSBsYWJlbC50ZXh0Q29udGVudDtcbiAgICB9XG5cbiAgICByZXR1cm4gZGVmYXVsdFRleHQ7XG4gIH07XG5cbiAgdmFyIGZpbmRGaXJzdENoaWxkTm9kZSA9IGZ1bmN0aW9uIGZpbmRGaXJzdENoaWxkTm9kZShlbGVtZW50KSB7XG4gICAgaWYgKGVsZW1lbnQuY2hpbGROb2Rlcy5sZW5ndGggPiAwKSB7XG4gICAgICB2YXIgY2hpbGROb2RlcyA9IFtdLnNsaWNlLmNhbGwoZWxlbWVudC5jaGlsZE5vZGVzKTtcblxuICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCBjaGlsZE5vZGVzLmxlbmd0aDsgaSsrKSB7XG4gICAgICAgIHZhciBub2RlID0gY2hpbGROb2Rlc1tpXTtcblxuICAgICAgICBpZiAobm9kZS5ub2RlVHlwZSAhPT0gdGV4dE5vZGVUeXBlKSB7XG4gICAgICAgICAgcmV0dXJuIG5vZGU7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XG5cbiAgICByZXR1cm4gZWxlbWVudDtcbiAgfTtcblxuICB2YXIgcmVzdG9yZURlZmF1bHRUZXh0ID0gZnVuY3Rpb24gcmVzdG9yZURlZmF1bHRUZXh0KGlucHV0KSB7XG4gICAgdmFyIGRlZmF1bHRUZXh0ID0gaW5wdXQuYnNDdXN0b21GaWxlSW5wdXQuZGVmYXVsdFRleHQ7XG4gICAgdmFyIGxhYmVsID0gaW5wdXQucGFyZW50Tm9kZS5xdWVyeVNlbGVjdG9yKFNlbGVjdG9yLkNVU1RPTUZJTEVMQUJFTCk7XG5cbiAgICBpZiAobGFiZWwpIHtcbiAgICAgIHZhciBlbGVtZW50ID0gZmluZEZpcnN0Q2hpbGROb2RlKGxhYmVsKTtcbiAgICAgIGVsZW1lbnQudGV4dENvbnRlbnQgPSBkZWZhdWx0VGV4dDtcbiAgICB9XG4gIH07XG5cbiAgdmFyIGZpbGVBcGkgPSAhIXdpbmRvdy5GaWxlO1xuICB2YXIgRkFLRV9QQVRIID0gJ2Zha2VwYXRoJztcbiAgdmFyIEZBS0VfUEFUSF9TRVBBUkFUT1IgPSAnXFxcXCc7XG5cbiAgdmFyIGdldFNlbGVjdGVkRmlsZXMgPSBmdW5jdGlvbiBnZXRTZWxlY3RlZEZpbGVzKGlucHV0KSB7XG4gICAgaWYgKGlucHV0Lmhhc0F0dHJpYnV0ZSgnbXVsdGlwbGUnKSAmJiBmaWxlQXBpKSB7XG4gICAgICByZXR1cm4gW10uc2xpY2UuY2FsbChpbnB1dC5maWxlcykubWFwKGZ1bmN0aW9uIChmaWxlKSB7XG4gICAgICAgIHJldHVybiBmaWxlLm5hbWU7XG4gICAgICB9KS5qb2luKCcsICcpO1xuICAgIH1cblxuICAgIGlmIChpbnB1dC52YWx1ZS5pbmRleE9mKEZBS0VfUEFUSCkgIT09IC0xKSB7XG4gICAgICB2YXIgc3BsaXR0ZWRWYWx1ZSA9IGlucHV0LnZhbHVlLnNwbGl0KEZBS0VfUEFUSF9TRVBBUkFUT1IpO1xuICAgICAgcmV0dXJuIHNwbGl0dGVkVmFsdWVbc3BsaXR0ZWRWYWx1ZS5sZW5ndGggLSAxXTtcbiAgICB9XG5cbiAgICByZXR1cm4gaW5wdXQudmFsdWU7XG4gIH07XG5cbiAgZnVuY3Rpb24gaGFuZGxlSW5wdXRDaGFuZ2UoKSB7XG4gICAgdmFyIGxhYmVsID0gdGhpcy5wYXJlbnROb2RlLnF1ZXJ5U2VsZWN0b3IoU2VsZWN0b3IuQ1VTVE9NRklMRUxBQkVMKTtcblxuICAgIGlmIChsYWJlbCkge1xuICAgICAgdmFyIGVsZW1lbnQgPSBmaW5kRmlyc3RDaGlsZE5vZGUobGFiZWwpO1xuICAgICAgdmFyIGlucHV0VmFsdWUgPSBnZXRTZWxlY3RlZEZpbGVzKHRoaXMpO1xuXG4gICAgICBpZiAoaW5wdXRWYWx1ZS5sZW5ndGgpIHtcbiAgICAgICAgZWxlbWVudC50ZXh0Q29udGVudCA9IGlucHV0VmFsdWU7XG4gICAgICB9IGVsc2Uge1xuICAgICAgICByZXN0b3JlRGVmYXVsdFRleHQodGhpcyk7XG4gICAgICB9XG4gICAgfVxuICB9XG5cbiAgZnVuY3Rpb24gaGFuZGxlRm9ybVJlc2V0KCkge1xuICAgIHZhciBjdXN0b21GaWxlTGlzdCA9IFtdLnNsaWNlLmNhbGwodGhpcy5xdWVyeVNlbGVjdG9yQWxsKFNlbGVjdG9yLklOUFVUKSkuZmlsdGVyKGZ1bmN0aW9uIChpbnB1dCkge1xuICAgICAgcmV0dXJuICEhaW5wdXQuYnNDdXN0b21GaWxlSW5wdXQ7XG4gICAgfSk7XG5cbiAgICBmb3IgKHZhciBpID0gMCwgbGVuID0gY3VzdG9tRmlsZUxpc3QubGVuZ3RoOyBpIDwgbGVuOyBpKyspIHtcbiAgICAgIHJlc3RvcmVEZWZhdWx0VGV4dChjdXN0b21GaWxlTGlzdFtpXSk7XG4gICAgfVxuICB9XG5cbiAgdmFyIGN1c3RvbVByb3BlcnR5ID0gJ2JzQ3VzdG9tRmlsZUlucHV0JztcbiAgdmFyIEV2ZW50ID0ge1xuICAgIEZPUk1SRVNFVDogJ3Jlc2V0JyxcbiAgICBJTlBVVENIQU5HRTogJ2NoYW5nZSdcbiAgfTtcbiAgdmFyIGJzQ3VzdG9tRmlsZUlucHV0ID0ge1xuICAgIGluaXQ6IGZ1bmN0aW9uIGluaXQoaW5wdXRTZWxlY3RvciwgZm9ybVNlbGVjdG9yKSB7XG4gICAgICBpZiAoaW5wdXRTZWxlY3RvciA9PT0gdm9pZCAwKSB7XG4gICAgICAgIGlucHV0U2VsZWN0b3IgPSBTZWxlY3Rvci5DVVNUT01GSUxFO1xuICAgICAgfVxuXG4gICAgICBpZiAoZm9ybVNlbGVjdG9yID09PSB2b2lkIDApIHtcbiAgICAgICAgZm9ybVNlbGVjdG9yID0gU2VsZWN0b3IuRk9STTtcbiAgICAgIH1cblxuICAgICAgdmFyIGN1c3RvbUZpbGVJbnB1dExpc3QgPSBbXS5zbGljZS5jYWxsKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoaW5wdXRTZWxlY3RvcikpO1xuICAgICAgdmFyIGZvcm1MaXN0ID0gW10uc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKGZvcm1TZWxlY3RvcikpO1xuXG4gICAgICBmb3IgKHZhciBpID0gMCwgbGVuID0gY3VzdG9tRmlsZUlucHV0TGlzdC5sZW5ndGg7IGkgPCBsZW47IGkrKykge1xuICAgICAgICB2YXIgaW5wdXQgPSBjdXN0b21GaWxlSW5wdXRMaXN0W2ldO1xuICAgICAgICBPYmplY3QuZGVmaW5lUHJvcGVydHkoaW5wdXQsIGN1c3RvbVByb3BlcnR5LCB7XG4gICAgICAgICAgdmFsdWU6IHtcbiAgICAgICAgICAgIGRlZmF1bHRUZXh0OiBnZXREZWZhdWx0VGV4dChpbnB1dClcbiAgICAgICAgICB9LFxuICAgICAgICAgIHdyaXRhYmxlOiB0cnVlXG4gICAgICAgIH0pO1xuICAgICAgICBoYW5kbGVJbnB1dENoYW5nZS5jYWxsKGlucHV0KTtcbiAgICAgICAgaW5wdXQuYWRkRXZlbnRMaXN0ZW5lcihFdmVudC5JTlBVVENIQU5HRSwgaGFuZGxlSW5wdXRDaGFuZ2UpO1xuICAgICAgfVxuXG4gICAgICBmb3IgKHZhciBfaSA9IDAsIF9sZW4gPSBmb3JtTGlzdC5sZW5ndGg7IF9pIDwgX2xlbjsgX2krKykge1xuICAgICAgICBmb3JtTGlzdFtfaV0uYWRkRXZlbnRMaXN0ZW5lcihFdmVudC5GT1JNUkVTRVQsIGhhbmRsZUZvcm1SZXNldCk7XG5cbiAgICAgICAgT2JqZWN0LmRlZmluZVByb3BlcnR5KGZvcm1MaXN0W19pXSwgY3VzdG9tUHJvcGVydHksIHtcbiAgICAgICAgICB2YWx1ZTogdHJ1ZSxcbiAgICAgICAgICB3cml0YWJsZTogdHJ1ZVxuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9LFxuICAgIGRlc3Ryb3k6IGZ1bmN0aW9uIGRlc3Ryb3koKSB7XG4gICAgICB2YXIgZm9ybUxpc3QgPSBbXS5zbGljZS5jYWxsKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoU2VsZWN0b3IuRk9STSkpLmZpbHRlcihmdW5jdGlvbiAoZm9ybSkge1xuICAgICAgICByZXR1cm4gISFmb3JtLmJzQ3VzdG9tRmlsZUlucHV0O1xuICAgICAgfSk7XG4gICAgICB2YXIgY3VzdG9tRmlsZUlucHV0TGlzdCA9IFtdLnNsaWNlLmNhbGwoZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChTZWxlY3Rvci5JTlBVVCkpLmZpbHRlcihmdW5jdGlvbiAoaW5wdXQpIHtcbiAgICAgICAgcmV0dXJuICEhaW5wdXQuYnNDdXN0b21GaWxlSW5wdXQ7XG4gICAgICB9KTtcblxuICAgICAgZm9yICh2YXIgaSA9IDAsIGxlbiA9IGN1c3RvbUZpbGVJbnB1dExpc3QubGVuZ3RoOyBpIDwgbGVuOyBpKyspIHtcbiAgICAgICAgdmFyIGlucHV0ID0gY3VzdG9tRmlsZUlucHV0TGlzdFtpXTtcbiAgICAgICAgcmVzdG9yZURlZmF1bHRUZXh0KGlucHV0KTtcbiAgICAgICAgaW5wdXRbY3VzdG9tUHJvcGVydHldID0gdW5kZWZpbmVkO1xuICAgICAgICBpbnB1dC5yZW1vdmVFdmVudExpc3RlbmVyKEV2ZW50LklOUFVUQ0hBTkdFLCBoYW5kbGVJbnB1dENoYW5nZSk7XG4gICAgICB9XG5cbiAgICAgIGZvciAodmFyIF9pMiA9IDAsIF9sZW4yID0gZm9ybUxpc3QubGVuZ3RoOyBfaTIgPCBfbGVuMjsgX2kyKyspIHtcbiAgICAgICAgZm9ybUxpc3RbX2kyXS5yZW1vdmVFdmVudExpc3RlbmVyKEV2ZW50LkZPUk1SRVNFVCwgaGFuZGxlRm9ybVJlc2V0KTtcblxuICAgICAgICBmb3JtTGlzdFtfaTJdW2N1c3RvbVByb3BlcnR5XSA9IHVuZGVmaW5lZDtcbiAgICAgIH1cbiAgICB9XG4gIH07XG5cbiAgcmV0dXJuIGJzQ3VzdG9tRmlsZUlucHV0O1xuXG59KSkpO1xuLy8jIHNvdXJjZU1hcHBpbmdVUkw9YnMtY3VzdG9tLWZpbGUtaW5wdXQuanMubWFwXG4iXSwibmFtZXMiOlsiYnNDdXN0b21GaWxlSW5wdXQiLCIkIiwicmVxdWlyZSIsImRvY3VtZW50IiwicmVhZHkiLCJpbml0Il0sInNvdXJjZVJvb3QiOiIifQ==