jQuery(document).ready(function () {
    //jQuery('.voucher_block').hide();
    jQuery("#crd_card_link").on("click", function () {
        jQuery('.credit_card_block').show();
        jQuery('.voucher_block').hide();
    });

    jQuery("#voucher_link").on("click", function () {
        jQuery('.credit_card_block').hide();
        jQuery('.voucher_block').show();
    });
});



