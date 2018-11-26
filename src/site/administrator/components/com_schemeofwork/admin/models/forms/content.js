sjQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('ContentDescription',
            function (value) {
                regex = /^[a-zA-Z0-9,.!? ]*$/;
                return regex.test(value);
            });
            
    document.formvalidator.setHandler('ContentLetter',
            function (value) {
                regex = /^[A-Z]{1}$/;
                return regex.test(value);
            });
});