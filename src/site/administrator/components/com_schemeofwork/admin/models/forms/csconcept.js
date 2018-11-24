jQuery(function() {
    /* Add validators here*/
    document.formvalidator.setHandler('CSConceptName',
        function (value) {
            regex=/^[A-Za-z0-9]{1,20}$/;
            return regex.test(value);
        });
        
    document.formvalidator.setHandler('CSConceptAbbr',
        function (value) {
            regex=/^[A-Z]{2}$/;
            return regex.test(value);
        });
});