// ==== CONFIGURATION ==== //

// Project settings
module.exports = {
  path: {
    src: './app/Resources/assets/', // Raw files
    dist: './web/assets/', // Compiled files
    composer: './vendor/', // Composer packages
    modules: './node_modules/' // npm packages
  },
	proxy: '127.0.0.1:8000'
}
