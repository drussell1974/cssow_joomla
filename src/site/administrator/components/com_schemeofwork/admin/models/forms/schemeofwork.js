/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function() {
    document.formvalidator.setHandler('greeting',
        function (value) {
            regex=/^[^0-9]+$/;
            return regex.test(value);
        });
});