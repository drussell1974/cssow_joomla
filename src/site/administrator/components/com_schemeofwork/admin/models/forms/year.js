jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('YearName',
            function (value) {
                regex = /^[a-zA-Z0-9]{1,4}$/;
                return regex.test(value);
            });
});