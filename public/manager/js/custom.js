
//Close alert
window.setTimeout(function () {
    $(".alert-remove").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3000);

$(document).ready(function () {
    $('.select2').select2();
});
/* User clicks the "Insert to post" button */
$("#InsertPhoto").click(function () {
    $("#MediaModal").modal("hide"); // Close the modal
    var insmedia = $("#InsertPhoto").data("id"); // Save the data-id value of #InsertPhoto button to variable
    /* If variable value is not empty we pass it to tinymce function and it inserts the image to post */
    if (insmedia != "") {
        $('#summernote').summernote('insertImage', insmedia);
    }
});

/* When user clicks an image in the modal, we add .selected style class to that image and remove the class from the rest of the images */
$(".addimage").click(function () {
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
    } else {
        $(this).addClass("selected");
    }

    var postimageid = $(this).attr("src"); //Grab the src value of selected image to variable
    $("#InsertPhoto").data("id", postimageid); //Save the value to data-id attribute of #InsertPhoto button
});

$("#MediaModal").on("show.bs.modal", function (event) {
    $("img").removeClass("selected");
    $("#InsertPhoto").data("id", ""); // Reset the data-id value of #InsertPhoto button
});



/* User clicks the "Insert to Main Image" button  */
$("#MainPhoto").click(function () {
    $("#MediaModal").modal("hide"); // Close the modal
    var mainPic = $("#MainPhoto").data("id"); // Save the data-id value of #InsertPhoto button to variable
    /* If variable value is not empty we pass it to tinymce function and it inserts the image to post */
    if (mainPic != "") {
        console.log(mainPic)
        $('#main_image').val(mainPic);
        $("#ImageMainSelect").attr('src', mainPic);
    }
});

/* When user clicks an image in the modal, we add .selected style class to that image and remove the class from the rest of the images */
$(".addMainImage").click(function () {
    if ($(this).hasClass("selected")) {
        $(this).removeClass("selected");
    } else {
        $(this).addClass("selected");
    }

    var postimageid = $(this).attr("src"); //Grab the src value of selected image to variable
    $("#MainPhoto").data("id", postimageid); //Save the value to data-id attribute of #MainPhoto button
});

$("#MediaModal").on("show.bs.modal", function (event) {
    $("img").removeClass("selected");
    $("#MainPhoto").data("id", ""); // Reset the data-id value of #MainPhoto button
});

$(function () {
    $(".lazy").Lazy({
        placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
        afterLoad: function (element) {
            element.removeClass("loading").addClass("loaded");
        },
    });
});

$(document).ready(function () {
    $(".filter-button").click(function () {
        var value = $(this).attr("data-filter");
        if (value == "all") {
            $(".filter").show("1000");
        } else {
            $(".filter").not("." + value).hide("3000");
            $(".filter").filter("." + value).show("3000");
        }
    });

    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");
});

$(document).ready(function () {
    var url = window.location;
    $('ul.nav a[href="' + url + '"]')
        .parent()
        .addClass("active");
    $("ul.nav a").filter(function () {
        return this.href == url;
    }).parent().addClass("active");
});

$(document).on('click', '.dropdown-menu', ($event) => $event.stopPropagation());

if ($(window).width() < 992) {
    $('.dropdown-menu a').click(($event) => {
        $event.preventDefault();
        if ($(this).next('.submenu').length) {
            $(this).next('.submenu').toggle();
        }
        $('.dropdown').on('hide.bs.dropdown', () => $(this).find('.submenu').hide());
    });
}

document.getElementById('upload_files').addEventListener('click', () => {
    document.getElementById('input_file').click()
})