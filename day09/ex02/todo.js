var ft_list;
var cookie = [];

window.onload = function() {
    document.querySelector('#new').addEventListener("click", newToDo);
    ft_list = document.querySelector("#ft_list");
    var ck = getCookie("todos");
    if (ck) {
        cookie = JSON.parse(ck);
        cookie.forEach(function(e){
            addToDo(e);
        });
    }
};

window.onunload = function () {
    var todo = ft_list.children;
    var newCookie = [];
    for (var i = 0; i < todo.length; i++){
        newCookie.unshift(todo[i].innerHTML);
        console.log(todo[i].innerHTML);
    }
    var toset = JSON.stringify(newCookie);
    setCookie("todos", toset, 1);

};

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function newToDo(){
    var todo = prompt("What to do next?", '');
    if (todo !== '') {
        addToDo(todo)
    }
}

function addToDo(todo){
    var div = document.createElement("div");
    div.innerHTML = todo;
    div.addEventListener("click", deleteToDo);
    ft_list.insertBefore(div, ft_list.firstChild);
}

function deleteToDo(){
    if (confirm("Are you sure to delete tis item? Yes or No?")){
        this.parentElement.removeChild(this);
    }
}