<script type="text/javascript" >
  jQuery("li#wp-admin-bar-shifter_support_terminate .ab-item").on( "click", function() {
    swal({
      title: "You are about to run 'Terminate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation(
          "shifter_app_terminate",
          "Your Shifter app is terminated. Check your dashborad!"
        );
      }
    });
  });

  jQuery("li#wp-admin-bar-shifter_support_generate .ab-item").on( "click", function() {
    swal({
      title: "You are about to run 'Generate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation(
          "shifter_app_generate",
          "Generating artifact is starting now. Check your dashborad!"
        );
      }
    });
  });

  function call_shifter_operation(action, message) {
    jQuery.ajax({
      method: 'POST',
      url: ajaxurl,
      data: { 'action': action }
    }).done((response) => {
      swal(message, { icon: "success" });
    })
  }
</script>
