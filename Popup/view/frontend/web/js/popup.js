define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/cookies'
], function ($, model) {
    'use strict';

    return function (settings){
        const  content = settings.content,
            timeout = settings.timeout,
            cookieName = 'learning_popup_offered';

        // if($.mage.cookie.get(cookieName)) {
        //     return;
        // }

        const options = {
            type: 'popup',
            responsive: true,
            autoOpen: true,
            // modalClass: 'learning_popup',
            // popupTpl: template,
            closed: function (){
                 const date = new  Date();
                 const thirtyDaysInMinutes = 43200;
                 date.setTime(date.getTime() + (thirtyDaysInMinutes * 60 * 1000));
                 $.mage.cookie.set(cookieName, 1, {expires: date})
            }
        };

        setTimeout(function (){
            $('<div />').html(content).modal(options);

        }, timeout * 1000);
    }
})
