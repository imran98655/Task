<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Button</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #enter-button {
            font-size: 0.75em; 
            padding: 5px 10px;
        }
        #content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <marquee behavior="" direction=""><H2>Welcome To Webreinvent</H2></marquee>
    <h2>PHP - Simple To Do List App</h2>
    <center>
    <form id="my-form">
    @csrf
    <p>
            <input type="text" id="task-name" name="task_name" placeholder="Please enter your task" require>
            <button type="submit" id="enter-button">Add Task</button>
        </p>
    </form>
    <button type="button" id="show-tasks">Show all</button>
    <div id="task-list">
        <table id="tasks-table" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        <tbody>
           
        </tbody>
    </table>
    </div>
    </center>
    <script>




$(document).ready(function() {
    $('#my-form').on('submit', function(event) {
        var taskName = $('#task-name').val();
        if (taskName == '') {
            event.preventDefault();
            alert('Please enter a task.');
        } else {
            $.ajax({
                url: 'submit-task',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_name: taskName
                },
                success: function(response) {
                    console.log('Task added successfully:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});
$(document).ready(function() {
        $('#task-list').hide();
        $('#show-tasks').on('click', function() { 
            $('#task-list').show();
            showAllTasks();
        $('#tasks-table').on('click', '#done', function() {  
            var row = $(this).closest('tr');
            var taskName = row.find('td:eq(1)').text();    
            markDone(row,taskName);
            $(this).hide();
            });
        $('#tasks-table').on('click', '#delete', function() { 
            var confirmed = confirm('Are you sure you want to delete this task?');            var row = $(this).closest('tr');
            var taskName = row.find('td:eq(1)').text();  
            var id = row.find('td:eq(0)').text();  
            if(confirmed){
            deleteTask(id,taskName);
            }
            });
        });
    });
    function showAllTasks()
    {
        $.ajax({
            url: 'get-tasks',        
            dataType: "json",   
        }).done(function (data) {
            
            $('#tasks-table tbody').empty();
            var sno = 1;  
            data.forEach(function(task) {
                $('#tasks-table tbody').append(
                        `<tr>
                            <td>${task.id}</td>
                            <td>${task.task_name}</td>
                            <td>Pending</td>
                            <td>
                                <button type="button" id ="done">done</button>
                                <button type="button" id="delete">delete</button>
                            </td>

                        </tr>`
                    );
                    sno++; 
                });
            });
           
    }

   
    function markDone(row,taskName)
    {
        row.find('td:eq(2)').text('Completed');
    }
    function deleteTask(id,taskName){
        
        $.ajax({
            url: 'get-delete-task', 
            data: { id:id,taskName: taskName },        
            dataType: "json",   
        }).done(function (data) {
            console.log('Delete response:', data);
            if (data) {
                    row.remove();
                    console.log('Task deleted successfully:', data.message);
                } else {
                    console.error('Error deleting task:', data.message);
                }
        });
    }
</script>

</script>
</body>
</html>
