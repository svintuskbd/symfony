function call() {
    var msg = $('#formx').serialize();
      $.ajax({
        type: 'POST',
        url: '../application/Core/login.php',
        data: msg,
        success: function(data) 
        {
            if(data==true){
                $('#results').html('Добро пожаловать!');
                location.href='/admin';
            }
            else if(data==false){
                $('#results').html('Не верные пара логин/пароль');
            }
        },
        error:  function(xhr, str){
              alert('Возникла ошибка: ' + xhr.responseCode);
          }
      });

}