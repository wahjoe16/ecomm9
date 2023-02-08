// const { default: Swal } = require("sweetalert2");

$(document).ready(function(){

    // memanggil class datatables
    $("#sections").DataTable();
    
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

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

    // update Section Status
    $(document).on("click", ".updateSectionStatus", function(){
        // alert("test");
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        // alert(status);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-section-status",
            data: {status:status, section_id:section_id},
            success: function(resp){
                // alert(resp);
                if (resp['status']==0) {
                    $("#section-"+section_id).html("<i class='mdi mdi-bookmark-outline' style='font-size:25px' status='Inactive'></i>");
                }else if (resp['status']==1) {
                    $("#section-"+section_id).html("<i class='mdi mdi-bookmark-check' style='font-size:25px' status='Active'></i>");
                }
            }, error: function(){
                alert("Error");
            }
        })
    });

    // confirm delete (Simple JavaScript)
    // $(".confirm-delete").click(function(){
    //     var title = $(this).attr("title");
    //     if (confirm("Are you sure you want to delete this "+title+"?")) {
    //         return true;
    //     }else {
    //         return false;
    //     }
    // })

    $(".confirm-delete").click(function(){
        var module = $(this).attr("module");
        var module_id = $(this).attr("module_id");
        var module_name = $(this).attr("module_name");
        Swal.fire({
            title: "Apakah anda yakin menghapus "+module+" "+module_name+ "?",
            text: module+" "+module_name+" Akan terhapus permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"  
        }).then((result) =>{
            if (result.isConfirmed) {
            Swal.fire(
                "Terhapus!",
                module+" "+module_name+" sudah terhapus.",
                "success"
            )
            window.location = "/admin/delete-"+module+"/"+module_id;
            }
        })
    })

});