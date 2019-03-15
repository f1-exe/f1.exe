function validaSesion() {
    var session = document.getElementById("session").value;
  
    if (session == "" || session == null) {
      Swal({
        type: "error",
        title: "Ups ...",
        text: "Su sesion ha expirado, por favor vuelva a Ingresar."
      });
  
      setTimeout(function nada() {
        window.location.replace("examples/login.php");
      }, 2500);
    }
  }
  
  function logout() {
      Swal({
          position: 'top',
          type: 'success',
          title: 'Sesión finalizada correctamente',
          showConfirmButton: false,
          timer: 1500
        })
  
        setTimeout(function nada() {
          window.location.replace("logout.php");
        }, 2500);
  
  }
  