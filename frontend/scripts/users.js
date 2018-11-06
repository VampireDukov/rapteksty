
function createValuesObject(e){

    var action = e.target.name;
    var data_object = $(':input[name^=sends]').get().reduce(function(acc, ele) {
        var key = ele.name.match(/\[(.*)\]$/)[1];  // get the key
        acc[key] = ele.value; // add to retval
        return acc;
    }, {});
    sendData(data_object,action);
}
function sendData(data_object,action){
    var promise = new Promise((resolve, reject) => {
        var data = new FormData();
        data.append('action',action);
        data.append('items',JSON.stringify(data_object));
        const xhr = new XMLHttpRequest();
        xhr.open("POST", '../backend/controller.php',true);
        xhr.addEventListener('load', () => resolve(xhr.responseText));
        xhr.send(data);
    });
    promise.then((res) =>{
    
     
    }).catch((error)=>{alert(error)});
}
$('.submit-button').off('click').click((e)=>{
    e.preventDefault();
    createValuesObject(e);
});