$(function() {
  $('#demo-form').submit(function(event) {
    event.preventDefault();
    printData();
  });

  function printData() {
    var name, email, birthday, delegacion, javalevel, zipcode, color, html;
    name = $('#name').val();
    email = $('#email').val();
    birthday = $('#birthday').val();
    delegacion = $('#delegacion').val();
    javalevel = $('#javalevel').val();
    zipcode = $('#zipcode').val();
    color = $('#color').val();

    html = "<h3>Resultados</h3><p>Nombre: " + name + "</p>";
    html += "<p>Correo: " + email + "</p>";
    html += "<p>Cumpleaños: " + birthday + "</p>";
    html += "<p>Delegacion: " + delegacion + "</p>";
    html += "<p>Nivel Java: " + javalevel + "</p>";
    html += "<p>Codigo Postal: " + zipcode + "</p>";
    html += "<p>Color: " + color + "</p>";

    $('.form-results').html(html);
  }
});
