module.exports = {
  /**
   * Using Phusion Passenger with Nginx on Plesk - That will gzip
   */
  performance: {
    gzip: false
  },
  /*
  ** Headers of the page
  */
  head: {
    titleTemplate: '%s - Starter Website',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' }
    ]
  },
  /*
  ** Global CSS
  */
  css: ['~/assets/css/main.sass'],
  /*
  ** Add axios globally
  */
  build: {
    vendor: ['axios', 'lodash'],
    /*
    ** Run ESLINT on save
    */
    extend (config, ctx) {
      if (ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }
    }
  },
  /**
   * Cache settings
   */
  cache: true,
  /**
   * Plugins
   */
  plugins: [
    { src: '~/plugins/quill.js', ssr: false },
    { src: '~/plugins/apiPage.js', ssr: true }
  ],
  /**
   * Modules
   */
  modules: [
    '@nuxtjs/component-cache',
    '@nuxtjs/font-awesome',
    [
      '@nuxtjs/pwa',
      {
        icon: {
          iconSrc: 'static/icons/bw-logo-1024x1024.png',
          sizes: [1024, 512, 144]
        },
        manifest: true,
        meta: false,
        workbox: true,
        optimize: {
          cssnano: {
            zindex: false
          }
        }
      }
    ],
    [
      '@nuxtjs/axios',
      {
        credentials: true,
        debug: false
      }
    ],
    ['@nuxtjs/google-tag-manager', { id: 'GTM-XXXXXXX' }],
  ],
  /**
   * Manifest for mobile app
   */
  manifest: {
    name: 'BW Starter Website',
    short_name: 'BWStarter',
    description: 'A starter de-coupled front-end/back-end website with common functionality including an admin login',
    lang: 'en',
    background_color: '#FFFFFF',
    theme_color: '#4770fb'
  },
  /**
   * Router
   */
  router: {
    middleware: ['initErrorHandler'],
    extendRoutes () {
      /*const PAGE = '~/pages/_page/index.vue'
      const SUB_PAGE = PAGE // '~/pages/_page/index/_subpage.vue'

      let children = [
        {
          path: ":2?",
          component: SUB_PAGE
        }
      ]

      return [
        {
          path: "/:1",
          component: PAGE,
          name: "0",
          children: children
        },
        {
          path: "/",
          component: PAGE,
          name: "index",
          children: children
        }
      ]*/
    }
  }
}
