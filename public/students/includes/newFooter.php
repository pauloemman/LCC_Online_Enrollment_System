</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/jquery.js"></script>
<script>
$(document).ready(function() {

    // FILTER COURSES BY DEPARTMENT
    $('#departmentId').on('change', function() {

        let departmentId = $(this).val();

        $('#courseId option').each(function() {

            let optionDepartment = $(this).data('department');

            if (
                $(this).val() == "" ||
                optionDepartment == departmentId
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }

        });

        $('#courseId').val('');
        $('#curriculumId').val('');
        $('#sectionId').val('');
    });


    // FILTER CURRICULUM BY COURSE
    $('#courseId').on('change', function() {

        let courseId = $(this).val();

        $('#curriculumId option').each(function() {

            let optionCourse = $(this).data('course');

            if (
                $(this).val() == "" ||
                optionCourse == courseId
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }

        });

        $('#curriculumId').val('');
        $('#sectionId').val('');
    });


    // FILTER SECTION BY CURRICULUM
    $('#curriculumId').on('change', function() {

        let selectedOption = $(this).find(':selected');

        let courseId = selectedOption.data('course');
        let yearLevel = selectedOption.data('year');
        let semester = selectedOption.data('semester');

        $('#sectionId option').each(function() {

            let optionCourse = $(this).data('course');
            let optionYear = $(this).data('year');
            let optionSemester = $(this).data('semester');

            if (
                $(this).val() == "" ||
                (
                    optionCourse == courseId &&
                    optionYear == yearLevel &&
                    optionSemester == semester
                )
            ) {
                $(this).show();
            } else {
                $(this).hide();
            }

        });

        $('#sectionId').val('');
    });

    //enroll
    $('.--btn-register').on('click', function(e) {

        e.preventDefault();

        let fname = $('#fname').val();
        let mname = $('#mname').val();
        let lname = $('#lname').val();
        let gender = $('#gender').val();
        let bday = $('#bday').val();
        let cNum = $('#cNum').val();
        let address = $('#address').val();
        let departmentId = $('#departmentId').val();
        let courseId = $('#courseId').val();
        let curriculumId = $('#curriculumId').val();
        let sectionId = $('#sectionId').val();

        $.ajax({
            url: '../../handlers/enroll_new.php',
            method: "POST",

            data: {
                register: true,
                fname: fname,
                mname: mname,
                lname: lname,
                gender: gender,
                bday: bday,
                cNum: cNum,
                address: address,
                departmentId: departmentId,
                courseId: courseId,
                curriculumId: curriculumId,
                sectionId: sectionId
            },

            dataType: 'json',

            success: function(response) {

                if (response.error) {

                    alert(response.error);

                } else {

                    alert(response.success);

                    $('#createForm')[0].reset();

                    setTimeout(() => {

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


    $(document).on('click', '.--btn-enroll', function(e) {

        e.preventDefault();

        let curriculumId = $('#curriculumId').val();
        let sectionId = $('#sectionId').val();

        if (!curriculumId || !sectionId) {
            alert("Please select curriculum and section.");
            return;
        }

        $.ajax({
            url: '../../handlers/student_enroll.php',
            method: 'POST',
            data: {
                curriculumId: curriculumId,
                sectionId: sectionId
            },
            dataType: 'json',

            success: function(response) {

                if (response.success) {

                    alert(response.success);

                    // reset selections
                    $('#curriculumId').val('');
                    $('#sectionId').val('');

                    // optional reload
                    setTimeout(() => {
                        location.reload();
                    }, 500);

                } else if (response.error) {

                    alert(response.error);

                } else {

                    alert("Something went wrong.");

                }
            },

            error: function(xhr) {

                console.log(xhr.responseText);
                alert("AJAX error occurred.");

            }
        });
    });

});
</script>


</html>