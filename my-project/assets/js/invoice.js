document.querySelectorAll('input[name="ingredientes[]"]').forEach(function(elem) {
    elem.addEventListener('change', function() {
        actualizarPrecioTotal();
    });
});


function actualizarPrecioTotal() {
    var precioBase = parseFloat('{{ selectedPizza.getPrice() }}');
    var precioTotal = precioBase;

    document.querySelectorAll('input[name="ingredientes[]"]:checked').forEach(function(elem) {
        precioTotal += parseFloat(elem.dataset.precio);
    });

    var descuento = 0.5;
    precioTotal = precioTotal * (1 + descuento);

    document.querySelector('#precio-total').textContent = 'Precio total: ' + precioTotal.toFixed(2) + ' €';
}
