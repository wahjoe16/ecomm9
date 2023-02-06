$(document).ready(function(){
    // mengecek password lama apakah sesuai atau tidak
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: 'check-current-password',
            data: {current_password:current_password},
            success:function(resp){
                if (resp == "false") {
                    $("#check_password").html("<font color='red'>Password lama anda salah</font>")
                }else if(resp == "true"){
                    $("#check_password").html("<font color='green'>Password lama anda benar</font>")
                }
            }, error:function(resp){
                alert('Error');
            }
        });
    })

    // update Admin Status
    $(document).on("click", ".updateAdminStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-admin-status",
            data: {status:status, admin_id:admin_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#admin-"+admin_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });
});