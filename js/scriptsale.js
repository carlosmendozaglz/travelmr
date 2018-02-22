$(document).ready(function () {
    loadFormPasajeros();
});

function loadFormPasajeros(){
    $("#tab-pasajeros").load(SALE_PASSENGERS_FORM);
}

