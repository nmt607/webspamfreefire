import $ from 'jquery'
export function checkInViewPort (className) {
    var top_of_element = $(className).offset().top;
    var bottom_of_element = $(className).offset().top + $(className).outerHeight();
    var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
    var top_of_screen = $(window).scrollTop();

    if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)) {
        return true
    }
    return false
};
