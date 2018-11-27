jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('LearningObjectiveName',
            function (value) {
                regex = /^[a-zA-Z0s-9 /,/:/./;/[/]]{1,1000}$/;
                return regex.test(value);
            });
});