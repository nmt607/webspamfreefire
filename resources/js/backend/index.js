import 'bootstrap'
window.bootstrap = require("bootstrap");
import $ from 'jquery'
import toastr from 'toastr'
import 'jquery-ui/ui/widgets/datepicker'
import 'jquery-ui/themes/base/core.css'
import 'jquery-ui/themes/base/datepicker.css'
import 'jquery-ui/themes/base/theme.css'

$(function () {



    // get search param then edit input date picker
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    })
    if (params.fromDate) {
        $('.from-date--js').val(params.fromDate)
        $('.to-date--js').val(params.toDate)
        //check filter status
        $('.filter-status--js').addClass('show')

    } else {
        //check filter status
        $('.filter-status--js').removeClass('show')
    }
    // download func and reload page
    $('.download-btn--js').on('click', function () {
        let newUrl = window.location.origin + window.location.pathname + "/download" + window.location.search
        window.location.href = newUrl
    })
    // submit filter date
    $(".filter-date--js").on('submit', function (e) {
        e.preventDefault()
        let inputFromValue = $(this).find('#fromDate').val()
        let inputToValue = $(this).find('#toDate').val()
        if (inputFromValue && inputToValue) {
            $(this)[0].submit()
        } else if (!inputFromValue && !inputToValue) {
            window.location = "admin"
            // $(this)[0].submit()
        } else {
            toastr.options = {
                "positionClass": "toast-bottom-left",
                "closeButton": true,
                "progressBar": true,
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["info"]("Bạn cần chọn thêm ngày tháng", "Thông báo")
        }

    })
    // reset filter date
    $(".filter-date--js").on('reset', function () {
        let inputFromValue = $(this).find('#fromDate').val()
        let inputToValue = $(this).find('#toDate').val()
        if (inputFromValue || inputToValue) {
            toastr.options = {
                "positionClass": "toast-bottom-left",
                "closeButton": true,
                "progressBar": true,
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"]("Đã xóa bộ lọc thành công", "Thành công")
        } else {
            toastr.options = {
                "positionClass": "toast-bottom-left",
                "closeButton": true,
                "progressBar": true,
                "preventDuplicates": true,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["info"]("Không có gì để xóa <br> Chọn ngày để thực hiện chức năng lọc", "Thông báo")
        }
    })
});

// initialize tooltips bootstrap 5
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

// filter dropdown menu
$('.date-dropdown-btn--js').on('click', function () {
    $('.datepicker-dropdown-menu--js').toggleClass('show')
    $('.date-dropdown-btn-icon--js').toggleClass('icon-date-filter-rotate180')
})
$('.datepicker-dropdown-menu--js').on('click', function (e) {
    e.stopPropagation()
})

// jquery ui date picker
$(function () {
    var dateFormat = 'yy-mm-dd',
        from = $("#fromDate")
            .datepicker({

                changeMonth: true,
                changeYear: true,
                numberOfMonths: 1,
                dateFormat: 'yy-mm-dd'
            })
            .on("change", function () {
                to.datepicker("option", "minDate", getDate(this));
            }),
        to = $("#toDate").datepicker({

            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: 'yy-mm-dd'
        })
            .on("change", function () {
                from.datepicker("option", "maxDate", getDate(this));
            });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});


