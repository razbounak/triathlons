/**
 * Created by FCWD on 12/08/2016.
 */
jQuery(function ($) {
    var alert = $('#alert');
    if(alert.length > 0) {
        alert.hide().slideDown(500).delay(5000).slideUp();
    }
});