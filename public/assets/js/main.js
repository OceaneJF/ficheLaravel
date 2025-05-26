const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
document.addEventListener('DOMContentLoaded', () => {
    ['name','size','email'].map((field)=>{
        const element = document.querySelector(`input[name=${field}]`)
        const box = document.querySelector('#update-box')
        const pathParts = window.location.pathname.split('/')
        const id = pathParts[pathParts.length - 2]

        if (element === undefined || element === null) {
            return
        }

        element.addEventListener('focusout',(e)=>{
            autoSave(field, e.target.value,`/lapin/${id}/lapin-update`)
        })
    })
});

function autoSave(fieldName, value,path) {

    fetch(path, {
        method:'put',
        body: JSON.stringify({
            fieldName,
            value
        }),
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
    })

    box.classList.remove('hidden')

    setTimeout(()=>{
        box.classList.add('hidden')
    },500)
}
