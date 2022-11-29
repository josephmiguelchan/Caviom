$(function () {

    Inputmask("+632 8999 9999").mask(document.getElementById("tel_no"));
    Inputmask("+63 \\999 999 9999").mask(document.getElementById("cel_no"));
    Inputmask("9999").mask(document.getElementById("postal_code"));
    Inputmask("9999999999").mask(document.getElementById("organizational_id_no"));
    Inputmask("+632 8999 9999").mask(document.getElementById("contact_no"));

});