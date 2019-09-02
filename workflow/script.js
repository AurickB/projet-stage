"use strict"

function toggleNav() {
  /**
   * Au clic d'un élément possédant la classe "menu-toggle".
   * Au premier click on ajout la classe "is-opened".
   * Au deuxième click on enlève la classe "is-opened".
   */
  $('.menu-toggle').click(function () {
    $('.content').toggleClass('is-opened');
  });
  // Fermer le menu responsive au click sur un élément du menu.
  $('ul li a').click(function () {
    $('.menu-toggle:visible').click();
  });
}
toggleNav();


function displayScrollMenu() {
  let acc = document.getElementsByClassName("accordionItemHeading");
  let accItem = document.getElementsByClassName('accordionItem');
  let i;
  // On parcours tous les titres.
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
      // On crée une variable qui renvoie la valeur du noeud parent.
      let itemClass = this.parentNode.className;
      /**
       * Au click sur le titre d'un élément accordéon,
       * On réduit tout les éléments accordéon.
       */
      for (i = 0; i < accItem.length; i++) {
        accItem[i].className = 'accordionItem close';
        console.log("close")
      }
       
      // Si au click le noeud parent à pour class "close" alors il récupère la class "open".
       
      if (itemClass == 'accordionItem close') {
        this.parentNode.className = 'accordionItem open';
        console.log("open")
      }
    });
  }
}
displayScrollMenu();

function scrollTo() {
  // Au clic sur un lien possédant la class "js-scrollTo".
  $('.js-scrollTo').on('click', function () {
    if (
      location.hostname == this.hostname
      && this.pathname.replace(/^\//, "") == location.pathname.replace(/^\//, "")
    ) {
      // Enregistrement de l'attribut href dans la variable target.
      let target = $(this).attr('href');
      /**
       * On arrete les animation en cours.
       * On déclenche l'animation vers notre ancre target.
       */
      $('html, body').stop().animate({ scrollTop: $(target).offset().top }, 'slow');
      return false;
    }

  });
}
scrollTo();


function topBotton() {
  document.addEventListener('DOMContentLoaded', function () {
    window.onscroll = function () {
      document.getElementById("topBotton").className = (window.pageYOffset > 50) ? "visible" : "invisible";
    };
  });
}
topBotton();


