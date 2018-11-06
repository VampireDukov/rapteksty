const target = document.getElementById('target');
function addEvents(){
    $('a').off('click').click((e)=>{
        e.preventDefault();
        getContent(e);
    });
}
function getContent(e){
    var promise = new Promise(function(resolve, reject) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", e.target);
        xhr.addEventListener('load', () => resolve(xhr.responseText));
        xhr.send();
    });
    promise.then(function(res) {
        var tag = document.createElement("script");
      
        tag.src = "/rapteksty/Dokumenty/rapteksty/frontend/scripts/users.js";

        document.getElementsByTagName("head")[0].appendChild(tag);
        document.getElementsByTagName("head")[0].appendChild(tag2);
        target.innerHTML = res;
        window.history.pushState({"html":res,"pageTitle":'aa'},"", e.target)
        addEvents();
    });
}
addEvents();


