jQuery(function() {
    document.formvalidator.setHandler('name',
        function (value) {
            regex=/^[A-Za-z0-9 -]{1,100}$/;
            return regex.test(value);
        });
});