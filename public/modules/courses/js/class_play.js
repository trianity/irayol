$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        }
    });

    $("body").on("click", "#viewedClass", function (){
        let class_id = $(this).data("id");

        $.ajax({
            url: "/class/viewed",
            type: "POST",
            data: {class_id},
            dataType: "json",
            success: function (data) {
                if (data.status == 'info') {
                    $('#viewed_user_class_' + class_id + ' #viewedClass i').removeClass('fas fa-eye').addClass('far fa-eye-slash');
                } else {
                    $('#viewed_user_class_' + class_id + ' #viewedClass i').removeClass('far fa-eye-slash').addClass('fas fa-eye');
                }
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
    });
});