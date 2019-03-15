$(document).ready(function() {
    $("#loginUsuario").click(function() {
      var url = "login_action.php";
  
      var user = document.getElementById("loginUsername").value;
      var pass = document.getElementById("loginPassword").value;
  
      var data = "login=" + user + "&pass=" + pass;
      
      $.ajax({
        type: "POST",
        url: url,
        data: data, // Adjuntar los campos del formulario enviado.
        success: function(data) {
          switch (data) {
            case "0":
              const toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000
              });
  
              toast({
                type: "success",
                title: "¡Inicio de sesión Exitoso!"
              });
  
              setTimeout(function nada() {
                window.location.replace("../index.php");
              }, 2000);
  
              break;
            case "1":
            Swal({
              title: "¡Atención!",
              type: "info",
              text: "Clave incorrecta",
              animation: false,
              customClass: 'animated wobble'
            });
              break;
            case "2":
            Swal({
              title: "¡Atención!",
              type: "info",
              text: "Usuario no registrado o no válido",
              animation: false,
              customClass: 'animated wobble'
            });
              break;
            case "3":
            Swal({
              title: "¡ERROR!",
              type: "error",
              text: "Ingrese todos los datos para acceder",
              animation: false,
              customClass: 'animated wobble'
            });
              break;
            case "4":
            Swal({
              title: "¡ERROR!",
              type: "error",
              text: "ERROR!! Datos indefinidos o NULL",
              animation: false,
              customClass: 'animated wobble'
            });
              break;
            case "5":
            Swal({
              title: "¡ERROR!",
              type: "error",
              text: "ERROR!! Method form incorrecto",
              animation: false,
              customClass: 'animated wobble'
            });
              break;
          }
        }
      });
      return false;
    });
  });
  
