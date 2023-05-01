var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where all compiled assets will be stored
    .addEntry('invoice', './assets/js/invoice.js')
    // ... other Encore configurations ...

    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .configureWatchOptions((config) => {
        config.poll = 500; // check for changes every 500 milliseconds
    })


Encore.enableSingleRuntimeChunk();
module.exports = Encore.getWebpackConfig();
