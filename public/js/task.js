$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Open modal delete task
    $('.btn-delete').click(function(event){
        var id = $(this).find('#task-id').val();
        $('#modal-delete-task').modal('show');
        $('#task_id').val(id);

        // Click button delete in modal delete task
        $('#delete').click(function(event){
            var id = $('#task_id').val();
            $.post('/deleteTask', {'id': id}, function(data) {
                $('#tasks').load(location.href + ' #tasks');
                console.log(data);
            });
        })
    
    })

    // Check complete task
    $('.check-complete').click(function(event){
        var id = $(this).attr('data-id');
        $.post('/completeTask', {'id': id}, function(data) {
            $('#tasks').load(location.href + ' #tasks');
            $('#task_id' + id).css('opacity', '0.5');
        });
    })

    // Upload file
    $('#btn-upload').click(function(event) {
        event.preventDefault();
        $('#modal-upload-file').modal('show');
    })

    $('#upload').click(function(event) {
        var file = $('#modal-upload-file').find('#file').val(); console.log(event.target.file);
        var userId = $('#modal-upload-file').find('#user-id').val();
        var projectId = $('#modal-upload-file').find('#project-id').val();
        // $.post('/upload', {''})
    })

    // Set checked 
    $('.check-complete').each(function(event){
        var id = $(this).attr('data-id');
        var progress = $(this).attr('data-progress');
        var selector = '#task_id_' + id;
        if (progress == 100) {
            $(this).attr('checked','checked');
            $(selector).css('opacity', '0.5');
            $(selector).find('.btn-delete').prop('disabled', true);
            $(selector).find('.btn-delete').addClass('disabled');
            $(selector).find('.check-complete').prop('disabled', true);
            $(selector).find('.check-complete').addClass('disabled');
        }
    })
})