module.exports = {
    // publicPath: process.env.NODE_ENV === 'production'
      // ? '/phantom-app/'
      // : '/',
      devServer: {
        proxy: {
          '^/api-phantom': {
            target: 'http://localhost',
            ws: true,
            changeOrigin: true
          }
        }
      }
}