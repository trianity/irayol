$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    /*  When user click add section button */
    $("#new-class").click(function () {
        $("#btn_save").val("create-class");
        $("#classForm").trigger("reset");
        $("#classesModal").html("Add New Class");
        $("#classes-modal").modal("show");
    });

    /* When click edit section */
    $("body").on("click", "#edit-class", function () {
        let class_id = $(this).data("id");
        $.get("/classes/" + class_id + "/edit", function (data) {
            $("#classesModal").html("Edit Class");
            $("#btn-save").val("edit-class");
            $("#classes-modal").modal("show");

            $("#class_id").val(data.message.id);
            $("#title_class").val(data.message.title);
            $("#section_class_id option[value='"+ data.message.section_id +"']").attr("selected",true);
            $("#is_active option[value='"+ data.message.is_active +"']").attr("selected",true);
            $("#media_type option[value='"+ data.message.media_type +"']").attr("selected",true);
            $("#url").val(data.message.url);
            $("#duration").val(data.message.duration);
            $("#access option[value='"+ data.message.access +"']").attr("selected",true);
            $("#note").val(data.message.note);
        });
    });

    //delete section
    $("body").on("click", "#delete-class", function () {
        let class_id = $(this).data("id");

        Swal.fire({
            title: "¿Eliminar?",
            text: "¡Asegúrate y luego confirma!",
            type: "warning",
            cancelButtonText: "¡No, cancelar!",
            confirmButtonText: "¡Sí, bórralo!",
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#007bff",
        }).then(
            function (e) {
                if (e.value === true) {
                    $.ajax({
                        url: "/classes/" + class_id,
                        type: "DELETE",
                        success: function (data) {
                            $("#card_class_" + class_id).remove();
                            Toast.fire({ icon: data.status, title: data.message });
                        },
                        error: function (data) {
                            console.log("Error:", data);
                            Toast.fire({ icon: data.status, title: data.message });
                        },
                    });
                } else {
                    e.dismiss;
                }
            },
            function (dismiss) {
                return false;
            }
        );
    });
});

if ($("#classForm").length > 0) {
    $("#classForm").validate({
        submitHandler: function (form) {
            let actionType = $("#btn_save").val();

            $("#btn_save").html("Enviando...");

            $.ajax({
                url: "/classes",
                type: "POST",
                data: $("#classForm").serialize(),
                dataType: "json",
                success: function (data) {

                    let classCreate = `<div class="list-group-item list-group-flush" data-id="${data.message.id}" id="list_class_${data.message.id}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-arrows-alt handle mr-3"></i> ${data.message.title}
                            </div>
                            <div>
                                <a href="javascript:void(0)" id="edit-class" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" id="delete-class" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>`;

                    if (actionType === "create-class") {
                        $("#class_loop_" + data.message.section_id).append(classCreate);
                    } else {
                        console.log(data.message);
                        $("#list_class_" + data.message.id).remove();
                        $("#class_loop_" + data.message.section_id).append(classCreate);
                    }

                    $("#classForm").trigger("reset");
                    $("#classes-modal").modal("hide");
                    $("#btn_save").html("Guardar cambios");
                },
                error: function (data) {
                    console.log("Error:", data);
                    $("#btn_save").html("Guardar cambios");
                },
            });
        },
    });
}

$('.sortabe').sortable({
    handle: '.handle',
    invertSwap: true,
    animation: 150,
    store: {
        set: function (sortabe) {

            let order = {};

            $('.list-group-item').each(function() {
                order[$(this).data('id')] = $(this).index();
            });

            $.ajax({
                url: '/classes/order',
                type: 'POST',
                data: {order: order},
                success: function(data){
                    console.log(data)
                    Toast.fire({ icon: data.status, title: data.message });
                }
            })
        }
    }
})
