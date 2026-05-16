</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //create course
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let departmentId = $('#departmentId').val();
        let couName = $('#couName').val();
        let couCode = $('#couCode').val();

        $.ajax({
            url: '../../handlers/create_course.php',
            method: "POST",

            data: {
                register: true,
                departmentId: departmentId,
                couName: couName,
                couCode: couCode
            },

            dataType: 'json',

            success: function(response) {

                if (response.error) {

                    alert(response.error);

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

                console.log(xhr.responseText);
                console.log(status);
                console.log(error);

                alert("Request failed. Check console.");
            }
        });
    });

    //edit
    $(document).on('click', '.--btn-edit', function() {

        let id = $(this).data('id');
        let name = $(this).data('name');
        let code = $(this).data('code');

        $('#id').val(id);
        $('#editCouName').val(name);
        $('#editCouCode').val(code);

        editModal.showModal();
    });

    //edit course
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const editCouName = $('#editCouName').val().trim();
        const editCouCode = $('#editCouCode').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editCouName', editCouName);
        formData.append('editCouCode', editCouCode);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_course.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Course updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update course.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete course
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid course ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Course? All subjects under this course will also get deleted.'
                )) {
            $.ajax({
                url: '../../handlers/delete_course.php',
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

});
</script>


</html>