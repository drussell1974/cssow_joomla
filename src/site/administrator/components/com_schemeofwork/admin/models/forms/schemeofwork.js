jQuery(function() {
    document.formvalidator.setHandler('name',
        function (value) {
            regex=/^[A-Za-z0-9 -_]{1,25}$/;
            return regex.test(value);
        });
});