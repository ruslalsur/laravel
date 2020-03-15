try {
    $(document).ready(function () {
        //выделение выбранного пункта в меню
        $('.nav-item a').each(function () {
            let location = window.location.href;
            let link = $(this).attr('href')
            if (link == location) {
                $(this).addClass('active');
            }
        });

        //параметры файлового меееенеджера
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
        };

        //замена элемента с id='newsBody'
        CKEDITOR.replace('newsBody', options);

        CKEDITOR.config.width = '100%';
        CKEDITOR.config.height = '400';
    });
} catch (e) {}
