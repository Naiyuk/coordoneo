$(function () {
    const nameMinLength = 3;
    const nameMaxLength = 40;
    const nameRegex = new RegExp("^[a-zA-Z]+(([ -][a-zA-Z ])?[a-zA-Z]*)*$");

    const firstNameMinLength = 3;
    const firstNameMaxLength = 40;
    const firstNameRegex = new RegExp("^[a-zA-Z]+(([ -][a-zA-Z ])?[a-zA-Z]*)*$");

    const addressMinLength = 7;
    const addressMaxLength = 80;
    const addressRegex = new RegExp("^[0-9]( [a-zA-Z]+)*$");

    const postalCodeLength = 5;
    const postalCodeRegex = new RegExp("^[0-9]{5}$");

    const cityMinLength = 2;
    const cityMaxLength = 50;
    const cityRegex = new RegExp("^[a-zA-ZÀ-ÿa-ÿ]+(([ -][a-zA-ZÀ-ÿa-ÿ ])?[a-zA-ZÀ-ÿa-ÿ]*)*$");

    const countryMinLength = 4;
    const countryMaxLength = 20;
    const countryRegex = new RegExp("^[a-zA-Z]+$");

    const emailMinLength = 7;
    const emailMaxLength = 70;
    const emailRegex = new RegExp("^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$");

    var name = $("#name");
    var firstName = $("#firstName");
    var address = $("#address");
    var postalCode = $("#postalCode");
    var city = $("#city");
    var country = $("#country");
    var email = $("#email");

    function formSubmit() {
        $("#clientForm").submit();
    }

    function validateName(name) {
        if (name.length < nameMinLength) {
            $("#nameError").text("Le nom doit contenir " + nameMinLength + " caractères minimums");
            return false;
        }

        if (name.length > nameMaxLength) {
            $("#nameError").text("Le nom doit contenir " + nameMaxLength + " caractères maximums");
            return false;
        }

        if (!nameRegex.test(name)) {
            $("#nameError").text("Seuls les lettres, tirets et espaces sont autorisés");
            return false;
        }

        $("#nameError").text("");
        return true;
    }

    function validateFirstName(firstName) {
        if (firstName.length < firstNameMinLength) {
            $("#firstNameError").text("Le prénom doit contenir " + firstNameMinLength + " caractères minimums");
            return false;
        }

        if (firstName.length > firstNameMaxLength) {
            $("#firstNameError").text("Le prénom doit contenir " + firstNameMaxLength + " caractères maximums");
            return false;
        }

        if (!firstNameRegex.test(firstName)) {
            $("#firstNameError").text("Seuls les lettres, tirets et espaces sont autorisés");
            return false;
        }

        $("#firstNameError").text("");
        return true;
    }

    function validateAddress(address) {
        if (address.length < addressMinLength) {
            $("#addressError").text("L'adresse doit contenir " + addressMinLength + " caractères minimums");
            return false;
        }

        if (address.length > addressMaxLength) {
            $("#addressError").text("L'adresse doit contenir " + addressMaxLength + " caractères maximums");
            return false;
        }

        if (!addressRegex.test(address)) {
            $("#addressError").text("Adresse invalide");
            return false;
        }

        $("#addressError").text("");
        return true;
    }

    function validatePostalCode(postalCode) {
        if (postalCode.length != postalCodeLength) {
            $("#postalCodeError").text("Le code postal doit contenir " + postalCodeLength + " caractères");
            return false;
        }

        if (!postalCodeRegex.test(postalCode)) {
            $("#postalCodeError").text("Code postal invalide");
            return false;
        }

        $("#postalCodeError").text("");
        return true;
    }

    function validateCity(city) {
        if (city.length < cityMinLength) {
            $("#cityError").text("La ville doit contenir " + cityMinLength + " caractères minimums");
            return false;
        }

        if (city.length > cityMaxLength) {
            $("#cityError").text("La ville doit contenir " + cityMaxLength + " caractères maximums");
            return false;
        }

        if (!cityRegex.test(city)) {
            $("#cityError").text("Ville invalide");
            return false;
        }

        $("#cityError").text("");
        return true;
    }

    function validateCountry(country) {
        if (country.length < countryMinLength) {
            $("#countryError").text("Le pays doit contenir " + countryMinLength + " caractères minimums");
            return false;
        }

        if (country.length > countryMaxLength) {
            $("#countryError").text("Le pays doit contenir " + countryMaxLength + " caractères maximums");
            return false;
        }

        if (!countryRegex.test(country)) {
            $("#countryError").text("Seuls les lettres sont autorisés");
            return false;
        }

        $("#countryError").text("");
        return true;
    }

    function validateEmail(email) {
        if (email.length < emailMinLength) {
            $("#emailError").text("L'email doit contenir " + emailMinLength + " caractères minimums");
            return false;
        }

        if (email.length > emailMaxLength) {
            $("#emailError").text("L'email doit contenir " + emailMaxLength + " caractères maximums");
            return false;
        }

        if (!emailRegex.test(email)) {
            $("#emailError").text("Adresse email invalide");
            return false;
        }

        $("#emailError").text("");
        return true;
    }

    function validateForm() {
        let validName = validateName(name.val());
        let validFirstName = validateFirstName(firstName.val());
        let validAddress = validateAddress(address.val());
        let validPostalCode = validatePostalCode(postalCode.val());
        let validCity = validateCity(city.val());
        let validCountry = validateCountry(country.val());
        let validEmail = validateEmail(email.val());

        let results = [
            validName,
            validFirstName,
            validAddress,
            validPostalCode,
            validCity,
            validCountry,
            validEmail
        ];

        if ($.inArray(false, results) !== -1) {
            return false;
        }

        return true;
    }

    $("input").each(function () {
        let inputName = $(this).attr("name"); 
        let error = $("<span class='invalid-feedback d-block'></span>");
        let errorId = inputName + 'Error';

        error.attr('id', errorId);

        $(this).after(error);
    });

    let errorAddress = $("<span class='invalid-feedback d-block'></span>");
    let errorId = 'addressError';

    errorAddress.attr('id', errorId);

    $('#address').after(errorAddress);

    window.formSubmit = formSubmit;

    var name = $("#name");
    var firstName = $("#firstName");
    var address = $("#address");
    var postalCode = $("#postalCode");
    var city = $("#city");
    var country = $("#country");
    var email = $("#email");

    name.on("keyup blur", function () {
        validateName($(this).val());
    });

    firstName.on("keyup blur", function () {
        validateFirstName($(this).val());
    });

    address.on("keyup blur", function () {
        validateAddress($(this).val());
    });

    postalCode.on("keyup blur", function () {
        validatePostalCode($(this).val());
    });

    city.on("keyup blur", function () {
        validateCity($(this).val());
    });

    country.on("keyup blur", function () {
        validateCountry($(this).val());
    });

    email.on("keyup blur", function () {
        validateEmail($(this).val());
    });

    $("#clientFormBtn").click(function (event) {
        event.preventDefault();
        if (validateForm()) {
            grecaptcha.reset();
            grecaptcha.execute();
        }
    });
});