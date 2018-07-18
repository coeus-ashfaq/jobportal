

var nameRegex = /^[a-zA-Z]+$/;
var emailRegex = /^[A-Za-z0-9_.]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/i;
var phoneRegex = /^[0-9]+$/;
var passwordRegex = /^[A-Za-z0-9]+$/;


function validateInput(thisValue){

    var regexValidate;

    if (!thisValue.value){

        $(thisValue).css("border","1px solid red");
        $(thisValue).siblings("span").css("display","inline");
        $(thisValue).siblings("span").html("* This is a Required Field");
        $('#submit').prop("disabled",true);

    }
    else{

        if(thisValue.type == "text"){

            regexValidate = nameRegex;

        }
        else if(thisValue.type == "email"){

            regexValidate = emailRegex;

        }
        else if(thisValue.type == "number") {

            regexValidate = phoneRegex;

        }
        else if(thisValue.type == "password") {

            regexValidate = passwordRegex;

        }
        else{

            $(thisValue).css("border","1px solid red");
            $(thisValue).siblings("span").css("display","inline");
            $(thisValue).siblings("span").html("* Please Enter a Valid Input Value For this Field");
        }

        if(regexValidate.test(thisValue.value)){

            $(thisValue).css("border","1px solid #ccc");
            $(thisValue).siblings("span").css("display","none");
            $('#submit').prop("disabled",false);

        }
        
        else {
    
            $(thisValue).css("border","1px solid red");
            $(thisValue).siblings("span").css("display","inline");
            $(thisValue).siblings("span").html("* Please Enter a Valid Input Value For this Field");
            $('#submit').prop("disabled",true);

        }

        if(thisValue.name == "re_password"){

            if ( $("#re_password").val() != $("#password").val() ) {

                $("#re_password").css("border","1px solid red");
                $("#password").css("border","1px solid red");
                $("#okpasswordlabel").css("display","inline");
                $("#okpasswordlabel").html("* Password Fields are not same !");
                $('#submit').prop("disabled",true);
            }
            else{
                $("#re_password").css("border","1px solid #ccc");
                $("#password").css("border","1px solid #ccc");
                $("#okpasswordlabel").css("display","none");
                $('#submit').prop("disabled",false);
            }
        }
    }
}
