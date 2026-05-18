</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //create section
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let courseId = $('#courseId').val();
        let section = $('#section').val();
        let yearLevel = $('#yearLevel').val();
        let semester = $('#semester').val();

        $.ajax({
            url: '../../handlers/create_section.php',
            method: "POST",

            data: {
                register: true,
                courseId: courseId,
                section: section,
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
        let cid = $(this).data('cid');
        let section = $(this).data('section');
        let year = $(this).data('year');
        let sem = $(this).data('sem');

        $('#id').val(id);
        $('#editCourseId').val(cid);
        $('#editSection').val(section);
        $('#editYearLevel').val(year);
        $('#editSemester').val(sem);

        editModal.showModal();
    });

    //edit section
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const editCourseId = $('#editCourseId').val().trim();
        const editSection = $('#editSection').val().trim();
        const editYearLevel = $('#editYearLevel').val().trim();
        const editSemester = $('#editSemester').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editCourseId', editCourseId);
        formData.append('editSection', editSection);
        formData.append('editYearLevel', editYearLevel);
        formData.append('editSemester', editSemester);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_section.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("section updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update section.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete section
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid section ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Section?'
            )) {
            $.ajax({
                url: '../../handlers/delete_section.php',
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