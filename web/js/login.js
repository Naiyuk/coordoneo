$(function () {
    function formSubmit() {
        $("#loginForm").submit();
    }

    window.formSubmit = formSubmit;

    $("#loginFormBtn").click(function (event) {
        event.preventDefault();
        grecaptcha.reset();
        grecaptcha.execute();
    });
});