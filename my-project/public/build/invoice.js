(self["webpackChunkinvoice"] = self["webpackChunkinvoice"] || []).push([["invoice"],{

/***/ "./assets/js/invoice.js":
/*!******************************!*\
  !*** ./assets/js/invoice.js ***!
  \******************************/
/***/ (() => {

document.querySelectorAll('input[name="ingredientes[]"]').forEach(function (elem) {
  elem.addEventListener('change', function () {
    actualizarPrecioTotal();
  });
});
function actualizarPrecioTotal() {
  var precioBase = parseFloat('{{ selectedPizza.getPrice() }}');
  var precioTotal = precioBase;
  document.querySelectorAll('input[name="ingredientes[]"]:checked').forEach(function (elem) {
    precioTotal += parseFloat(elem.dataset.precio);
  });
  var descuento = 0.5;
  precioTotal = precioTotal * (1 + descuento);
  document.querySelector('#precio-total').textContent = 'Precio total: ' + precioTotal.toFixed(2) + ' €';
}

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./assets/js/invoice.js"));
/******/ }
]);