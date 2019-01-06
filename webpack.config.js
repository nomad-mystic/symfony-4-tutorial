const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .addEntry('js/app', [
        './node_modules/jquery/dist/jquery.slim.js',
        './node_modules/popper.js/dist/popper.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/holderjs/holder.min.js',
        './assets/js/app.js',
    ])
    .addStyleEntry('css/app', ['./node_modules/bootstrap/dist/css/bootstrap.min.css', './assets/css/app.scss'])
    .enableSassLoader()
    .autoProvidejQuery();

module.exports = Encore.getWebpackConfig();