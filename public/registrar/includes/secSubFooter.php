</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //add subject to section
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let sectionId = $('#sectionId').val();
        let subjectId = $('#subjectId').val();
        let schedule = $('#schedule').val();
        let room = $('#room').val();
        let instructor = $('#instructor').val();

        $.ajax({
            url: '../../handlers/add_section_subject.php',
            method: "POST",

            data: {
                register: true,
                sectionId: sectionId,
                subjectId: subjectId,
                schedule: schedule,
                room: room,
                instructor: instructor
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
        let secId = $(this).data('secId');
        let subId = $(this).data('subId');
        let schedule = $(this).data('schedule');
        let room = $(this).data('room');
        let instructor = $(this).data('instructor');

        $('#id').val(id);
        $('#editSectionId').val(secId);
        $('#editSubjectId').val(subId);
        $('#editSchedule').val(schedule);
        $('#editRoom').val(room);
        $('#editInstructor').val(instructor);

        editModal.showModal();
    });

    //edit course
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        const id = $('#id').val().trim();
        const editSectionId = $('#editSectionId').val().trim();
        const editSubjectId = $('#editSubjectId').val().trim();
        const editSchedule = $('#editSchedule').val().trim();
        const editRoom = $('#editRoom').val().trim();
        const editInstructor = $('#editInstructor').val().trim();

        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editSectionId', editSectionId);
        formData.append('editSubjectId', editSubjectId);
        formData.append('editSchedule', editSchedule);
        formData.append('editRoom', editRoom);
        formData.append('editInstructor', editInstructor);

        $.ajax({
            url: '../../handlers/edit_section_subject.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("Subject Subject updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update subject section.");
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
            alert('Invalid Section Subject ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this?'
            )) {
            $.ajax({
                url: '../../handlers/delete_section_subject.php',
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