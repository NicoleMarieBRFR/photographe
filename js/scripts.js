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

// voir plus page d'accueil
(function ($) {
    $(document).ready(function () {
        let currentPage = 1;
        // Chargment des commentaires en Ajax
        $('.button_style').click(function (e) {
            // Empêcher l'envoi classique du formulaire
            e.preventDefault();

            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
            const ajaxurl = $(this).data('ajaxurl');
            
            // Les données de notre formulaire
			// ⚠️ Ne changez pas le nom "action" !
            var data = {
                action: 'button_load',
                paged: currentPage,
                //category: valeur de select changé
            }

            // Pour vérifier qu'on a bien récupéré les données
            console.log(ajaxurl);
            console.log(data);

            // Requête Ajax en JS natif via Fetch
            fetch(ajaxurl, {
                method: 'POST',
                dataType: 'html',
                body: new URLSearchParams(data),

            })
            .then(response => response.json())
            .then(body => {
                console.log(body.data);
                $(".photos-home ul").append(body.data);
                // En cas d'erreur
                if (!body.success) {
                    $(this).hide();
                    return;
                }
                currentPage++;
                // Et en cas de réussite
                //$(this).hide(); // Cacher le formulaire
                // $('').html(body.data); // Et afficher le HTML
            });
        });
        
    });
})(jQuery);

// EU DEVO MISTURAR OS DOIS CODIGOS PARA QUE QUANDO EU CLICAR NO BOTAO CARREAGR MAIS, NAO TENHA MAIS ELEMENTOS MISTURAR E SIM SOMENTE DO FILTRO

//AJAX FILTERS
(function ($) {
    $(document).ready(function () {
        let currentPage = 1;
        
        // Carregar comentários usando Ajax
        $('#cat, #format').on('change', function(e) {
            e.preventDefault();

            const ajaxurl = $(this).data('ajaxurl');

            var categorie = $('#cat').val();
            var format = $('#format').val();

            // Adicione os parâmetros de filtro que deseja enviar
            var data = {
                action: 'filters',
                paged: currentPage,
                categorie: categorie,
                format: format
            }

            console.log(ajaxurl);
            console.log(data);

            // Requête Ajax usando jQuery
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    console.log(response.data);
                    $(".photos-home ul").append(response.data);

                    if (!response.success) {
                        $(this).hide();
                        return;
                    }
                    currentPage++;
                },
                error: function () {
                    // Tratar erros, se necessário
                }
            });
        });
    });
})(jQuery);
