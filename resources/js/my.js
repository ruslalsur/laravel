try {
    $(document).ready(function () {
        $('.nav-item a').each(function () {
            let location = window.location.href;
            let link = $(this).attr('href')

            if (link == location) {
                $(this).addClass('active');
            }
        });
    });
} catch (e) {
}
