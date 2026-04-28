
$('#admin').hide();

$.ajax({
  url: "../controller/controller_form.php", //archivo necesario
  method: "POST", 
  dataType: "json",
  success: function(res) {
    // Aquí ya tienes los datos del PDO como objeto JS
    var rol=res.rol;

    if(rol === 1) {
        //muestra todos (es el admin)
        $('#admin').show();

    }else if(rol === 2){
        //solo muestra el de completar
        $('#completar').show();
    }else{
        //usa el #admin para ocultar todo
         $('#admin').hide();
    }

  }
});

