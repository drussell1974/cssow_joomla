jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('ExamBoardName',
            function (value) {
                regex = /^[a-zA-Z0-9 ,/:]{1,15}$/;
                return regex.test(value);
            });
});