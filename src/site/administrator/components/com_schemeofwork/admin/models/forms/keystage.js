jQuery(function() {
    /* Add validators here*/
    document.formvalidator.setHandler('KeyStageName',
        function (value) {
            regex=/^[A-Za-z0-9]{1,3}$/;
            return regex.test(value);
        });
});