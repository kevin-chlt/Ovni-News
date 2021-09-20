const inputContainer = document.getElementById('inputContainer');
const nextBtn = document.getElementById('nextBtn');
const spanCounter = document.getElementById('spanCounter');
const submitBtn = document.getElementById('submitBtn');
const backBtn = document.getElementById('backBtn');
const label = document.getElementById('label');


const data = [
    {
        placeholder: 'Entrer une adresse email valide',
        type: 'email',
        name: 'email',
        id: 0
    },
    {
        placeholder: 'Taper votre prénom',
        type: 'text',
        name: 'firstName',
        id: 1
    },
    {
        placeholder: 'Taper votre nom',
        type: 'text',
        name: 'lastName',
        id: 2
    },
    {
        placeholder: 'Inserer un mot de passe sûr',
        type: 'password',
        name: 'password',
        id: 3
    },
    {
        placeholder: 'Quand êtes vous née ? (JJ/MM/AAAA)',
        type: 'date',
        name: 'birthDate',
        id: 4
    },
];

submitBtn.hidden = true;
backBtn.hidden = true;
label.textContent = '';
let count = 0;

nextBtn.addEventListener('click', () => {
    let item = document.getElementById(count.toString());

    if(count < data.length && item.value.length !== 0 && item.value !== '') {
        count ++;
        inputCreator(count);
        inputStateHidden(count -1, true);
        spanCounter.textContent = (count +1) + '/5';
        displayButtons(count);
        getLabelDisplay(count);
    } else {
        label.textContent = 'Veuillez renseigner le champ svp'
    }
})


backBtn.addEventListener('click', () => {
        if (count > 0) {
        document.getElementById(count.toString()).remove();
        count --;
        inputStateHidden(count, false);
        spanCounter.textContent = (count +1) + '/5';
        displayButtons(count);
        getLabelDisplay(count);
    }
});

const inputCreator = (count) => {
    const newInput = document.createElement('input');
    newInput.classList.add('subscribe-input');
    for (let attribute in data[count]) {
        newInput.setAttribute(attribute, data[count][attribute]);
    }
    inputContainer.appendChild(newInput);
};

const displayButtons = (count) => {
    switch (count) {
        case 0:
            backBtn.hidden = true;
            nextBtn.hidden = false;
            submitBtn.hidden = true;
            break;
        case 1:
            backBtn.hidden = false;
            break;
        case 2:
        case 3:
            submitBtn.hidden = true;
            nextBtn.hidden = false;
            break;
        case 4:
            submitBtn.hidden = false
            nextBtn.hidden = true;
            backBtn.hidden = false;
            break;
    }
}

const inputStateHidden = (count, hiddenState) => {
    const input = document.getElementById(count.toString());
    input.hidden = hiddenState;
};

const getLabelDisplay = (count) => {
    label.textContent = '';
    const input = document.getElementById(count.toString());
    input.addEventListener('focus', (e)=> {
        label.textContent = data[count].placeholder;
        if (e.target.value.length === 0 ){
            label.textContent = '';
        }
    })
    input.addEventListener('blur', (e ) => {
        label.textContent = '';
        if (e.target.value.length > 0){
            label.textContent = data[count].placeholder;
        }
    })
    // VERIFICATION DE L'EMAIL AVEC REGEX //
    if(count === 0) {
        nextBtn.disabled = true;
        input.addEventListener('blur', () => {
            const pattern =  /\S+@\S+\.\S+/
            if(pattern.test(input.value)){
                nextBtn.disabled = false;
            } else {
                label.textContent = 'Veuillez saisir une adresse email valide';
            }
        })
    }
}
getLabelDisplay(count);



