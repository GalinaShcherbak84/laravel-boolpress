require('./bootstrap');
console.log('Scripts for admin pages');

//deltete post confirm
const delForm = document.querySelectorAll('.delete-post-form');
console.log(delForm);
delForm.forEach(from => {
    from.addEventListener('submit', function(e){
        const resp = confirm('Do you really want to delete this post?');
        if(! resp){
            e.preventDefault();
        }

    });
});