jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('PathwayName',
            function (value) {
                regex = /^[a-zA-Z0-9 ,:]{1,1000}$/;
                return regex.test(value);
            });
});