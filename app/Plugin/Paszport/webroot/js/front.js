jQuery(document).ready(function () {
    var $form = jQuery('#UserAddForm'),
        $AccountType = jQuery('#AccountType'),
        $UserGroupId = jQuery('#UserGroupId'),
        typeId = $AccountType.find('ul li:first').attr('data-group');

    $UserGroupId.val(typeId);

    $AccountType.find('ul li a').click(function (e) {
        var $that = jQuery(this),
            name = $that.text(),
            typeId = $that.parent().attr('data-group');
        e.preventDefault();

        $UserGroupId.val(typeId);
        $AccountType.find('.btn-group > a').get(0).firstChild.nodeValue = name + " ";
        $form.find('.groupType').addClass('hidden').find('input').addClass('disabled').attr('disabled', 'disabled');
        $form.find('.groupType[rel="' + typeId + '"]').removeClass('hidden').find('input').removeClass('disabled').removeAttr('disabled');
    });

    if (jQuery('.createAccount, .userHelper').length) {
        jQuery('.createAccount form, .userHelper form').each(function () {
            jQuery(this).find('input').jqBootstrapValidation();
        });
    }
});