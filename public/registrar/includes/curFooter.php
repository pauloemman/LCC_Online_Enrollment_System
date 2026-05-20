</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //create curriculum
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let courseId = $('#courseId').val();
        let yearLevel = $('#yearLevel').val();
        let semester = $('#semester').val();
        let sYear = $('#sYear').val();

        $.ajax({
            url: '../../handlers/create_curriculum.php',
            method: "POST",

            data: {
                register: true,
                courseId: courseId,
                yearLevel: yearLevel,
                semester: semester,
                sYear: sYear
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
        let cid = $(this).data('cid');
        let year = $(this).data('year');
        let sem = $(this).data('sem');
        let school = $(this).data('school');

        $('#id').val(id);
        $('#editCourseId').val(cid);
        $('#editYearLevel').val(year);
        $('#editSemester').val(sem);
        $('#editSchoolYear').val(school);

        editModal.showModal();
    });

    //edit course
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        const id = $('#id').val().trim();
        const editCourseId = $('#editCourseId').val().trim();
        const editYearLevel = $('#editYearLevel').val().trim();
        const editSemester = $('#editSemester').val().trim();
        const editSchoolYear = $('#editSchoolYear').val().trim();

        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editCourseId', editCourseId);
        formData.append('editYearLevel', editYearLevel);
        formData.append('editSemester', editSemester);
        formData.append('editSchoolYear', editSchoolYear);

        $.ajax({
            url: '../../handlers/edit_curriculum.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Curriculum updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update curriculum.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete curriculum
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid curriculum ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Curriculum?'
            )) {
            $.ajax({
                url: '../../handlers/delete_curriculum.php',
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