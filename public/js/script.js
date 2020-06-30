let elt = document.getElementById('help');
let eltHref = document.querySelector('.js-help');

let openHelp = function (event) {
    event.preventDefault()
    let url = this.href;
    let eltH1 = document.querySelector('.js-h2');
    let eltP = document.querySelector('.js-p');
    let eltButton = document.querySelector('.js-button')

    axios.get(url).then(function (response) {
        eltH1.textContent = response.data.name;
        eltP.textContent = response.data.content;
    }).catch(function (error) {
        window.alert("Une erreur c'est produite veuillez réessayez.")
    })

    eltHref.style.display = 'none'
    elt.style.display = 'block'
    eltButton.addEventListener('click', closeHelp);

}

let closeHelp = function (event) {
    event.preventDefault()
    elt.style.display = 'none';
    eltHref.style.display = 'block';

}

document.querySelectorAll('.js-help').forEach(a => {
    a.addEventListener('click', openHelp)
})
