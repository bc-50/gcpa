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

  function add_to_cart(data) {
    $.ajax({
      type: "POST",
      dataType: "html",
      url: data,
      success: function (data) {
        console.log('Added to cart');
        $('.add-cart').attr("disabled", false); // Disable the button, temp.
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
    add_to_cart($('#membeship-choice').val());
  });


  /*
   * Select/Upload image(s) event
   */
  $('.misha_upload_image_button').on('click', function (e) {
    e.preventDefault();

    if (custom_uploader) {
      custom_uploader.open();
      return;
    }

    var button = $(this),
      custom_uploader = wp.media.frames.file_frame = wp.media({
        title: 'Insert image',
        // library: {
        //   // uncomment the next line if you want to attach image to the current post
        //   // uploadedTo : wp.media.view.settings.post.id, 
        //   type: 'image'
        // },
        button: {
          text: 'Use this image' // button label text
        },
        multiple: true, // for multiple image selection set to true
      })
      
      
      custom_uploader.on('select', function () { // it also has "open" and "close" events 
        var selection = custom_uploader.state().get('selection');
        var map = selection.map( function( attachment ) {
          attachment = attachment.toJSON();

          // $("button").after("<img src=" +attachment.url+">");
          $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show(); 
          return attachment;
        });
        console.log(map);

        /* var attachment = custom_uploader.state().get('selection').toJSON();
        console.log(attachment);
        $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show(); */
        /* if you sen multiple to true, here is some code for getting the image IDs */
        /* var attachments = frame.state().get('selection'),
          attachment_ids = new Array(),
          i = 0;
        attachments.each(function (attachment) {
          attachment_ids[i] = attachment['id'];
          console.log(attachment);
          i++; 
        });*/

      });
      custom_uploader.open();
  });

  /*
   * Remove image event
   */
  $('body').on('click', '.misha_remove_image_button', function () {
    $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
    return false;
  });


});