function deletePost(id){
    $(document).ready(function (){

    $.ajax({
        
        url: './delete.php',
        type: 'POST',
        data: {
            id: id,
            action: 'delete'
        },
        success:function(response){
            if(response == 1){
                alert('Post deleted successfully');
                document.getElementById(id).style.display= 'none';
            } else if (response == 0){
                alert("Post can't be deleted");
            }
        },
    });
});
}