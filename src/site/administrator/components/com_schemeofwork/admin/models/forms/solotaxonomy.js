jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('SoloTaxonomyName',
            function (value) {
                regex = /^[a-zA-Z0-9-, .]{1,100}$/;
                return regex.test(value);
            });
    document.formvalidator.setHandler('SoloTaxonomyLevel',
            function (value) {
                regex = /^[0-9]{1,3}$/;
                return regex.test(value);
            });
});