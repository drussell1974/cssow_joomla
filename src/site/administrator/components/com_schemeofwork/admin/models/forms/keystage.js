jQuery(function() {
    document.formvalidator.setHandler('schemeofworkname',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});