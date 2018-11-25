jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('PlayBasedObjectiveName',
            function (value) {
                regex = /^[A-Za-z0-9 -]{1,100}$/;
                return regex.test(value);
            });
});