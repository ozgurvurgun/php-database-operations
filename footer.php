<script src="assets/js/jquery-3.5.1.min.js"></script>
<script>
    let SITE_URL = "http://localhost/php-database-operations/";

    // function SendForm(FormID, Operation, SendURL = "") {
    //     $(".loadingAnimation").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
    //     $("#SaveButton").prop("disabled", true);
    //     let Formdata = $("form#" + FormID).serialize();
    //     $.ajax({
    //         type: "post",
    //         url: SITE_URL + '/ajax-process.php?page=' + Operation,
    //         data: Formdata,
            
    //         success: function(data) {
    //             $('.loadingAnimation').html('');
    //             $("#SaveButton").prop("disabled", false);
    //             data = data.split(":::", 2);
    //             let message = data[0];
    //             let mistake = data[1];
    //             if (mistake == 'warning') {
    //                 $("#result").html('<div class="alert alert-warning">' + message + '</div>');
    //             } else if (mistake == 'danger') {
    //                 $("#result").html('<div class="alert alert-danger">' + message + '</div>');
    //             } else if (mistake == 'success') {
    //                 $("form").trigger("reset");
    //                 $("#result").html('<div class="alert alert-success">' + message + '</div>');
    //             }
    //         }
    //     });
    // }

    function RemoveAll(Operation, ID) {
        if (confirm('Kaydı silmek istediğinizden emin misiniz ?')) {
            $.get(SITE_URL + '/ajax-process.php?page=' + Operation, {
                "ID": ID
            }, function(data) {
                data = data.split(":::", 2);
                let message = data[0];
                let mistake = data[1];
                alert(message);
                if (mistake == "success") {
                    $("#" + ID).remove();
                }
            });
        }
    }
    $(function() {
        $("#AddMemberForm").on('submit', function(e) {
            e.preventDefault();
            $(".loadingAnimation").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $("#SaveButton").prop("disabled", true);
            $.ajax({
                type: "post",
                url: SITE_URL+'/ajax-process.php?page=InsertMember',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $(".loadingAnimation").html('');
                    $("#SaveButton").prop("disabled", false);
                    data = data.split(":::", 2);
                    let message = data[0];
                    let mistake = data[1];
                    if (mistake == 'warning') {
                        $("#result").html('<div class="alert alert-warning">' + message + '</div>');
                    } else if (mistake == 'danger') {
                        $("#result").html('<div class="alert alert-danger">' + message + '</div>');
                    } else if (mistake == 'success') {
                        $("form").trigger("reset");
                        $("#result").html('<div class="alert alert-success">' + message + '</div>');
                    }
                }
            });
        })
    });
</script>