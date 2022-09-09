$(document).ready(function(){
    $("#save").click(function(e){
        e.preventDefault();
        var password = $("#password").val();
        var newpassword = $("#newpassword").val();
        var confirmpassword = $("#confirmpassword").val();
        if(password == "" || newpassword == "" || confirmpassword == ""){
            $("#message").text("Popunite sva polja!");
        }else{
            $.ajax({
                url:'change.php',
                type:'post',
                data:{password:password, newpassword:newpassword, confirmpassword:confirmpassword},
                success:function(response){
                    if(response=="Popunite sva polja!"){
                        $("#message").html("<font color=crimson>Popunite sva polja!</font>");
                    }else if(response=="Molimo Vas unesite tačne podatke."){
                        $("#message").html("<font color=crimson>Molimo Vas unesite tačne podatke.</font>");
                    }else if(response=="Lozinke se ne poklapaju."){
                        $("#message").html("<font color=crimson>Lozinke se ne poklapaju.</font>");
                    }else if(response=="Ažuriranje lozinke nije uspjelo, dogodila se greška."){
                        $("#message").html("<font color=crimson>Ažuriranje lozinke nije uspjelo, dogodila se greška.</font>");
                    }else if(response=="Uspješno ste ažurirali lozinku!"){
                        var url = "http://localhost/wizardprint/changepassword.php";
                        $(location).attr('href',url);
                    }
                },
                error:function(response){
                    $("#message").text(response);
                }
            });
        }
    });
});