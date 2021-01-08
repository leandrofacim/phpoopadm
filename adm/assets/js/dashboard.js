$(document).ready(function () {
    //Apresentar ou ocultar o menu
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });
    
    //carregar aberto o submenu
    let active = $('.sidebar .active');
    if (active.length && active.parent('.collapse').length) {
        let parent = active.parent('.collapse');

        parent.prev('a').attr('aria-expanded', true);
        parent.addClass('show');
    }
});

function previewImagem() {
    const imagem = document.querySelector('input[name=imagem]').files[0];
    const preview = document.querySelector('#preview-user');
    
    const reader = new FileReader();
    reader.onloadend = () => {
        preview.src = reader.result;
    }
    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = '';
    }
    
}