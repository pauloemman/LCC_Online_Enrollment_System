</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    //APPROVE ENROLLMENT
    $(document).on('click', '.--btn-approve', function(e) {

        e.preventDefault();

        let id = $(this).data('id');
        let row = $(this).closest('tr');

        if (!id) {
            alert('Invalid enrollment ID.');
            return;
        }

        if (confirm('Do you want to approve this enrollment?')) {

            $.ajax({

                url: '../../handlers/approve_enrollment.php',
                method: 'POST',
                data: {
                    approve_enrollment: true,
                    id: id
                },
                dataType: 'json',

                success: function(response) {

                    if (response.success) {

                        row.find('td:eq(6)').html('Approved');

                        alert(response.success);

                    } else if (response.error) {

                        alert(response.error);

                    } else {

                        alert('Something went wrong.');

                    }
                },

                error: function(xhr) {

                    console.error(xhr.responseText);
                    alert('An error occurred while processing the request.');

                }

            });
        }
    });

});
</script>

</html>