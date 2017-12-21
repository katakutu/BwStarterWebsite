<template>
  <div class="layout">
    <header>
      <bulma-navbar />
    </header>
    <nuxt nuxt-child-key="none" />
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

<style src="~/assets/css/layouts/default.sass" lang="sass" />
