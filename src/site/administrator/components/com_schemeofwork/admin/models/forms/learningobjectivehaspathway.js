jQuery(function() {
    /* Add validators here*/
    document.formvalidator.setHandler('LearningObjectiveHaspPathwayComment',
        function (value) {
            regex=/^[a-zA-Z0-9 ,:.]{0,500}$/;
            return regex.test(value);
        });
});