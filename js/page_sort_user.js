  var $container = $('.isotope').isotope({
    itemSelector: '.page-info',
    layoutMode: 'fitRows',
    getSortData: {
      title: '.title',
      recent: '.recent parseInt',
      privacy: '.privacy parseInt',
    },
    sortAscending: {
        title: true,
        recent: false,
        privacy: false,
    }
  });

  // filter functions
  var filterFns = {
    // show if privacy is greater than 0
    onlyPrivate: function() {
      var number = $(this).find('.privacy').text();
      return parseInt( number, 10 ) > 0;
    },
    // show if privacy is less than 0
    onlyPublic: function() {
      var number = $(this).find('.privacy').text();
      return parseInt( number, 10 ) < 1;
    },
  };

  // bind filter button click
  $('#filters').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    // use filterFn if matches value
    filterValue = filterFns[ filterValue ] || filterValue;
    $container.isotope({ filter: filterValue });
  });

  // bind sort button click
  $('#sorts').on( 'click', 'button', function() {
    var sortByValue = $(this).attr('data-sort-by');
    $container.isotope({ sortBy: sortByValue });
  });
  
  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.btn-info').addClass('btn-primary');
      $buttonGroup.find('.btn-info').removeClass('btn-info');
      $( this ).addClass('btn-info');
    });
  });
