// window.allMonths = ['Янв.', 'Фев.', 'Март', 'Апр.', 'Май', 'Июнь', 'Июль', 'Авг.', 'Сент.', 'Окт.', 'Нояб.', 'Декаб.'];
// window.statisticsData = [];
$(document).ready(function () {
    $(".radio-input").bootstrapSwitch();
    // Phone mask
    $.mask.definitions['n'] = "[7-8]";
    $('input[name=phone]').mask("+n(999)999-99-99");

    CKEDITOR.replaceClass = 'ckeditor';
    $('.styled').uniform();

    // File input
    $(".file-styled").uniform({
        wrapperClass: 'bg-blue',
        fileButtonHtml: '<i class="icon-file-plus"></i>'
    });

    $(window).resize(function () {
        divImage();
    });
    divImage();

    // Single picker
    // $('.daterange-single').daterangepicker({
    //     singleDatePicker: true,
    //     locale: {
    //         format: 'DD/MM/YYYY',
    //         monthNames : ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    //         daysOfWeek : ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    //         week: moment.locale('en', {
    //             week: { dow: 1 }
    //         })
    //     }
    // });

    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{
            targets: [window.dtRows + 1]
        }],
        order: [],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Фильтр:</span> _INPUT_',
            lengthMenu: '<span>Показывать:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' },
            emptyTable: 'Нет данных',
            info: 'Показано с _START_ по _END_ из _TOTAL_',
            infoEmpty: 'Показано с 0 по 0 из 0',
            infoFiltered:   '(Фильтровать от _MAX_ общего числа)',
            thousands:      ',',
            loadingRecords: 'Загрузка...',
            zeroRecords:    'Нет данных',
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    // Basic datatable
    window.dataTable = $('.datatable-basic').DataTable();

    // Message modal
    window.messageModal = $('#message-modal');

    // Alternative pagination
    // $('.datatable-pagination').DataTable({
    //     pagingType: "simple",
    //     language: {
    //         paginate: {'next': 'Next &rarr;', 'previous': '&larr; Prev'}
    //     }
    // });

    // Preview upload image
    $('input[type=file]').change(function () {
        let input = $(this)[0],
            parent = $(this).parents('.edit-image-preview'),
            imagePreview = parent.find('div.image[img]'),
            imageFull = parent.find('a.fancybox');

        console.log(imageFull.length);

        if (input.files[0].type.match('image.*')) {
            let reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.attr('img', e.target.result);
                divImage();
                imageFull.attr('href', e.target.result);
                if (!imagePreview.is(':visible')) imagePreview.fadeIn();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.attr('img','/images/placeholder.jpg');
            divImage();
        }
    });

    // Click to delete items
    window.deleteId = null;
    window.deleteRow = null;

    // Events of data-table
    bindChangePagination();
    bindDelete();
    bindFancybox();

    // Click YES on delete modal
    $('.delete-yes').click(function () {
        let deleteModal = $(this).parents('.modal');
        deleteModal.modal('hide');
        addLoader();

        $.post(deleteModal.attr('del_function'), {
            '_token': $('input[name=_token]').val(),
            'id': window.deleteId,
        }).done(
            function (data) {
                // dTable.row(window.deleteRow).remove();
                // window.deleteRow.remove();
                if (window.deleteRow.parents('table').hasClass('datatable-basic')) deleteDataTableRows();
                else window.deleteRow.remove();
                // dTable.draw();
                bindDelete();
                window.messageModal.find('h4').html(data.message);
            }
        ).fail(
            function (data) {
                window.messageModal.find('h4').html(data.responseJSON.message);
            }
        ).always(function() {
            removeLoader();
            window.messageModal.modal('show');
        });
    });

    // Copy to clipboard image path
    $('.table-items td.cb-copy > i').click(function () {
        let path = $(this).parents('tr').find('td.image-path').html();
        navigator.clipboard.writeText(path)
            .then(() => {
                alert('Путь скопирован!');
            });
    });
});

const deleteDataTableRows = () => {
    window.dataTable.row(window.deleteRow).remove();
    window.dataTable.draw();
    bindChangePagination();
    bindDelete();
    bindFancybox();
}

const bindChangePagination = () => {
    let paginationEvent = ('draw.dt');
    window.dataTable.off(paginationEvent);
    window.dataTable.on(paginationEvent, function () {
        bindDelete();
        bindFancybox();
    });
}

const bindDelete = () => {
    let deleteIcon = $('.glyphicon-remove-circle');
    deleteIcon.unbind();
    deleteIcon.click(function () {
        let deleteModal = $('#' + $(this).attr('modal-data')),
            inputId = deleteModal.find('input[name=id]');

        window.deleteId = $(this).attr('del-data');
        window.deleteRow = $(this).parents('tr');

        if (inputId.length) inputId.val(window.deleteId);
        deleteModal.modal('show');
    });
}

const bindFancybox = () => {
    // Fancybox init
    $('.fancybox').fancybox({
        'autoScale': true,
        'touch': false,
        'transitionIn': 'elastic',
        'transitionOut': 'elastic',
        'speedIn': 500,
        'speedOut': 300,
        'autoDimensions': true,
        'centerOnScroll': true
    });
}

const divImage = () => {
    $('div.image[img]').each(function () {
        $(this).css({
            'height': $(this).width(),
            'background-image': 'url('+ $(this).attr('img') +')'
        });
    });
}
