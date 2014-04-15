$(function() {
  $('#demo-form').submit(function(event) {
    event.preventDefault();
    validateForm();
  });
  function validateForm() {
    var nickname, email, delegacion, cp, alert_message;
    alert_message = "";
    $('.alert').addClass('hidden');
    $('.alert_messages').empty();

    nickname = $('#name').val();
    email = $('#email').val();
    delegacion = $('#delegacion').val();
    cp = $('#codigo_postal').val();

    if(nickname === "" ||
       email === "" ||
       cp === "") {
      alert_message += "<li>No todos los campos estan llenos.</li>"
    }

    if(nickname.length < 3) {
      alert_message += "<li>El nickname debe tener al menos 3 caracteres.</li>"
    }

    if(email.length < 3) {
      alert_message += "<li>El email debe tener al menos 3 caracteres.</li>"
    }

    if(cp.length !== 5) {
      alert_message += "<li>El codigo postal debe ser un numero de 5 digitos.</li>"
    }

    if (alert_message) {
      $('.alert_messages').html(alert_message)
      $('.alert-danger').removeClass('hidden');
    } else {
      $('.alert-success').removeClass('hidden');
    }


  }
});
