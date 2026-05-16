</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //create subject
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let courseId = $('#courseId').val();
        let subCode = $('#subCode').val();
        let subName = $('#subName').val();
        let lecUnits = $('#lecUnits').val();
        let labUnits = $('#labUnits').val();
        let yearLevel = $('#yearLevel').val();
        let semester = $('#semester').val();

        $.ajax({
            url: '../../handlers/create_subject.php',
            method: "POST",

            data: {
                register: true,
                courseId: courseId,
                subCode: subCode,
                subName: subName,
                lecUnits: lecUnits,
                labUnits: labUnits,
                yearLevel: yearLevel,
                semester: semester
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
        let code = $(this).data('code');
        let name = $(this).data('name');
        let lecture = $(this).data('lecture');
        let lab = $(this).data('lab');
        let year = $(this).data('year');
        let semester = $(this).data('semester');

        $('#id').val(id);
        $('#editSubCode').val(code);
        $('#editSubName').val(name);
        $('#editLecUnits').val(lecture);
        $('#editLabUnits').val(lab);
        $('#editYearLevel').val(year);
        $('#editSemester').val(semester);

        editModal.showModal();
    });

    //edit subject
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const editSubCode = $('#editSubCode').val().trim();
        const editSubName = $('#editSubName').val().trim();
        const editLecUnits = $('#editLecUnits').val().trim();
        const editLabUnits = $('#editLabUnits').val().trim();
        const editYearLevel = $('#editYearLevel').val().trim();
        const editSemester = $('#editSemester').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editSubCode', editSubCode);
        formData.append('editSubName', editSubName);
        formData.append('editLecUnits', editLecUnits);
        formData.append('editLabUnits', editLabUnits);
        formData.append('editYearLevel', editYearLevel);
        formData.append('editSemester', editSemester);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_subject.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("subject updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update subject.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete subject
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid subject ID.');
            return;
        }

        if (confirm('Are you sure you want to delete this subject?')) {
            $.ajax({
                url: '../../handlers/delete_subject.php',
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