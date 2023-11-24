//Onclick bouton contact
function go(reference){
	document.getElementById('ref_field').setAttribute('value', reference);
}

jQuery(document).ready(function(jQuery){
	//open popup
	jQuery('.cd-popup-trigger').on('click', function(event){
		event.preventDefault();
		jQuery('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	jQuery('.cd-popup').on('click', function(event){
		if( jQuery(event.target).is('.cd-popup-close') || jQuery(event.target).is('.cd-popup') ) {
			event.preventDefault();
			jQuery(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	jQuery(document).keyup(function(event){
    	if(event.which=='27'){
    		jQuery('.cd-popup').removeClass('is-visible');
	    }
    });
});

//menu hamburger
let dropdown = document.querySelector('.menu'), //ul
    buttonClick = document.querySelector('.check-button'), //button
    hamburger = document.querySelector('.menu-icon');

buttonClick.addEventListener('click', () => {
    dropdown.classList.toggle('show-dropdown'); // add class
    hamburger.classList.toggle('animate-button');

	if (buttonClick.classList.contains('show-dropdown')) {
        buttonClick.classList.remove('show-dropdown');
        document.body.style.overflow = 'auto';
    } else {
        buttonClick.classList.add('show-dropdown');
        document.body.style.overflow = 'hidden';
    }
})

document.addEventListener("DOMContentLoaded", function() {
    // Selecione o botão ou o elemento que deve ativar o menu
    const toggleButton = document.getElementById("check-button");
    const menuMain = document.getElementById("menu-main-menu");

    // Adicione um ouvinte de evento ao botão
    toggleButton.addEventListener("click", function() {
        // Verifique se o elemento tem a classe .show-dropdown
        if (menuMain.classList.contains("show-dropdown")) {
            // Se tiver a classe, remova-a para ocultar o menu
            menuMain.classList.remove("show-dropdown");
        } else {
            // Se não tiver a classe, adicione-a para mostrar o menu
            menuMain.classList.add("show-dropdown");
        }
    });
});

// CODIGO NOVO MISTURA DOS DOIS BUTTON E FILTROS
(function ($) {
    $(document).ready(function () {
        let currentPage = 1; // Inicie em 0 para a primeira carga

        function loadContent(action, paged, categorie, format, ajaxurl) {
            var data = {
                action: action,
                paged: paged,
                categorie: categorie,
                format: format
            }

            console.log(ajaxurl);
            console.log(data);

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log(response.data);

                    // Adiciona as novas fotos à lista existente
                    $(".photos-home ul").append(response.data);

                    if (!response.success || response.data.trim() === "") {
                        $('.button_style').hide(); // Oculta o botão se não houver mais conteúdo
                        return;
                    }
                    currentPage++;  // Incrementa a página após o AJAX ser bem-sucedido e houver mais conteúdo
                    console.log(currentPage);
                },
                error: function () {
                    // Tratar erros, se necessário
                }
            });
        }

        // Carregar via filtros
        $('#cat, #format').on('change', function (e) {
            e.preventDefault();
            currentPage = 0; // Reinicia a contagem de páginas ao alterar os filtros
            const filterVide = document.querySelector(".photos-home ul");
            filterVide.innerHTML = '';
            $('.button_style').show(); // Exibe o botão novamente ao mudar os filtros

            var categorie = $('#cat').val();
            var format = $('#format').val();
            var ajaxurl = $(this).data('ajaxurl');

            loadContent('ajaxGallery', currentPage, categorie, format, ajaxurl);
        });

        // Chargement des commentaires en Ajax
        $('.button_style').click(function (e) {
            // Empêcher l'envoi classique du formulaire
            e.preventDefault();
            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
            const ajaxurl = $(this).data('ajaxurl');
            var categorie = $('#cat').val();
            var format = $('#format').val();
            
            loadContent('ajaxGallery', currentPage, categorie, format, ajaxurl);

            //mudar somente para um nome depois de terminar a funçao
        });
    });
})(jQuery);