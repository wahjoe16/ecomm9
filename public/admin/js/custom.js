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
});