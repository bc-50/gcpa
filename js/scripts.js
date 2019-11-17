$(function () {
  var $hamburger = $('.hamburger');
  $hamburger.on('click', function (e) {
    $hamburger.toggleClass('is-active');
    // Do something else, like open/close menu
  });
  $('.seperator').each(function (i, e) {
    if ($(this).width() > 0) {
      $(this).css('border-left-width', $(this).width());
    }
  });

  var ppp = 3; // Post per page
  var pageNumber = 1;

  function load_posts() {
    pageNumber++;
    var data = {
      action: 'more_post_ajax',
      ppp: ppp,
      pageNumber: pageNumber,
    };

    $.ajax({
      type: "POST",
      dataType: "html",
      url: ajax_posts.ajaxurl,
      data: data,
      success: function (data) {
        var $data = $(data);
        if ($data.length) {
          $("#ajax-posts").append($data);
          $("#more_posts").attr("disabled", false);
        } else {
          $("#more_posts").attr("disabled", true);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.getAllResponseHeaders() + " :: " + textStatus + " :: " + errorThrown);
      }

    });
    return false;

  }

  function add_to_cart(data){
    $.ajax({
      type: "POST",
      dataType: "html",
      url: data,
      success: function (data) {
        console.log('Success');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.getAllResponseHeaders() + " :: " + textStatus + " :: " + errorThrown);
      }

    });
    return false;
  }

  $("#more_posts").on("click", function () { // When btn is pressed.
    $("#more_posts").attr("disabled", true); // Disable the button, temp.
    load_posts();
  });


  $(".add-cart").on("click", function (e) { // When btn is pressed.
    var target = e.target;
    $(target).attr("disabled", true); // Disable the button, temp.
    add_to_cart($(target).data('cart'));
    
  });
});