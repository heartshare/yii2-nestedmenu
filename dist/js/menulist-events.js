$(function(){

    $('.appendToList').on('click',function(event){
        event.preventDefault();
        $(document).trigger('create-list-item',[$(this).data('id')]);
    });

    $('#serialize').click(function(){
        event.preventDefault();
        $(document).trigger('task-save');
    });

    $('.editListItem').on('click',function(event){
        event.preventDefault();
        console.log($('.editListItem'),$(this).data());
        $(document).trigger('update-list-item',[$(this).data('id')]);
    });
});