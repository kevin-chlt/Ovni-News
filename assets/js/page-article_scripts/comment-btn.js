const commentForm = document.getElementById("comment-form");
const commentBtn = document.getElementById('comment-btn');
const helpText = document.getElementById('help-text_comment');
const allCommentsBox = document.getElementsByClassName('user-comments_box');

// Add event submission form on IMG //
commentBtn.addEventListener('click', () => {
    commentForm.submit();
})

// If comment is pair align self at left or impair at right  //
for(let i = 0; i < allCommentsBox.length; i++) {
    if(i % 2 === 0) {
        allCommentsBox[i].style.alignSelf = 'flex-start';
    }
}

// Display comment from the PHP method  //
const showSucessMessage = () => {
    if(helpText.innerText === '') {
        helpText.remove();
        return;
    } else if (helpText.innerText === 'Votre message à bien été envoyé !') {
        helpText.style.background = '#468847';
    } else {
        helpText.style.background = '#D83A56';
    }
    helpText.style.transition = 'all 1.5s';
    setTimeout(() => {helpText.style.opacity = '0';}, 4000)
    setTimeout(() => {helpText.remove();}, 5000);
}
showSucessMessage();


