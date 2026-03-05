const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

// Template front-end build configuration
Encore
    .setOutputPath('wp-content/plugins/bp_wpuc/themes/default/assets/build')
    .setPublicPath('wp-content/plugins/bp_wpuc/themes/default/assets/build/')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader()
    .disableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .configureBabel((config) => {
    }, {
        includeNodeModules: [],
        useBuiltIns: 'usage',
        corejs: 3
    })
    .enablePostCssLoader()
    .addEntry('theme', [
        './.dev/scss/theme.scss',
        './.dev/js/theme.js'
    ]);

// Export configurations
module.exports = Encore.getWebpackConfig();