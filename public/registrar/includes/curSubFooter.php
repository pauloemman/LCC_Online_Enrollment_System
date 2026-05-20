</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //add subject to curriculum
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let curriculumId = $('#curriculumId').val();
        let subjectId = $('#subjectId').val();

        $.ajax({
            url: '../../handlers/add_subject_curriculum.php',
            method: "POST",

            data: {
                register: true,
                curriculumId: curriculumId,
                subjectId: subjectId
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
        let sid = $(this).data('sid');

        $('#id').val(id);
        $('#editCurriculumId').val(cid);
        $('#editSubjectId').val(sid);

        editModal.showModal();
    });

    //edit course
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        const id = $('#id').val().trim();
        const editCurriculumId = $('#editCurriculumId').val().trim();
        const editSubjectId = $('#editSubjectId').val().trim();

        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editCurriculumId', editCurriculumId);
        formData.append('editSubjectId', editSubjectId);

        $.ajax({
            url: '../../handlers/edit_curriculum_subject.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Subject Curriculum updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update subject curriculum.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete curriculum subject
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid curriculum ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Subject Curriculum?'
            )) {
            $.ajax({
                url: '../../handlers/delete_curriculum_subject.php',
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