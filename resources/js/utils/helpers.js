export default {
    formatPrice(value) {
      return `$${Number(value).toFixed(2)}`;
    },
    capitalizeFirst(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    },
    slugify(text) {
      return text.toLowerCase().replace(/\s+/g, '-');
    },
    getShortArray(arr, maxLength) {
        if (arr.length > maxLength) {
            return arr.slice(0, maxLength);
        }
        return arr;
    },
     preloader() {
        $('#ctn-preloader').addClass('loaded');
        $("#loading").fadeOut(500);
        // Una vez haya terminado el preloader aparezca el scroll
        if ($('#ctn-preloader').hasClass('loaded')) {
            // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
            $('#preloader').delay(900).queue(function () {
                $(this).remove();
            });
        }
    }
}

