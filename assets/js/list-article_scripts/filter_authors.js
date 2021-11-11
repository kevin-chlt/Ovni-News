const author = document.getElementById('authorLink');
let authorParams = new URL(window.location.href).searchParams.get('author');

author.value = authorParams;

// If no limit defined, display 'Nombre d'article"
author.value === '' ? author.value = '0' : null

const authorFunction = () => {
    if (author.value === '0') {
        document.location.href = `index.php?category=general&page=1&limit=10`;
    } else {
        document.location.href = `index.php?author=${author.value}&page=1&limit=10`;
    }
}

author.addEventListener('change', authorFunction)
