$(document).ready(function() {

    $('#OpenImgUpload').click(function(){ 
        $('#user_avatar').trigger('click'); 
    });

    $('#bookSearchInput').keypress(function (e) {
      if (e.which == 13) {
        // $('form#login').submit();
        console.log($(this).val());
        var stext = $(this).val();
        if(stext){
            window.location.href='/book/search/'+stext;
        }
        return false;    //<---- Add this line
      }
    });
})


$('body').on('click', '#submitForm', function(e){
    var registerForm = $("#formRegister");
    var formData = registerForm.serialize();
    $( '#name-error' ).html( "" );
    $( '#email-error' ).html( "" );
    $( '#password-error' ).html( "" );
    console.log(formData);
    e.preventDefault();
              
    $('input+small').text('');
    $('input').parent().removeClass('has-error');
      
    $.ajax({
        type:'POST',
        data:formData,
        url:'/register',
        dataType: "json"
    })
    .done(function(data) {
        console.log('----------')
        console.log(data.errors);
        if(data.errors){
            $.each(data.errors, function (key, value) {
                var input = '#formRegister input[name=' + key + ']';
                $(input + '+small').html("<strong>"+value+"</strong>");
                $(input).parent().addClass('has-error');
            });
        }
        if(data.success) {
            $('#success-msg').removeClass('hide');
            setTimeout(function(){ 
                $('#myModal').modal('hide');
                $('#success-msg').addClass('hide');
            }, 3000);
        }
        // $('.alert-success').removeClass('hidden');
        // $('#myModal').modal('hide');
    })
    .fail(function(data) {
        console.log(data.responseJSON);
        $.each(data.responseJSON, function (key, value) {
            var input = '#formRegister input[name=' + key + ']';
            $(input + '+small').text(value);
            $(input).parent().addClass('has-error');
        });
    });
});