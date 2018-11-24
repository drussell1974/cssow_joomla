jQuery(function() {
    /* Add validators here*/
    document.formvalidator.setHandler('CSConceptName',
        function (value) {
            regex=/^[A-Za-z0-9]{1,25}$/;
            return regex.test(value);
        });
});