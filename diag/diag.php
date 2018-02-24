<?php
$site_id = getenv("SITE_ID", 'undefined_siteid');
function link_to($url) {
  echo '<a href="' . $url . '">' . $url . '</a>';
}
?>

<div class="shifter-diag-wrap">

<nav class="system-report-nav">
  <a href="#" id="shifter-support-diag-copy" class="button">Copy to your clipboard</a>
</nav>

<div aria-hidden="true" id="shifter-debug-meta" class="shifter-debug-meta">
  <?php // System Report Vars
  $theme_data = (array) wp_get_theme();
  $theme = wp_get_theme();
  $plugins = (array) get_option("active_plugins");
  $system_report = array(
    'project_id' => $site_id,
    'theme' => array(
      'Name' => $theme->get('Name'),
      'ThemeURI' => $theme->get('ThemeURI'),
      'TextDomain' => $theme->get('TextDomain'),
      'Version' => $theme->get('Version'),
    )
  );
  $plugins_report = array();
  foreach($plugins as $plugin) {
    $plugin_meta = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);
    $plugins_report[] = array(
      'Name' => $plugin_meta['Name'],
      'PluginURI' => $plugin_meta['PluginURI'],
      'TextDomain' => $plugin_meta['TextDomain'],
      'Version' => $plugin_meta['Version'],
    );
  };
  $system_report = array_merge(
    $system_report,
    array("active_plugins" => $plugins_report)
  );
  $system_report = json_encode($system_report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  echo trim($system_report); ?>
</div>

<div id="shifter-support-diag" class="shifter-support-diag">
  <div id="shifter-support-diag-styled-target">
    <?php if ($site_id) { ?>
      <h2>Project ID</h2>
      <pre><code><?php echo $site_id ?></code></pre>
    <?php } ?>
    <h2>Theme</h2>
    <table>
      <thead>
        <tr class="shifter-diag">
          <th>name</th>
          <th>url</th>
          <th>version</th>
        </tr>
      </thead>
      <tbody>
        <tr class="shifter-diag__row">
          <td class="shifter-support-name"><?php echo $theme->get("Name"); ?></td>
          <td class="shifter-support-url"><?php echo link_to($theme->get("ThemeURI")); ?></td>
          <td class="shifter-support-version"><?php echo $theme->get("Version"); ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Activated Plugins</h2>
    <table>
      <thead>
        <tr class="shifter-diag">
          <th>name</th>
          <th>url</th>
          <th>version</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($plugins as $plugin) { ?>
          <tr class="shifter-diag__row">
            <?php $plugin_meta = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin); ?>
            <td class="shifter-support-name"><?php echo $plugin_meta['Name']; ?></td>
            <td class="shifter-support-url"><?php echo link_to($plugin_meta['PluginURI']); ?></td>
            <td class="shifter-support-version"><?php echo $plugin_meta['Version']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

</div>
