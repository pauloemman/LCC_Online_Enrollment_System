</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //create department
    $('.--btn-register').on('click', function(e) {
        e.preventDefault();

        let depName = $('#depName').val();
        let code = $('#code').val();

        $.ajax({
            url: '../../handlers/create_department.php',
            method: "post",
            data: {
                'register': true,
                'depName': depName,
                'code': code,
            },
            dataType: 'json',

            success: function(response) {
                if (response.error) {
                    alert(response.error); // simple like your reference
                } else {
                    alert(response.success);

                    $('#createForm')[0].reset();

                    setTimeout(() => {
                        document.getElementById('createModal').close();
                        location.reload();
                    }, 500);
                }
            },

            error: function(xhr, status, error) {
                console.log("XHR:", xhr.responseText);
                console.log("STATUS:", status);
                console.log("ERROR:", error);

                alert("Request failed. Check console.");
            }
        });
    });


    //delete department
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid student ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Department? All courses and subjects under this department will also get deleted.'
            )) {
            $.ajax({
                url: '../../handlers/delete_department.php',
                method: 'POST',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        row.remove();
                        alert(response.success);
                    } else if (response.error) {
                        alert(response.error);
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    alert('An error occurred while processing the request.');
                }
            });
        }
    });

    $(document).on('click', '.--btn-edit', function() {

        let id = $(this).data('id');
        let name = $(this).data('name');
        let code = $(this).data('code');

        $('#id').val(id);
        $('#editDepName').val(name);
        $('#editCode').val(code);

        editModal.showModal();
    });

    //edit department
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const depName = $('#editDepName').val().trim();
        const code = $('#editCode').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('depName', depName);
        formData.append('code', code);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_department.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Department updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update department.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

});
</script>


</html>