<template>
  <div class="layout">
    <header>
      <navbar />
    </header>

    <nuxt :nuxtChildKey="nuxtChildKey" />
  </div>
</template>

<script>
  import { compile } from '~/.nuxt/utils'
  import Navbar from '~/components/Bulma/Navbar/Navbar.vue'

  export default {
    components: {
      Navbar
    },
    computed: {
      nuxtChildKey () {
        if (this.$route.matched.length > 1) {
          return compile(this.$route.matched[0].path)(this.$route.params)
        }
        return this.$route.fullPath.split('#')[0]
      }
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
