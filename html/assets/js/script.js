$(document).ready(function() {
    $("#login-form").submit(function(event) {
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "login.php",
        data: $("#login-form").serialize(),
        success: function(data) {
          if (data == "success") {
            window.location.replace("dashboard.php");
          } else {
            $("#login-error").html(data);
          }
        }
      });
    });
  
    $("#register-form").submit(function(event) {
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: "register.php",
        data: $("#register-form").serialize(),
        success: function(data) {
          if (data == "success") {
            window.location.replace("dashboard.php");
          } else {
            $("#register-error").html(data);
          }
        }
      });
    });
  });
  