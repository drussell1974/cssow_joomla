jQuery(function() {
    document.formvalidator.setHandler('name',
        function (value) {
            regex= /^\s+$/;
            return regex.test(value);
        });
});