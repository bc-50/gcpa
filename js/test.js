// jQuery(function ($) {
//   $('#members').click(function () {
//     alert('start');
//     var members = ajax_posts.members;
//     var ourUpdatedPost = {
//       customer_id: 210,
//       plan_id: 242,
//       status: 'active',
//       product_id: 356,
//       end_date_gmt: '2021-02-05T10:10:00+00:00',
//     }
//     $.ajax({
//       beforeSend: function (xhr) {
//         xhr.setRequestHeader("X-WP-Nonce", ajax_posts.nonce);
//       },
//       url: ajax_posts.siteurl + "/wp-json/wc/v3/memberships/members",
//       type: "POST",
//       data: ourUpdatedPost,
//       success: function (response) {
//         console.log("congrats");
//         console.log(response);
//       },
//       error: function (response) {
//         console.log("soz");
//         console.log(response);
//       }
//     });
//   });
// });