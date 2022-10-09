$(document).ready(function (){
    let username = localStorage.getItem("name");
    if(username){
            document.getElementById("heading").innerHTML = `Welcome ${username}`;
    }else{
        window.location.href = 'login.html';
    }
});

function logout(){
    localStorage.clear();
    window.location.href = 'login.html';
}