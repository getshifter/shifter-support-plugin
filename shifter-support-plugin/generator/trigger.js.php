<?php
  $site_id = getenv('SITE_ID');
  $token = getenv('SHIFTER_TOKEN');
  $terminate_url = "https://kelbes0rsk.execute-api.us-east-1.amazonaws.com/production/v2/projects/${site_id}/wordpress_site/stop";
  $generate_url = "https://api.getshifter.io/v1/artifacts/${site_id}";
?>

<script type="text/javascript" >
  jQuery("li#wp-admin-bar-shifter_support_terminate .ab-item").on( "click", function() {
    swal({
      title: "Are you sure?",
      text: "If you run terminattion, The shifter app could not be accessed.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isRunTerminate) => {
      if (isRunTerminate) {
        call_shifter_operation(
          '<?php echo $terminate_url ?>',
          '<?php echo $token ?>',
          "Shifter app is terminated. Check your dashborad!",
          "Shifter app termination was failed!"
        );
      }
    });
  });

  jQuery("li#wp-admin-bar-shifter_support_generate .ab-item").on( "click", function() {
    swal({
      title: "Are you sure?",
      text: "If you start generate, The shifter app could not be accessed.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isRunTerminate) => {
      if (isRunTerminate) {
        call_shifter_operation(
          '<?php echo $generate_url ?>',
          '<?php echo $token ?>',
          "Shifter app is generated. Check your dashborad!",
          "Shifter app generation was failed!"
        );
      }
    });
  });

  function call_shifter_operation(url, token, successMsg, failedMsg) {
    jQuery.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      contentType: 'application/json',
      crossDomain: true,
      headers: {
        'Authorization': token
      },
      success: (response) => { swal(successMsg, { icon: "success" }); },
      error: (response) => { swal(failedMsg, { icon: "Warning" }); }
    });
  }

</script>
