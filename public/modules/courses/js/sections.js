$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    /*  When user click add section button */
    $("#new-section").click(function () {
        $("#btn-save").val("create-section");
        $("#sectionForm").trigger("reset");
        $("#sectionModal").html("Add New Section");
        $("#section-modal").modal("show");
    });

    /* When click edit section */
    $("body").on("click", "#edit-section", function () {
        let section_id = $(this).data("id");
        $.get("/admin/sections/" + section_id + "/edit", function (data) {
            $("#sectionModal").html("Edit Section");
            $("#btn-save").val("edit-section");
            $("#section-modal").modal("show");
            $("#section_id").val(data.message.id);
            $("#title").val(data.message.title);
        });
    });

    //delete section
    $("body").on("click", "#delete-section", function () {
        let section_id = $(this).data("id");

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
                        url: "/admin/sections/" + section_id,
                        type: "DELETE",
                        success: function (data) {
                            $("#card_section_" + section_id).remove();
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

if ($("#sectionForm").length > 0) {
    $("#sectionForm").validate({
        submitHandler: function (form) {
            let actionType = $("#btn-save").val();

            $("#btn-save").html("Enviando...");

            $.ajax({
                data: $("#sectionForm").serialize(),
                url: "/admin/sections",
                type: "POST",
                dataType: "json",
                success: function (data) {

                    let sectionCreate = `<div class="card" id="card_section_${data.message.id}">
                        <div class="card-header" id="section_id_${data.message.id}">
                            <h3 class="card-title">${data.message.title}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <a href="javascript:void(0)" id="edit-section" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" id="delete-section" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">

                        </div>
                    </div>`;

                    let sectionUpdate = `<div class="card-header" id="section_id_${data.message.id}">
                        <h3 class="card-title">${data.message.title}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <a href="javascript:void(0)" id="edit-section" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                            <a href="javascript:void(0)" id="delete-section" data-id="${data.message.id}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>`;

                    if (actionType === "create-section") {
                        $('#section-loop').append(sectionCreate);
                    } else {
                        $("#section_id_" + data.message.id).replaceWith(sectionUpdate);
                    }

                    $("#sectionForm").trigger("reset");
                    $("#section-modal").modal("hide");
                    $("#btn-save").html("Guardar cambios");
                },
                error: function (data) {
                    console.log("Error:", data);
                    $("#btn-save").html("Guardar cambios");
                },
            });
        },
    });
}
