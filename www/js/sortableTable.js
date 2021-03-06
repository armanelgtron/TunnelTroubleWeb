/**
 * Makes any table sortable by clicking the header columns.
 * From https://github.com/beaudurrant/Sortable-Table-jQuery-Plugin
 * with additional Nelg modifications.
 * 
 * Usage: $(.class|#id).sortableTable(); HTML: <table class="ui-sortable-table">
 *
 * Copyright (C) 2016 Beau Durrant, MIT licensed.
 * https://github.com/beaudurrant/sortable-table-jquery-plugin/blob/master/LICENSE
 */

(function($) {

  /** PUBLIC FUNCTIONS */

  // constructor
  $.fn.sortableTable = function() {
    // add the standard ui class for styling the table
    // table
    $(this).addClass('ui-sortable-table');
    $(this).addClass('ui-sortable-table-initialized');
    // head
    $thead = $(this).find('thead');
    $thead.addClass('ui-sortable-thead');
    // body
    $tbody = $(this).find('tbody');
    $tbody.addClass('ui-sortable-tbody');
    // default to ascending order
    $tbody.removeClass('asc');
    $tbody.addClass('desc');
    // find the headers <th> and add the click event listener to each one and
    // classes for styling
    const theadTh = $(this).find('thead th');
    for (let i = 0; i < theadTh.length; i++) {
      $(theadTh[i]).addClass('ui-sortable-th');
      $(theadTh[i]).addClass('ui-sortable-th-' + i);
      $(theadTh[i]).click(sortColumn);
    }
  }

  /** PRIVATE FUNCTIONS */

  // click event to sort columns
  function sortColumn() {
    // don't sort columns with no text in the heading
    if ($(this).text() == '') return;
    // get the table
    $table = $(this).parent().parent().parent();
    // get the tbody
    $tbody = $table.find('tbody');
    // sort order of the column
    let sortOrder;
    if ($tbody.hasClass('asc')) {
      sortOrder = 'asc';
      $tbody.removeClass('asc');
      $table.find('th').removeClass('asc');
      $tbody.addClass('desc');
      $(this).addClass('desc');
    } else {
      sortOrder = 'desc';
      $tbody.removeClass('desc');
      $table.find('th').removeClass('desc');
      $tbody.addClass('asc');
      $(this).addClass('asc');
    }
    // index of the column we are clicking on
    const columIndex = $(this).index();
    // sort the columns
    $tbody.find('tr').sort(function(a, b) {
      if (sortOrder == 'desc') [a, b] = [b, a];
      
      var comp_a = $('td:eq(' + columIndex + ')', a).text();
      var comp_b = $('td:eq(' + columIndex + ')', b).text();
      var num_a = parseFloat(comp_a), num_b = parseFloat(comp_b);
      if(!isNaN(num_a) && !isNaN(num_b))
      {
        return (num_a > num_b) ? 1 : -1;
      }
      return comp_a.localeCompare(comp_b);
    }).appendTo($tbody);
  }

  /** INITIALIZE ANY TABLES WITH THE CLASS NAME NOT ALREADY INITIALIZED IN JS */

  $(document).ready(function() {
    const sortableTables = $('.ui-sortable-table:not(.ui-sortable-table-initialized)');
    for (let i = 0; i < sortableTables.length; i++) {
      $(sortableTables[i]).sortableTable();
    }
  });

})(jQuery);
