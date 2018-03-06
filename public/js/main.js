// Main js
$(function () {

    // Rember login
    $('.input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });

});

document.querySelector('#file-upload').onchange = function(){loadFile(event)};              
    var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('user-image');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

$(document).ready(function(e){
    $('#file-upload').change(function(e){
        var filename = $('#file-upload').val().toString();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        } // Remove c:\fake at beginning from localhost chrome
        $('#file-name').text(filename);
    })
})  
