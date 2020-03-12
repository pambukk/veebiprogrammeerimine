$('#load').click(loadText);

function loadText(){
    $.get('text.txt', function(data, status){
        $('#text').html(data);
        alert(status);
    });
}