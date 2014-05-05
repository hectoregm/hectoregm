jQuery(function($) {
  $('#add_submit').click(function(event) {
    event.preventDefault();
    if(validateForm()) {
      $('#add_form').submit();
    }
  });

  function validateForm() {
    var username, firstname, email, password, gender, alert_message;
    var birthday;
    alert_message = "";
    $('.alert').addClass('hidden');
    $('.alert_messages').empty();

    username = $('#username').val();
    email = $('#email').val();
    firstname = $('#first_name').val();
    parentname = $('#parent_name').val();
    mothername = $('#mother_name').val();
    password = $('#password').val();
    gender = $('input[name=gender]:checked', '#add_form').val();
    birthday = $('#birthday').val();

    if(username === "" ||
       email === "" ||
       firstname === "" ||
       parentname === "" ||
       mothername === "" ||
       password === "" ||
       gender === undefined
      ) {
      alert_message += "<li>Not all the fields are filled.</li>";
    }

    if(username.length < 3) {
      alert_message += "<li>Username must have at least 3 characters.</li>";
    }

    if(email.length < 3) {
      alert_message += "<li>Email must have at least 3 characters.</li>";
    }

    if(firstname.length < 3) {
      alert_message += "<li>First name must have at least 3 characters.</li>";
    }

    if(parentname.length < 3) {
      alert_message += "<li>Parent name must have at least 3 characters.</li>";
    }

    if(mothername.length < 3) {
      alert_message += "<li>Mother name must have at least 3 characters.</li>";
    }

    if(password.length < 5) {
      alert_message += "<li>Password must have at least 5 characters.</li>";
    }

    if(gender !== "0" && gender !== "1") {
      alert_message += "<li>Must select a gender.</li>";
    }

    if(birthday === undefined || birthday.length < 10) {
      alert_message += "<li>Must select a birthdate.</li>";
    }

    if (alert_message) {
      $('.alert_messages').html(alert_message);
      $('.alert-danger').removeClass('hidden');
      return false;
    } else {
      $('.alert-success').removeClass('hidden');
      return true;
    }
  }

});
