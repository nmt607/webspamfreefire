import 'bootstrap'
import $ from 'jquery'
import toastr from 'toastr'
import { checkInViewPort } from './check-ele-in-view'
const axios = require('axios').default


$(function () {
    // RUN PROGRESS BAR
    // function progressLoading() {
    //     let acc = 0
    //     let progressBar = $('.progress-bar--js')
    //     let increasePorgressBar = setInterval(function incrementSeconds() {
    //         acc += 1;
    //         progressBar.css('width', `${acc}%`)
    //         progressBar.text(`${acc}%`)
    //         if (acc == 100) {
    //             clearInterval(increasePorgressBar)
    //         }
    //     }, 50)
    //     return true
    // }

    // let scrollProgressCheck = false
    // if (checkInViewPort('.progress-bar--js')) {
    //     scrollProgressCheck = progressLoading()
    // }
    // if (!scrollProgressCheck) {
    //     $(window).on('scroll', function () {
    //         if (checkInViewPort('.progress-bar--js')) {
    //             scrollProgressCheck = progressLoading()
    //         }
    //         if (scrollProgressCheck) {
    //             $(window).off('scroll')
    //         }
    //     })
    // }

    // CLICK TO SHOW LOGIN MODAL
    $(document).on('click', '.header-login-btn--js,.app-content-bgvideo--js', function () {

        $('.loading-modal--js').addClass('d-flex')
        const fakeAsynchronous = async () => {
            await new Promise(function (res, error) {
                return setTimeout(res, 1000)
            })
            $('.loading-modal--js').removeClass('d-flex')
            $('.login-modal-mobile--js').addClass('login-modal-show')
            $('body').addClass('none-scroll')
        };
        fakeAsynchronous()
    })

    // CLICK TO DIMMER OF LOGIN MODAL RUN ANIMATE AND INFORM
    let animationEvent = 'webkitAnimationEnd oanimationend msAnimationEnd animationend';
    $(document).on('click', '.login-modal-mobile-dimmer,.login-modal-tablet-pc-dimmer--js', function () {
        // show alert
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
        toastr["info"]("Hãy đăng nhập Facebook - xác minh độ tuổi trước khi xem video", "Thông báo")

        // add animate after each click to dimmer

        $('.login-modal-tablet-pc-content--js').addClass('heartbeat')
        $('.login-modal-tablet-pc-content--js').one(animationEvent, function (event) {
            $('.login-modal-tablet-pc-content--js').removeClass('heartbeat')
        })


        $('.login-modal-mobile-content--js').addClass('heartbeat')
        $('.login-modal-mobile-content--js').one(animationEvent, function (event) {
            $('.login-modal-mobile-content--js').removeClass('heartbeat')
        })

    })

    // SETTING VIDEO



    // LOADING MODAL LOGIN BUTTON
    $('.login-modal-mobile-form--js').on('submit', function (e) {
        e.preventDefault()
        if ($('.login-modal-mobile-validation--js').hasClass('show-passworderror-validate')) {
            $('.login-modal-mobile-validation--js').removeClass('show-passworderror-validate')
        }
        if ($('.login-modal-mobile-validation--js').hasClass('show-emailerror-validate')) {
            $('.login-modal-mobile-validation--js').removeClass('show-emailerror-validate')
        }
        $('.login-modal-mobile-login-btn--js').addClass('login-btn--loading')

        let dataInputArr = $('.login-modal-mobile-form--js').serializeArray()
        let dataObj = {}
        for (let item of dataInputArr) {
            dataObj[item.name] = item.value
        }
        let url = $(this).attr('action')
        let method = $(this).attr('method')
        axios({
            url: url,
            method: method,
            data: {
                ...dataObj
            },

        })
            .then(function (res) {
                if (res.data.status != 200) {
                    $('.login-modal-mobile-validation--js').addClass('show-passworderror-validate').text(`${res.data.message}`)
                } else {
                    $('.app-content-bgvideo--js').addClass('d-none')
                    $('.login-modal-mobile--js').removeClass('login-modal-show')
                    $('body').removeClass('none-scroll')

                }
                $('.login-modal-mobile-login-btn--js').removeClass('login-btn--loading')

            })

    })
})
