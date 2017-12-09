function checkPasswordMatch() {
    var password = $("#Password").val();
    var confirmPassword = $("#ConfirmPassword").val();

    if (password != confirmPassword) {
    	$("#CheckPasswordMatch").html("Passwords do not match! Ples fix?!");
        $("#infoBox").addClass("uk-alert-danger")
        $("#infoBox").removeClass("hidden")
        $("#infoBox").removeClass("uk-alert-success")
    }
    else {
        $("#CheckPasswordMatch").html("Passwords match.");
        $("#infoBox").addClass("uk-alert-succes")
        $("#infoBox").removeClass("hidden")
        $("#infoBox").removeClass("uk-alert-danger")
    }
}

$(document).ready(function () {
   $("#NewPassword, #ConfirmPassword").keyup(checkPasswordMatch);
});
