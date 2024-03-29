var fileArea = document.getElementById('drag-drop-area');
var fileInput = document.getElementById('fileInput');


fileArea.addEventListener('dragover', function(evt){
    evt.preventDefault();
    fileArea.classList.add('dragover');
});

fileArea.addEventListener('dragleave', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragover');
});
fileArea.addEventListener('drop', function(evt){
    evt.preventDefault();
    fileArea.classList.remove('dragenter');
    var files = evt.dataTransfer.files;
    fileInput.files = files;
});


function disableSubmit(form) {
    var elements = form.elements;
    for(var i = 0 ; i < elements.length ; i++){
        if(elements[i].type == 'submit') {
            elements[i].disabled = true;
        }
    }
}