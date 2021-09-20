//  EVENT CREATION DU LIENS POUR LE FILTRE NOMBRE PAR PAGE  //

const numberPerPage = document.getElementById('numberPerPage');
numberPerPage.value = new URL(window.location.href).searchParams.get('limit');
const author = document.getElementById('authorLink');
author.value = new URL(window.location.href).searchParams.get('author');

// SI AUCUNE DONNEES GET[LIMIT] ALORS SELECT = 10 //
if(numberPerPage.value === '') {
    numberPerPage.value = 10;
}
if (author.value === ''){
    author.value = 0;
}

numberPerPage.addEventListener('change' , () => {
    if (category !== null) {
        document.location.href = `index.php?category=${category}&page=1&limit=${numberPerPage.value}`;
    } else {
        document.location.href = `search_article.php?author=${author.value}&page=1&limit=${numberPerPage.value}`;
    }
})

author.addEventListener('change', () => {
    document.location.href = `search_article.php?author=${author.value}&page=1&limit=${numberPerPage.value}`;
});

