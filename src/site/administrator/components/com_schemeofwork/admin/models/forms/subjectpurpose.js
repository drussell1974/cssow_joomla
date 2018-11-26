jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('SubjectPurposeName',
            function (value) {
                regex = /^[A-Za-z0-9 -]{1,20}$/;
                return regex.test(value);
            });
});