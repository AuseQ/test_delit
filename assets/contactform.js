const form = document.querySelector('form');
const validationMessage = document.querySelector('#submited-validation');

form.addEventListener('submit' , function (e){
    e.preventDefault();
    fetch(this.action,{
        body: new FormData(e.target),
        method: 'POST'
    })
    .then(response => response.json())
    .then(json => {
        handleResponse(json);
        console.log(json)
    })
})

const handleResponse = function(response){
    removeErrors();
    switch (response.code) {
        case 'SUCCESS':

            validationMessage.innerHTML = response.html;
            validationMessage.style.backgroundColor = "green";
            
            break;

        case 'INVALID':
            handleErrors(response.errors)
            break;
    }
}

const handleErrors = function(errors){

    if (errors.length === 0) {
        return;
    }

    for (const key in errors) {
        const element = document.querySelector(`#contact_form_${key}`);
        element.classList.add('field-error');

        div = document.createElement('div');
        div.classList.add('field-error-text');
        div.innerText = errors[key]

        element.after(div);
        
    }
}
removeErrors = function(){
    const invalidateElements = document.querySelectorAll('.field-error-text');
    const invalidateClassElements = document.querySelectorAll('.field-error');

    invalidateElements.forEach(invalidateDiv => invalidateDiv.remove());
    invalidateClassElements.forEach(invalidateClass => invalidateClass.classList.remove('field-error'));

}