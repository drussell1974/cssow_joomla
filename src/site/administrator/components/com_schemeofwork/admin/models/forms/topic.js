jQuery(function () {
    /* Add validators here*/
    document.formvalidator.setHandler('TopicName',
            function (value) {
                regex = /^[a-zA-Z0-9 ,]{1,45}$/;
                return regex.test(value);
            });
});