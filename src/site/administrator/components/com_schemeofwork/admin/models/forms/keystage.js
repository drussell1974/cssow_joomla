jQuery(function() {
    document.formvalidator.setHandler('KeyStageName',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});