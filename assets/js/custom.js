(function ($) {
    $('document').ready(function () {

        //on click show popup
        $('.notionhive-black-header-button').on('click', function (e) {
            e.preventDefault();
            $('.notionhive-form-wrapper').show();
        });

        //on click hide popup
        $('.notionhive-contact-popup-close').on('click', function (e) {
            e.preventDefault();

            $('.notionhive-form-wrapper').hide();

        });


        //on change services from list total number updated
        $(document).on('change', '.package-check', function (e) {

            var total_price = 0;
            var services = '';
            var services_arr = [];
            $('.box-field').each(function (item) {
                var price = $(this).find('input[type="checkbox"]:checked').data('price');
                var service = $(this).find('input[type="checkbox"]:checked').data('service');



                if (price !== undefined) {
                    services_arr.push(service);
                    total_price += parseInt(price);
                    services += ' ' + service;
                }

            });


            $('.total-amount #total .abs-total').text(total_price);

            $('.notionhive-package-form-wrapper nf-field:nth-child(3) input[type="text"]').val(services);
            $('.notionhive-package-form-wrapper nf-field:nth-child(4) input[type="text"]').val("$" + total_price);


            //update form style
            $('.notionhive-package-form-wrapper nf-field:nth-child(5) ul li').each(function (e) {
                var form_service = $(this).find('input[type="checkbox"]').val();

                if (services_arr.includes(form_service)) {

                    $(this).find('input[type="checkbox"]').addClass('nf-checked');
                    $(this).find('label').addClass('nf-checked-label');
                }
            });

        });

        // on form checkbox change update package form
        $(document).on('change', '.notionhive-package-form-wrapper nf-field input[type="checkbox"]', function (e) {

            var services = '';
            var services_arr = [];
            $('.notionhive-package-form-wrapper nf-field:nth-child(5) ul li').each(function (e) {

                if ($(this).find('input[type="checkbox"]').is('.nf-checked')) {
                    var service = $(this).find('input[type="checkbox"]').val();
                    services_arr.push(service);
                    services += ' ' + service;
                }

            });

            $('.notionhive-package-form-wrapper nf-field:nth-child(3) input[type="text"]').val(services);

            $('.box-field input[type="checkbox"]').attr('checked', false);
            var total_price = 0;
            $('.box-field').each(function (item) {
                var box_service = $(this).find('input[type="checkbox"]').data('service');
                console.log(services_arr);
                if (services_arr.includes(box_service)) {
                    var price = $(this).find('input[type="checkbox"]').data('price');
                    total_price += parseInt(price);
                    $(this).find('input[type="checkbox"]').attr('checked', 'checked');
                }
            });

            $('.total-amount #total .abs-total').text(total_price);
            $('.notionhive-package-form-wrapper nf-field:nth-child(4) input[type="text"]').val("$" + total_price);

        });



    });

})(jQuery);