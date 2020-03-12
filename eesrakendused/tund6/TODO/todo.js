class Todo{
    constructor(title, description, date){
        this.title = title;
        this.description = description;
        this.date = date;
    }
}

$('#load').click(loadFromFile);
$('#save').click(saveToFile);
$('#add').click(addEntry);

let todos = [];

function loadFromFile(){
    $('#todos').html('');
    $.get('database.txt', function(data){
        let content = JSON.parse(data).content;
        console.log(content);

        content.forEach(function(todo){
            $('#todos').append('<ul><li>'+ todo.title  + '</li><li>'+ todo.description  + '</li><li>'+ todo.date  + '</li></ul>');
        });
    });
}

function saveToFile(){
    $.post('server2.php', {save: todos}).done(function(){
        console.log('Success');
    }).fail(function(){
        console.log('Fail');
    } 
    ).always(function(){
        console.log('Always');
    });
}

function addEntry(){
    const titleValue = $('#title').val();
    const descriptionValue = $('#description').val();
    const dateValue = $('#date').val();

    todos.push(new Todo(titleValue, descriptionValue, dateValue));

    console.log(todos);
}