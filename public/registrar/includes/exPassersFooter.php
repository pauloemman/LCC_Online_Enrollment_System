</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //ADD
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let applicant = $('#applicant').val();
        let fname = $('#fname').val();
        let mname = $('#mname').val();
        let lname = $('#lname').val();
        let email = $('#email').val();
        let exStatus = $('#exStatus').val();

        $.ajax({
            url: '../../handlers/add_account.php',
            method: "POST",

            data: {
                register: true,
                applicant: applicant,
                fname: fname,
                mname: mname,
                lname: lname,
                email: email,
                exStatus: exStatus
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
        let app = $(this).data('app');
        let fname = $(this).data('fname');
        let mname = $(this).data('mname');
        let lname = $(this).data('lname');
        let email = $(this).data('email');
        let examstats = $(this).data('examstats');

        $('#id').val(id);
        $('#editApplicant').val(app);
        $('#editFname').val(fname);
        $('#editMname').val(mname);
        $('#editLname').val(lname);
        $('#editEmail').val(email);
        $('#editExStatus').val(examstats);

        editModal.showModal();
    });

    //edit section
    $('.--btn-update').on('click', function(e) {
        e.preventDefault();

        // Grab the values
        const id = $('#id').val().trim();
        const editApplicant = $('#editApplicant').val().trim();
        const editFname = $('#editFname').val().trim();
        const editMname = $('#editMname').val().trim();
        const editLname = $('#editLname').val().trim();
        const editEmail = $('#editEmail').val().trim();
        const editExStatus = $('#editExStatus').val().trim();

        // Prepare form data
        let formData = new FormData();
        formData.append('update_profile', true);
        formData.append('id', id);
        formData.append('editApplicant', editApplicant);
        formData.append('editFname', editFname);
        formData.append('editMname', editMname);
        formData.append('editLname', editLname);
        formData.append('editEmail', editEmail);
        formData.append('editExStatus', editExStatus);

        // AJAX request
        $.ajax({
            url: '../../handlers/edit_exam_passers.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {

                    alert("account updated successfully!");

                    editModal.close();
                    location.reload();

                } else {
                    alert(response.error || "Failed to update account.");
                }
            },
            error: function(xhr, status, error) {
                alert("AJAX error: " + error);
            }
        });
    });

    //delete Examinee Account
    $('.--btn-delete').on('click', function(e) {
        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid Examinee Account ID.');
            return;
        }

        if (confirm(
                'Are you sure you want to delete this Examinee Account?'
            )) {
            $.ajax({
                url: '../../handlers/delete_exam_passers.php',
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