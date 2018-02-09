export function shifter_dashboard_widget() {
  jQuery(document).ready(
    function($) {
      $("#shifter-support-diag-styled").show();
      $("#shifter-support-diag-text-target").hide();

      $("#shifter-support-diag-change-view").on("click", function(e) {
        e.preventDefault();
        $("#shifter-support-diag-styled-target").toggle();
        $("#shifter-support-diag-text-target").toggle();
      });
    }
  );
};

// export function shifter_copy_diag() {
//   jQuery(document).ready(
//     function($) {
//       $("#shifter-support-diag-change-view").on("click", function(e) {
//         copy("shifter diag info..");
//       });
//     }
//   );
// }
