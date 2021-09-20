const pagination = document.getElementById('pagination');
let pageNumber = new URL(window.location.href).searchParams.get('page');

if (pageNumber === null) {
    pageNumber = 1;
}

pagination.childNodes[parseInt(pageNumber)].style.fontSize = '2rem';
pagination.childNodes[parseInt(pageNumber)].style.textDecoration = 'underline';


for (let i = 0 ; i < pagination.childElementCount +1; i++) {
    if( i >  (parseInt(pageNumber) + 3 )  || i < (parseInt(pageNumber) - 3 )) {
        let node = pagination.childNodes[i];
        node.hidden = true;
    }
}