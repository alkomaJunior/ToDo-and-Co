(self["webpackChunk"] = self["webpackChunk"] || []).push([["edit-user-forms"],{

/***/ "./assets/js/edit-user-forms.js":
/*!**************************************!*\
  !*** ./assets/js/edit-user-forms.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

$(document).ready(function () {
  // Getting form field
  var updatePassFirstInput = $('input[id="update_user_password_adminPassword"]');
  var updatePassSecondInput = $('input[id="update_user_password_plainPassword_first"]');
  var updatePassThirdInput = $('input[id="update_user_password_plainPassword_second"]'); // Getting Tab and their title

  var editUserTab = $('div[id="edit-user"]');
  var updatePassTab = $('div[id="update-pass"]');
  var editUserTabTitle = $('a[href="#edit-user"]');
  var updatePassTabTitle = $('a[href="#update-pass"]');

  if (updatePassFirstInput.hasClass("is-invalid") || updatePassSecondInput.hasClass("is-invalid") || updatePassSecondInput.hasClass("is-invalid")) {
    editUserTab.removeClass("active");
    editUserTabTitle.removeClass("active");
    updatePassTab.addClass("active");
    updatePassTabTitle.addClass("active");
  } //console.log(updatePass[0][1]);

});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery_dist_jquery_js"], () => (__webpack_exec__("./assets/js/edit-user-forms.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiZWRpdC11c2VyLWZvcm1zLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7O0FBQUEsSUFBTUEsQ0FBQyxHQUFHQyxtQkFBTyxDQUFDLG9EQUFELENBQWpCOztBQUVBRCxDQUFDLENBQUNFLFFBQUQsQ0FBRCxDQUFZQyxLQUFaLENBQWtCLFlBQVk7QUFDMUI7QUFDQSxNQUFJQyxvQkFBb0IsR0FBR0osQ0FBQyxDQUFDLGdEQUFELENBQTVCO0FBQ0EsTUFBSUsscUJBQXFCLEdBQUdMLENBQUMsQ0FBQyxzREFBRCxDQUE3QjtBQUNBLE1BQUlNLG9CQUFvQixHQUFHTixDQUFDLENBQUMsdURBQUQsQ0FBNUIsQ0FKMEIsQ0FNMUI7O0FBQ0EsTUFBSU8sV0FBVyxHQUFHUCxDQUFDLENBQUMscUJBQUQsQ0FBbkI7QUFDQSxNQUFJUSxhQUFhLEdBQUdSLENBQUMsQ0FBQyx1QkFBRCxDQUFyQjtBQUNBLE1BQUlTLGdCQUFnQixHQUFHVCxDQUFDLENBQUMsc0JBQUQsQ0FBeEI7QUFDQSxNQUFJVSxrQkFBa0IsR0FBR1YsQ0FBQyxDQUFDLHdCQUFELENBQTFCOztBQUVBLE1BQUlJLG9CQUFvQixDQUFDTyxRQUFyQixDQUE4QixZQUE5QixLQUNBTixxQkFBcUIsQ0FBQ00sUUFBdEIsQ0FBK0IsWUFBL0IsQ0FEQSxJQUVBTixxQkFBcUIsQ0FBQ00sUUFBdEIsQ0FBK0IsWUFBL0IsQ0FGSixFQUVrRDtBQUM5Q0osSUFBQUEsV0FBVyxDQUFDSyxXQUFaLENBQXdCLFFBQXhCO0FBQ0FILElBQUFBLGdCQUFnQixDQUFDRyxXQUFqQixDQUE2QixRQUE3QjtBQUNBSixJQUFBQSxhQUFhLENBQUNLLFFBQWQsQ0FBdUIsUUFBdkI7QUFDQUgsSUFBQUEsa0JBQWtCLENBQUNHLFFBQW5CLENBQTRCLFFBQTVCO0FBQ0gsR0FuQnlCLENBb0IxQjs7QUFDSCxDQXJCRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9qcy9lZGl0LXVzZXItZm9ybXMuanMiXSwic291cmNlc0NvbnRlbnQiOlsiY29uc3QgJCA9IHJlcXVpcmUoXCJqcXVlcnlcIik7XG5cbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uICgpIHtcbiAgICAvLyBHZXR0aW5nIGZvcm0gZmllbGRcbiAgICBsZXQgdXBkYXRlUGFzc0ZpcnN0SW5wdXQgPSAkKCdpbnB1dFtpZD1cInVwZGF0ZV91c2VyX3Bhc3N3b3JkX2FkbWluUGFzc3dvcmRcIl0nKTtcbiAgICBsZXQgdXBkYXRlUGFzc1NlY29uZElucHV0ID0gJCgnaW5wdXRbaWQ9XCJ1cGRhdGVfdXNlcl9wYXNzd29yZF9wbGFpblBhc3N3b3JkX2ZpcnN0XCJdJyk7XG4gICAgbGV0IHVwZGF0ZVBhc3NUaGlyZElucHV0ID0gJCgnaW5wdXRbaWQ9XCJ1cGRhdGVfdXNlcl9wYXNzd29yZF9wbGFpblBhc3N3b3JkX3NlY29uZFwiXScpO1xuXG4gICAgLy8gR2V0dGluZyBUYWIgYW5kIHRoZWlyIHRpdGxlXG4gICAgbGV0IGVkaXRVc2VyVGFiID0gJCgnZGl2W2lkPVwiZWRpdC11c2VyXCJdJyk7XG4gICAgbGV0IHVwZGF0ZVBhc3NUYWIgPSAkKCdkaXZbaWQ9XCJ1cGRhdGUtcGFzc1wiXScpO1xuICAgIGxldCBlZGl0VXNlclRhYlRpdGxlID0gJCgnYVtocmVmPVwiI2VkaXQtdXNlclwiXScpO1xuICAgIGxldCB1cGRhdGVQYXNzVGFiVGl0bGUgPSAkKCdhW2hyZWY9XCIjdXBkYXRlLXBhc3NcIl0nKTtcblxuICAgIGlmICh1cGRhdGVQYXNzRmlyc3RJbnB1dC5oYXNDbGFzcyhcImlzLWludmFsaWRcIikgfHxcbiAgICAgICAgdXBkYXRlUGFzc1NlY29uZElucHV0Lmhhc0NsYXNzKFwiaXMtaW52YWxpZFwiKSB8fFxuICAgICAgICB1cGRhdGVQYXNzU2Vjb25kSW5wdXQuaGFzQ2xhc3MoXCJpcy1pbnZhbGlkXCIpKSB7XG4gICAgICAgIGVkaXRVc2VyVGFiLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICBlZGl0VXNlclRhYlRpdGxlLnJlbW92ZUNsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICB1cGRhdGVQYXNzVGFiLmFkZENsYXNzKFwiYWN0aXZlXCIpO1xuICAgICAgICB1cGRhdGVQYXNzVGFiVGl0bGUuYWRkQ2xhc3MoXCJhY3RpdmVcIik7XG4gICAgfVxuICAgIC8vY29uc29sZS5sb2codXBkYXRlUGFzc1swXVsxXSk7XG59KTsiXSwibmFtZXMiOlsiJCIsInJlcXVpcmUiLCJkb2N1bWVudCIsInJlYWR5IiwidXBkYXRlUGFzc0ZpcnN0SW5wdXQiLCJ1cGRhdGVQYXNzU2Vjb25kSW5wdXQiLCJ1cGRhdGVQYXNzVGhpcmRJbnB1dCIsImVkaXRVc2VyVGFiIiwidXBkYXRlUGFzc1RhYiIsImVkaXRVc2VyVGFiVGl0bGUiLCJ1cGRhdGVQYXNzVGFiVGl0bGUiLCJoYXNDbGFzcyIsInJlbW92ZUNsYXNzIiwiYWRkQ2xhc3MiXSwic291cmNlUm9vdCI6IiJ9