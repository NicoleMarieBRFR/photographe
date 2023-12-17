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

        function loadContent(action, paged, categorie, format, triDate, ajaxurl) {
            var data = {
                action: action,
                paged: paged,
                categorie: categorie,
                format: format,
                triDate: triDate
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
        $('#cat, #format, #triDate').on('change', function (e) {
            e.preventDefault();
            currentPage = 0; // Reinicia a contagem de páginas ao alterar os filtros
            const filterVide = document.querySelector(".photos-home ul");
            filterVide.innerHTML = '';
            $('.button_style').show(); // Exibe o botão novamente ao mudar os filtros

            var categorie = $('#cat').val();
            var format = $('#format').val();
            var triDate = $('#triDate').val();
            var ajaxurl = $(this).data('ajaxurl');

            loadContent('ajaxGallery', currentPage, categorie, format, triDate, ajaxurl);
        });

        // Chargement des commentaires en Ajax
        $('.button_style').click(function (e) {
            // Empêcher l'envoi classique du formulaire
            e.preventDefault();
            // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
            const ajaxurl = $(this).data('ajaxurl');
            var categorie = $('#cat').val();
            var format = $('#format').val();
            var triDate = $('#triDate').val();
            
            loadContent('ajaxGallery', currentPage, categorie, format, triDate, ajaxurl);

            //mudar somente para um nome depois de terminar a funçao
        });

// LIGHTBOX
        var slideIndex = 0;
        const links = Array.from(document.querySelectorAll('.photos-home img[src$=".png"], .photos-home img[src$=".jpg"], .photos-home img[src$=".jpeg"]'));
        const galery = links.map(link => link.getAttribute('src'))
        links.forEach(link => link.addEventListener('click', e => {
            e.preventDefault()
        }))
        console.log(galery);

        // a classe pra ativar o lightbox
        var lightbox = document.querySelector('.lightbox');  
        // botao pra fechar
        var closeLightbox = document.querySelector('.lightbox_close');  
        // seleciona todos os botoes pra abrir o lightbox
        var buttonlightbox = document.querySelectorAll('.button_lightbox');  
        // quando o botao é clicado para cada elemento button e o index é a posiçao dos elementos no array

        function generetedSlider(galery) {
            const imageGalery = document.querySelector(".lightbox_img");
            const catGalery = document.querySelector(".lightbox_cat");
            const titleGalery = document.querySelector(".lightbox_title");
        
            // Certifique-se de que slideIndex está dentro dos limites do array
            // Exibe a imagem
            imageGalery.src = galery[slideIndex];
    
            // Exibe a categoria
            const categories = links[slideIndex].getAttribute('data-categories');
            catGalery.innerHTML = categories;
    
            // Exibe o título 
            const title = links[slideIndex].getAttribute('data-title');
            titleGalery.innerHTML = title;

            console.log('slideIndex:', slideIndex);
            console.log('galery[slideIndex]:', galery[slideIndex]);
        }

        buttonlightbox.forEach(function(button, index) {
            button.addEventListener('click', function(e){
              e.preventDefault();        
              // display lightbox
              lightbox.style.display = 'block';
          
              generetedSlider(galery);
            });
          });

        const slideShow = galery[slideIndex];
        // Botões de navegação
        var flecheGauche = $('.lightbox_prev');
        var flecheDroite = $('.lightbox_next');

        // Quando o botão esquerdo é clicado
        flecheGauche.on('click', function () {

            if (slideIndex === 0) {
                slideIndex = galery.length - 1
            }
            else slideIndex--;

            generetedSlider(galery);
        });

        // Quando o botão direito é clicado
        flecheDroite.on('click', function () {

            if (slideIndex === galery.length - 1) {
            slideIndex = 0
            }
            else slideIndex++;
            generetedSlider(galery);
        });

        // botao de fechar
        closeLightbox.onclick = function() {
          lightbox.style.display = 'none';
        };

    });
})(jQuery);
