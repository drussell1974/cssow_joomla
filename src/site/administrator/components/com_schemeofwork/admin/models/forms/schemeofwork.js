jQuery(function() {
    document.formvalidator.setHandler('schemeofwork',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});