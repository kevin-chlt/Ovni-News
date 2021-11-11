//  EVENT CREATION DU LIENS POUR LE FILTRE NOMBRE PAR PAGE  //
const numberPerPage = document.getElementById('numberPerPage');
let limitParams = new URL(window.location.href).searchParams.get('limit');

numberPerPage.value = limitParams;
// If no limit defined, display 'Nombre d'article"
limitParams === null ? numberPerPage.value = '0' : null

const numberPerPageFunction = () => {
    if (numberPerPage.value === '0') {
        if(authorParams) {
            document.location.href = `index.php?category=general&page=1&limit=10`;
            return;
        }
        document.location.href = `index.php?category=${category}&page=1&limit=10`;

    } else if(category === null) { // We are in author search
        document.location.href = `index.php?author=${author.value}&page=1&limit=${numberPerPage.value}`;
    } else {
        document.location.href = `index.php?category=${category}&page=1&limit=${numberPerPage.value}`;
    }
}

numberPerPage.addEventListener('change', numberPerPageFunction)
