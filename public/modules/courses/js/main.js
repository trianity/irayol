$(document).ready(function () {

    /* When click New customer button */
    $('#new-section').click(function () {
        $('#btn-save').val("create-customer");
        $('#customer').trigger("reset");
        $('#customerCrudModal').html("Add New Section");
        $('#crud-modal').modal('show');
    });

    /* Edit customer */
    $('body').on('click', '#edit-customer', function () {
        var customer_id = $(this).data('id');
        $.get('customers/' + customer_id + '/edit', function (data) {
            $('#customerCrudModal').html("Edit customer");
            $('#btn-update').val("Update");
            $('#btn-save').prop('disabled', false);
            $('#crud-modal').modal('show');
            $('#cust_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#address').val(data.address);
        })
    });
    /* Show customer */
    $('body').on('click', '#show-customer', function () {
        $('#customerCrudModal-show').html("Customer Details");
        $('#crud-modal-show').modal('show');
    });

    /* Delete customer */
    $('body').on('click', '#delete-customer', function () {
        var customer_id = $(this).data("id");
        var token = $("meta[name='csrf-token']").attr("content");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "http://localhost/laravel7crud/public/customers/" + customer_id,
            data: {
                "id": customer_id,
                "_token": token,
            },
            success: function (data) {
                $('#msg').html('Customer entry deleted successfully');
                $("#customer_id_" + customer_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});