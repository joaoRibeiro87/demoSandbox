(self["webpackChunk"] = self["webpackChunk"] || []).push([["ibexa-product-catalog-category-products-list-js"],{

/***/ "./vendor/ibexa/product-catalog/src/bundle/Resources/public/js/base.list.js":
/*!**********************************************************************************!*\
  !*** ./vendor/ibexa/product-catalog/src/bundle/Resources/public/js/base.list.js ***!
  \**********************************************************************************/
/***/ (() => {

function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
(function (global, doc) {
  var inputsTriggeringSubmitOnChange = doc.querySelectorAll('.ibexa-pc-search__input--trigger-submit-after-change');
  var removeBtn = doc.querySelector('.ibexa-pc-data-grid__delete-btn');
  var copyBtns = doc.querySelectorAll('.ibexa-pc-data-grid__copy-btn');
  var markRowCheckboxes = doc.querySelectorAll('.ibexa-pc-data-grid__mark-row-checkbox');
  var searchForm = doc.querySelector('.ibexa-pc-search__form');
  var searchSortOrderSelect = doc.querySelector('.ibexa-pc-search__sort-order-select');
  var dataGridSortOrderSelect = doc.querySelector('.ibexa-pc-data-grid__sort-order-select');
  var setRemoveBtnState = function setRemoveBtnState() {
    var isAnyCheckboxSelected = _toConsumableArray(markRowCheckboxes).some(function (checkbox) {
      return checkbox.checked;
    });
    removeBtn.toggleAttribute('disabled', !isAnyCheckboxSelected);
  };
  var sortResults = function sortResults(_ref) {
    var currentTarget = _ref.currentTarget;
    var sortOrderValue = currentTarget.value;
    searchSortOrderSelect.value = sortOrderValue;
    searchForm.submit();
  };
  var setSourceIdValue = function setSourceIdValue(_ref2) {
    var currentTarget = _ref2.currentTarget;
    var _currentTarget$datase = currentTarget.dataset,
      copySourceId = _currentTarget$datase.copySourceId,
      targetInputSelector = _currentTarget$datase.targetInputSelector;
    var targetInput = doc.querySelector(targetInputSelector);
    targetInput.value = copySourceId;
  };
  markRowCheckboxes.forEach(function (checkbox) {
    return checkbox.addEventListener('change', setRemoveBtnState, false);
  });
  inputsTriggeringSubmitOnChange.forEach(function (input) {
    input.addEventListener('change', function () {
      searchForm.submit();
    }, false);
  });
  copyBtns.forEach(function (copyBtn) {
    copyBtn.addEventListener('click', setSourceIdValue, false);
  });
  if (searchSortOrderSelect && dataGridSortOrderSelect) {
    dataGridSortOrderSelect.addEventListener('change', sortResults, false);
  }
})(window, window.document);

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./vendor/ibexa/product-catalog/src/bundle/Resources/public/js/base.list.js"));
/******/ }
]);