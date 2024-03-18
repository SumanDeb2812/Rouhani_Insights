function rejectLeave(id){
    document.getElementById('reject-leave-box').style.display = 'flex';
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        document.getElementById('reject-form').setAttribute('action', '/admin/leave-rejected/' + id);
    }
    xhttp.open("GET", '/admin/leave-rejected/' + id);
    xhttp.send();
}

document.getElementById('close-reject-box').addEventListener('click', function(){
    document.getElementById('reject-form').setAttribute('action', '');
    document.getElementById('reject-leave-box').style.display = 'none';
});

function validateForm(){
    if(document.getElementById('reject-reason').value == ""){
        event.preventDefault();
        document.getElementById('leave-reject-error').innerHTML = "A rejection reason is required";
        return false;
    }else{
        document.getElementById('leave-reject-error').innerHTML = "";
        return true;
    }
}