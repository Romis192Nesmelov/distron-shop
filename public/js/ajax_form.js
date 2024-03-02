$(document).ready(function ($) {
    const noProducts = $('#no-products'),
        basketCheckout = $('#checkout'),
        basketTable = $('#basket-table'),
        basketCir = $('#basket .cir'),
        basketTotal = $('#basket-total span'),
        mainButton = $('#main-button'),
        newOrderModal = $('#new-order-modal'),
        basketModal = $('#basket-modal');

    processingForm($('#form-feedback-full'), true,false);
    processingForm($('#form-feedback-short'), true,false);
    processingForm($('#login-form'), true, false, (data) => {
        mainButton.find('span').html(window.accountText);
        window.guest = false;

        $.get(getNewCsrfUrl, (data) => {
            $('input[name=_token]').val(data.token);
        });

        bindMainButton();
        $('#login-modal').remove();
        $('#register-modal').remove();
        $('#reset-password-modal').remove();

        newOrderModal.find('input[name=phone]').val(data.phone);
        newOrderModal.find('input[name=address]').val(data.address);

        if (window.tryCheckout) basketModal.modal('show');
    });
    processingForm($('#register-form'), true,false);
    processingForm($('#reset-password-form'), true,false);
    processingForm($('#account-form'), false, true);
    processingForm($('#add-to-basket'), false,false, (data) => {
        let basketRow = $('#basket-row-' + data.id);

        if (!basketRow.length) {
            if (basketCheckout.hasClass('d-none')) {
                noProducts.addClass('d-none');
                basketCheckout.removeClass('d-none');
                basketCir.removeClass('d-none');
                basketRow = basketTable.find('tr');
            } else {
                basketRow = basketTable.find('tr').last().clone();
                basketRow.attr('id','basket-row-' + data.id);
                basketTable.append(basketRow);
                bindCounterChange();
            }
        }

        let basketProps = basketRow.find('.basket-props');

        basketRow.find('input.basket-id').val(data.id);
        basketRow.find('.basket-name').html(data.name);

        if (data.props) basketProps.removeClass('d-none').find('small').html(data.props);
        else basketProps.addClass('d-none').html('');

        basketRow.find('input.basket-value').val(data.value);
        basketRow.find('.basket-price span').html(data.price);
        basketCir.html(basketTable.find('tr').length);
        basketTotal.html(tolocalstring(data.total));
    });

    processingForm(basketCheckout, false,true, (data) => {
        basketTable.find('tr').each(function () {
            if (!parseInt($(this).find('input.basket-value').val())) $(this).remove();
        });
        if (basketTable.find('tr').length) {
            basketCir.html(basketTable.find('tr').length);
            basketTotal.html(tolocalstring(data.total));
        } else {
            noProducts.removeClass('d-none');
            basketCheckout.addClass('d-none');
            basketCir.addClass('d-none');
            basketCir.html('0');
            basketTotal.html('0');
        }
        if (!window.guest) newOrderModal.modal('show');
    });

    processingForm($('#new-order'), false,true, (data) => {
        let basketRow = basketTable.find('tr').last().clone();
        basketTable.empty();
        basketTable.append(basketRow);
        basketCheckout.addClass('d-none');
        noProducts.removeClass('d-none');
        basketCir.html('0');
        basketCir.addClass('d-none');
    });
});

const processingForm = (form, resetInputs, checkGuest, callback) => {
    const body = $('body'),
        agree = $('input[name=i_agree]');

    agree.change(function () {
        let button = $(this).parents('form').find('button[type=submit]');
        if (agree.is(':checked')) button.removeAttr('disabled');
        else button.attr('disabled','disabled');
    });

    form.on('submit', function(e) {
        e.preventDefault();
        if (!checkGuest || (checkGuest && !window.guest)) {
            let formData = new FormData,
                inputError = form.find('input.error'),
                textError = form.find('.error');

            // if (!agree.is(':checked')) return false;

            form.find('input, textarea, select').each(function () {
                let self = $(this);
                if (self.attr('type') === 'file') formData.append(self.attr('name'), self[0].files[0]);
                else if (self.attr('type') === 'checkbox' || self.attr('type') === 'radio') formData = processingCheckFields(formData, self);
                else formData = processingFields(formData, self);
            });

            $('div.error').css('display', 'none').html('');
            inputError.removeClass('error');
            textError.html('');
            form.find('input, select, textarea, button').attr('disabled', 'disabled');
            // addLoader();

            $.ajax({
                url: form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                type: form.attr('method'),
                success: function (data) {
                    // form.modal('hide');
                    unlockAll(body, form);
                    if (resetInputs) form.find('input, textarea').val('');
                    inputError.removeClass('error');

                    $('.modal').modal('hide');
                    $('.event-block .roll-up').css('height', 0);

                    if (data.message) {
                        const messageModal = $('#message-modal');
                        messageModal.find('h4').html(data.message);
                        messageModal.modal('show');
                    }
                    if (callback) callback(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    let response = jQuery.parseJSON(jqXHR.responseText),
                        replaceErr = {
                            'password': '«Пароль»',
                            'phone': '«Телефон»',
                            'email': '«E-mail»',
                            'name': '«Имя»',
                            'address': '«Адрес»'
                        };

                    $.each(response.errors, function (field, errorMsg) {
                        let errorBlock = form.find('.error.' + field),
                            errorInput = form.find('input[name=' + field + ']');

                        errorMsg = errorMsg[0];
                        $.each(replaceErr, function (src, replace) {
                            errorMsg = errorMsg.replace(src, replace);
                        });

                        errorBlock.css('display', 'block').html(errorMsg);
                        errorInput.addClass('error');
                    });
                    unlockAll(body, form);
                }
            });
        }
    });
}

const processingFields = (formData, inputObj) => {
    if (inputObj.length) {
        $.each(inputObj, function (key, obj) {
            if (obj.type !== 'checkbox' && obj.type !== 'radio') {
                formData.append(obj.name,obj.value);
            }
        });
    }
    return formData;
}

const processingCheckFields = (formData, inputObj) => {
    if (inputObj.length) {
        inputObj.each(function(){
            var _self = $(this);
            if(_self.is(':checked')) {
                formData.append(_self.attr('name'),_self.val());
            }
        });
    }
    return formData;
}

const unlockAll = (body,form) => {
    form.find('input, select, textarea, button').removeAttr('disabled');
    body.css({
        'overflow-y':'auto',
        'padding-right':0
    });
}
