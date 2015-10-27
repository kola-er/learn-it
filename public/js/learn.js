$(document).ready(function() {
    $("#update_form").hide();
    $("#video_form").hide();
    $("#avatar_change").hide();
    $(".dropdown-button").dropdown();
    $("#video_form_toggle").click(function () {
        $("#video_form").show();
        $("#videos").hide();
        $("#update_form").hide();
        $("#avatar_change").hide();
    });

    $("#update_form_toggle").click(function () {
        $("#video_form").hide();
        $("#avatar_change").hide();
        $("#videos").hide();
        $("#update_form").show();
    });

    $("#update_cancel").click(function () {
        $("#video_form").hide();
        $("#avatar_change").hide();
        $("#videos").show();
        $("#update_form").hide();
    });

    $("#avatar_cancel").click(function () {
        $("#video_form").hide();
        $("#avatar_change").hide();
        $("#videos").show();
        $("#update_form").hide();
    });

    $("#post_cancel").click(function () {
        $("#video_form").hide();
        $("#avatar_change").hide();
        $("#videos").show();
        $("#update_form").hide();
    });

    $("#avatar_change_toggle").click(function () {
        $("#video_form").hide();
        $("#avatar_change").show();
        $("#videos").hide();
        $("#update_form").hide();
    });

    $('#profile-pic').on('click', function(){
        $('#file').click();
    });

    $('#file').change(function(event){
        event.preventDefault();

        if(typeof(FileReader) !== "undefined") {
            var imagePreview = $('#imagePreview');
            imagePreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function(){
                var file = $(this);
                if(regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        var img = $("<img/>");
                        img.attr("style", "height:220px; width:130px");
                        img.attr("src", e.target.result);
                        imagePreview.append(img);
                    };

                    reader.readAsDataURL(file[0]);
                } else {
                    alert(file[0].name + "is not a valid image file");
                    imagePreview.html("");
                    return false;
                }
            });
        }

    });
});