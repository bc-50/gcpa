$(function () {
  $(".single-gallery-image").lazy();

  $(".single-gallery-image").click(function (e) {
    var target = $(e.target);
    var dataT = $(target).data("target");
    $(dataT).css("display", "block");
    $("body").css("overflow", "hidden");
  });

  $(".gallery-pop-up").click(function (e) {
    if (!$(e.target).hasClass("gallery-pop-up")) {
      var target = $(e.target).parents(".gallery-pop-up");
    } else {
      var target = $(e.target);
      console.log(target);
    }
    $(target).css("display", "none");
    $("body").css("overflow", "auto");
  });

  var $hamburger = $(".hamburger");
  $hamburger.on("click", function (e) {
    $hamburger.toggleClass("is-active");
    // Do something else, like open/close menu
  });
  $(".seperator").each(function (i, e) {
    if ($(this).width() > 0) {
      $(this).css("border-left-width", $(this).width());
    }
  });

  var ppp = 3; // Post per page
  var pageNumber = 1;

  function load_posts() {
    pageNumber++;
    var data = {
      action: "more_post_ajax",
      ppp: ppp,
      pageNumber: pageNumber
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
        console.log(
          jqXHR.getAllResponseHeaders() +
          " :: " +
          textStatus +
          " :: " +
          errorThrown
        );
      }
    });
    return false;
  }

  function add_to_cart(data) {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: data,
      success: function (data) {
        console.log("Added to cart");
        $(".add-cart").attr("disabled", false); // Disable the button, temp.
        window.location.href = ajax_posts.siteurl + "/checkout";
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(
          jqXHR.getAllResponseHeaders() +
          " :: " +
          textStatus +
          " :: " +
          errorThrown
        );
      }
    });
    return false;
  }

  $("#more_posts").on("click", function () {
    // When btn is pressed.
    $("#more_posts").attr("disabled", true); // Disable the button, temp.
    load_posts();
  });

  $(".add-cart-care").on("click", function (e) {
    // When btn is pressed.
    var target = e.target;
    $(target).attr("disabled", true); // Disable the button, temp.
    add_to_cart($("#membeship-choice-care").val());
  });

  $(".add-cart-dom").on("click", function (e) {
    // When btn is pressed.
    var target = e.target;
    $(target).attr("disabled", true); // Disable the button, temp.
    add_to_cart($("#membeship-choice-dom").val());
  });

  /*
   * Select/Upload image(s) event
   */
  var custom_uploader;
  $('.gallery-wrapper').on('click', function (e) {
    e.preventDefault();

    if (custom_uploader) {
      custom_uploader.open();
      return;
    }


    var button = $(this),
      custom_uploader = wp.media.frames.file_frame = wp.media({
        frame: 'select',
        title: 'Insert image',
        multiple: 'add', // for multiple image selection set to true
        button: {
          text: 'Use this image' // button label text
        },
      });
    var html = "";
    var vals = "";
    custom_uploader.open();

    custom_uploader.on('select', function () { // it also has "open" and "close" events
      var selection = custom_uploader.state().get('selection');
      var map = selection.map(function (attachment) {
        attachment = attachment.toJSON();

        // $("button").after("<img src=" +attachment.url+">");

        $('.remove_image_button').show();
        html += "<div class=\"admin-image-wrapper\"><img src=" + attachment.url + "></div>";
        vals += "," + attachment.id;
        console.log(attachment);

      });
      vals = vals.slice(1);
      html += "<input type='hidden' name='my_details' id='my_details' value='" + vals + "' />";
      $(button).html(html);

    });
  });

  /*
   * Remove image event
   */
  $('body').on('click', '.remove_image_button', function () {
    $('.gallery-wrapper').html('Upload Image');
    $('.remove_image_button').hide();

    return false;
  });

  /* $(".woocommerce-checkout").on("submit", function(e) {
    e.preventDefault();
    window.location.href = ajax_posts.siteurl + "/members-login";
  }); */
});