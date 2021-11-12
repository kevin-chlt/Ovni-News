const userForm = document.getElementById("form-user");
const menu = document.getElementById('menu');
const hamburger = document.getElementById('btn-category');
const btnContainer = document.querySelector('.header-nav');

// ADD EVENT LISTENER ON BUTTON FOR SUBMIT THE SUBSCRIBE FORM  //
if(document.getElementById('submit-btn') !== null){
    const submitBtn = document.getElementById('submit-btn');
    submitBtn.addEventListener('click', () => {
        userForm.submit();
    })
}

// DROPDOWN CATEGORY //
const createDropDownMenu = () => {
    if (menu.style.display === 'flex') {
        hamburger.style.transform = 'initial';
        menu.classList.remove('responsive-dropdown_open');
        menu.classList.add('responsive-dropdown_close');
        setTimeout(() => { menu.style.display = 'none'; }, 600);
    } else {
        hamburger.style.transform = 'rotateZ(90deg)';
        menu.style.display = 'flex';
        setTimeout(() => {
            menu.classList.remove('responsive-dropdown_close');
            menu.classList.add('responsive-dropdown_open');
        }, 10);
    }
}
hamburger.addEventListener('click', createDropDownMenu);



// SWITCHER LOGIN FORM/SUBSCRIBE PAGE LINK AND DISPLAY PROPERTY RESIZE WINDOWS SCREEN ACTION //
const switcherLoginForm_SubscribePage = () => {
    if (document.getElementById('userboardContainer') === null) {
        const connectBtn = document.getElementById('btn-img_connexion');
        const containerFormConnect = document.getElementById('container-formConnect');
        const subscribeLink = document.getElementById('subscribe-container');
        let showForm = false;
        connectBtn.addEventListener('click', () => {
            if (showForm === false) {
                showForm = true;
                containerFormConnect.style.display = 'flex';
                userForm.style.flexDirection = 'column';
                subscribeLink.style.display = 'none';
            } else {
                showForm = false;
                containerFormConnect.style.display = 'none';
                subscribeLink.style.display = 'flex';
            }
        });
        window.addEventListener('resize', () => {
            if (window.matchMedia("(min-width: 1400px)").matches) {
                // TAILLE D'ECRAN SUPERIEUR A 1400PX //
                containerFormConnect.style.display = 'grid';
                subscribeLink.style.display = 'flex';
                userForm.style.flexDirection = 'column';
            } else if (window.matchMedia("(min-width: 900px)").matches) {
                // TAILLE SUP A 900px ET INF A 1400PX //
                containerFormConnect.style.display = 'flex';
                subscribeLink.style.display = 'flex';
                userForm.style.flexDirection = 'row';
            } else if (window.matchMedia('(max-width: 899px)').matches) {
                // TAILLE INFERIEUR A 819PX //
                containerFormConnect.style.display = 'none';
                subscribeLink.style.display = 'flex';
            }
        })
    }
}
switcherLoginForm_SubscribePage();

// UNDISPLAY DROPDOWN WHEN SCREEN SIZE OVER 1400PX //
window.addEventListener('resize', () => {
    if (window.matchMedia("(min-width: 1400px)").matches){
        menu.style.display = 'none';
    }
})

// ADD BACKGROUND COLOR TO THE CATEGORY IN THE DOM WITH URL PARAMS //
const category  = new URL(window.location.href).searchParams.get('category');
const color = {
        'business' : '#1B1A17',
        'general' : '#98DED9',
        'science' : '#9DAD7F',
        'entertainment' : '#B4AEE8',
        'health' : '#185ADB',
        'technology' : '#B4846C',
        'sports' : '#9FE6A0'
    }

const findColor = (category) => {
    for (let theme in color) {
        if (category === theme) {
            return color[theme];
        }
    }
}

const findBtn = (btn, category) => {
    for (let i = 0; i < btnContainer.children.length; i++) {
        if(btn.children[i].classList[1] === category ){
            btn.children[i].style.background = findColor(category);
            btn.children[i].style.color = '#ffffff';
        }
    }
}


// DETERMINE IF WE ARE IN DETAIL PAGE OR ARTICLES PAGE AND ADD ARGS ON FUNCTION //
if(category === null ){
    if(document.getElementById('linkWithCategory') !== null) {
        // WE'RE IN DETAIL PAGE //
        const link = document.getElementById('linkWithCategory'); // LINK IN THE NEXT BUTTON
        const category2 = new URL(link.href).searchParams.get('category');
        findBtn(btnContainer, category2);
    }
} else { // ELSE IN ARTICLE PAGE //
    findBtn(btnContainer, category);
}




