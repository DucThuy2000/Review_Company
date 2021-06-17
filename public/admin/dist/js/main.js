/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    $(".gallery_picture").change(function (){
        readMultipleImage(this);
    });

    $(".file-upload input[type='file']").change(function (){
        readUrl(this);
    });

    function readMultipleImage(input){
        var length = input.files.length;
        $(input).next(".preview_gallery_picture").html("");
        for(var i = 0; i < length; ++i){
            if(input.files[i] && input.files){
                var reader = new FileReader();
                reader.onload = function (e){
                    var src = e.target.result;
                    var image = '<img src=" '+ src +' " width="300" class="image_preview">';
                    $(input).append(image);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    function readUrl(input){
        if(input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e){
                $(".preview-img img").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".checkbox").change(function (){
        if( $(this).prop("checked") ){
            $("#uncheck").val("active");
        }else{
            $("#uncheck").val("inactive");
        }
    });


    /*---- Select 2 ----*/
     $(".single-select").select2();
     $(".multiple-select").select2({
         tags: true,
         tokenSeparators: [',', ' ']
     });

    /*---- Delete record with sweetalert2 ----*/
    function deleteRecord(event){
        event.preventDefault();
        let _this = $(this);
        let url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,

                    success: function (data){
                        if(data.code === 200){
                            _this.parent().parent().parent().remove();
                        }
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    },

                    error: function (data){

                    }
                })
            }
        })
    }
    $(document).on("click",".delete-button", deleteRecord);
})(jQuery);
