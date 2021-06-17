
(function($) {
    /*---- Login Ajax ----*/
    $("form.login-form").submit(function (e){
        e.preventDefault();
        let url = $(this).data('url');
        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            cache: false,
            contentType: false,

            beforeSend: function (){
                $(".overlay_loading").addClass("open");
            },

            success: function (data){
                if(data.code === 200){
                    window.location = "http://reviewcompany.com/admin/user/"
                }
            },

            error: function (data){

            },

            complete: function (){
                $(".overlay_loading").removeClass("open");
            },

        });
    })
})(jQuery);
