<?php
function link_to($url) {
  echo '<a href="' . $url . '">' . $url . '</a>';
}
?>

<nav>
  <a href="#shifter-support-diag" id="shifter-support-diag-change-view">Change View</a>
</nav>

<div id="shifter-support-diag" class="shifter-support-diag">
  <div id="shifter-support-diag-styled-target">
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
        <tr>
          <?php $theme = wp_get_theme() ?>
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
        <?php $plugins = get_option("active_plugins"); ?>
        <?php foreach($plugins as $plugin) { ?>
          <tr>
            <?php $plugin_meta = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin); ?>
            <td class="shifter-support-name"><?php echo $plugin_meta['Name']; ?></td>
            <td class="shifter-support-url"><?php echo link_to($plugin_meta['PluginURI']); ?></td>
            <td class="shifter-support-version"><?php echo $plugin_meta['Version']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div id="shifter-support-diag-text-target">
    <p>Theme</p>
    <p>
      name: <?php echo $theme->get("Name"); ?>,
      URI: <?php echo link_to($theme->get("ThemeURI")); ?>,
      Version: <?php echo $theme->get("Version"); ?><br />
    </p>
    <br />
    <p>Activated Plugins</p>
      <?php $plugins = get_option("active_plugins"); ?>
      <?php foreach($plugins as $plugin) { ?>
        <?php $plugin_meta = get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin); ?>
        name: <?php echo $plugin_meta['Name']; ?>,
        URI: <?php echo link_to($plugin_meta['PluginURI']); ?>,
        Version: <?php echo $plugin_meta['Version']; ?><br />
      <?php } ?>
      <br />
      <br />
  </div>
</div>
