( function( $ ){
  $(document).ready( function () {
    /* Gebruik selector, de tooltips in .woocommerce-checkout-review-order-table zijn niet noodzakelijk al aanwezig bij DOM load! */
    $('body').tooltip({
      selector: '.tooltip'
    });

    $("#menu-btn").on('click', function(e) {
      e.preventDefault();
      $("#side-menu").addClass("active");
      $("body").addClass("active");
    });

    $("#menu-btn-close").on('click', function() {
      $("#side-menu").removeClass("active");
      $("body").removeClass("active");
    });

    $('.woocommerce-product-details__short-description').readmore({
      collapsedHeight: 72,
      heightMargin: 24,
      moreLink: '<a href="#">Lees meer</a>',
      lessLink: '<a href="#">Lees minder</a>'
    });

    $('.promotie > .collapse-read-more').readmore({
      collapsedHeight: 0,
      heightMargin: 0,
      moreLink: '<a href="#" style="display: inline;">Toon voorwaarden</a>',
      lessLink: '<a href="#" style="display: inline;">Verberg voorwaarden</a>'
    });

    $('.header__item_search').on( 'click', function() {
      $('.top-search_mobile').toggleClass('hidden');
    });

    $(".toggle-filter").on('click', function() {
      $("body").addClass('active');
      $(".nm-shop-sidebar-default #nm-shop-sidebar").addClass('show-me');
    });

    $(".close-filter").on('click', function() {
      $("body").removeClass('active');
      $(".nm-shop-sidebar-default #nm-shop-sidebar").removeClass('show-me');
    });
  });

  $(document).mouseup(function(e){
    var container = $("#side-menu, .catalog-filters");
    if (!container.is(e.target) && container.has(e.target).length === 0){
      $("#side-menu").removeClass("active");
      $("body").removeClass("active");
      $(".nm-shop-sidebar-default #nm-shop-sidebar").removeClass('show-me');
    }
  });

})(jQuery);
