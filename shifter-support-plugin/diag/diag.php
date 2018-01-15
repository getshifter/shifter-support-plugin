<?php
function link_to($url) {
  echo '<a href="' . $url . '">' . $url . '</a>';
}
?>

<h2>Theme</h2>
<table>
  <thead>
    <tr class="shifter-diag">
      <th>name</th>
      <th>url</th>
      <th>version</th>
    </tr>
  </thead>
    <tr>
      <?php $theme = wp_get_theme() ?>
      <td class="shifter-support-name"><?php echo $theme->get('Name'); ?></td>
      <td class="shifter-support-url"><?php echo link_to($theme->get('ThemeURI')); ?></td>
      <td class="shifter-support-version"><?php echo $theme->get('Version'); ?></td>
    </tr>
  <tbody>
  </tbody>
</table>

<h2>Activated Plugins</h2>
<table>
  <tr class="shifter-diag">
    <th>name</th>
    <th>url</th>
    <th>version</th>
  </tr>
  <tbody>
    <?php $plugins = get_option('active_plugins'); ?>
    <?php foreach($plugins as $plugin) { ?>
      <tr>
        <?php $plugin_meta = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin); ?>
        <td class="shifter-support-name"><?php echo $plugin_meta[Name]; ?></td>
        <td class="shifter-support-url"><?php echo link_to($plugin_meta[PluginURI]); ?></td>
        <td class="shifter-support-version"><?php echo $plugin_meta[Version]; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
