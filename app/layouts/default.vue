<template>
  <div class="layout">
    <header>
      <bulma-navbar />
    </header>
    <nuxt />
  </div>
</template>

<script>
  import BulmaNavbar from '~/components/Bulma/Navbar/Navbar.vue'

  export default {
    components: {
      BulmaNavbar
    },
    head () {
      return {
        title: 'Loading...',
        meta: [
          { hid: 'theme', name: 'theme-color', content: '#4770fb' }
        ],
        htmlAttrs: { lang: 'en', class: 'has-navbar-fixed-top' }
      }
    }
  }
</script>

<style lang="sass">
  @import assets/css/_vars.sass

  body,
  html
    height: 100%

  a
    transition: color .25s, border .25s, background-color .25s

  .appear-active
    transition: opacity .4s ease
  .page-enter-active, .page-leave-active
    transition: all .2s ease
  .appear, .page-enter, .page-leave-active
    opacity: 0

  =selection
    color: $white
    background: $primary

  ::selection
    +selection

  ::-moz-selection
    +selection
</style>
