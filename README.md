# shifter-support-plugin
- This plugin provided you to terminate app or to generate artifact on WordPress Dashboard.
- This plugin display Diag information on your WordPress Dashboard.

## Plugin Development

This plugin includes build tools and package management for its dependencying including NPM, build config managed with Gulp, and Sass.

```
.
+-- gulpfile.js     // Build and Dev Config
+-- /src            // Temp file for local dev css and js
+-- /dist           // Build directory, tracked with Git
```

### Getting Started

```
yarn (or npm) install
```

Start watch for automated JS and CSS builds. Starts BrowserSync for injecting CSS and reloading JS changes.

Default [proxy](https://browsersync.io/docs/options#option-proxy) is `127.0.0.1:8443` to match [Shifter-Local](https://github.com/getshifter/shifter-local).

```
yarn (or npm) run start
```

Override default proxy with the `--devUrl` flag.
```
yarn run start --devUrl https://example.dev
```

## Build Release

```
yarn (or npm) run build --production
```
