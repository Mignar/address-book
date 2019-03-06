var Encore = require('@symfony/webpack-encore');


Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')

    .addEntry('app', './assets/js/app.js')
    
    .enableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    // .enableSourceMaps(!Encore.isProduction())
    // .enableVersioning(Encore.isProduction())

    .enableSassLoader()
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
