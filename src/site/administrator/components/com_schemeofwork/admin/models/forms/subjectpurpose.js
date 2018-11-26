jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('SubjectPurposeName',
            function (value) {
                regex = /^[a-zA-Z0-9-, .:;\']{1,20}$/;
                return regex.test(value);
            });
});