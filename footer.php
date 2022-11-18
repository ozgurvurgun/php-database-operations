<script src="assets/js/jquery-3.5.1.min.js"></script>
<script>
    let SITE_URL = "http://localhost/php-database-operations/";

    function SendForm(FormID, Operation, SendURL = "") {
        $(".loadingAnimation").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $(":button").prop("disabled", true);
        let MyData= $("form#" + FormID).serialize();
        $.ajax({
            type: "post",
            url: SITE_URL + '/ajax-process.php?page=' + Operation,
            data: MyData,

            success: function(data) {
                $('.loadingAnimation').html('');
                $(":button").prop("disabled", false);
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
    }
    function FillForm(FormID, Operation) {
        $(".loadingAnimation").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $(":button").prop("disabled", true);
        let MyData= $("form#" + FormID).serialize();
        $.ajax({
            type: "post",
            url: SITE_URL + '/ajax-process.php?page=' + Operation,
            data: MyData,
            success: function(data) {
                $('.loadingAnimation').html('');
                $(":button").prop("disabled", false);
                data = data.split(":::", 3);
                let result=data[0];
                let message = data[1];
                let mistake = data[2];
                if (mistake == 'warning') {
                    $("#result").html('<div class="alert alert-warning">' + message + '</div>');
                } else if (mistake == 'danger') {
                    $("#result").html('<div class="alert alert-danger">' + message + '</div>');
                } else if (mistake == 'success') {
                    $("form").trigger("reset");
                    $("#result").html('<div class="alert alert-success">' + message + '</div>');
                    $("#tableResult").html(result);
                }
            }
        });
    }
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
        $('#MemberCity').change(function() {
            let TownValue = $(this).val();
            $.ajax({
                type: "post",
                url: SITE_URL + '/ajax-process.php?page=fill',
                data: {
                    "TownValue": TownValue
                },
                dataType: "text",
                success: function(data) {
                    $("#MemberTown").html(data);
                }
            })
        });
        $("#AddMemberForm").on('submit', function(e) {
            e.preventDefault();
            $(".loadingAnimation").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            $("#SaveButton").prop("disabled", true);
            $.ajax({
                type: "post",
                url: SITE_URL + '/ajax-process.php?page=InsertMember',
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