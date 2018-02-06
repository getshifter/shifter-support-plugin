
const swal = require('sweetalert');

export function terminate_app() {
  jQuery(document).on("click", "#wp-admin-bar-shifter_support_terminate", function() {
    console.log('Terminate');
    swal({
      title: "You are about to run 'Terminate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation("shifter_app_terminate");
        swal("Your Shifter app is terminated. Check your dashboard!", {icon: "success"})
        .then(() => window.close());
      }
    });
  });

};


export function generate_artifact() {
  jQuery(document).on("click", "#wp-admin-bar-shifter_support_generate", function() {
    console.log('Generate');
    swal({
      title: "You are about to run 'Generate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation("shifter_app_generate");
        swal("Generating artifact is starting now. Check your dashboard!", {icon: "success"})
        .then(() => window.close());
      }
    });
  });
}


export function call_shifter_operation(action) {
  jQuery.ajax({
    method: "POST",
    url: ajaxurl,
    data: { "action": action }
  }).done((response) => {
    console.log(response);
  });
};
