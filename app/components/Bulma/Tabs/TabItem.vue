<template>
  <nuxt-link tag="li"
             :to="toRoute"
             :active-class="activeClass"
             :exact="toRoute === '/'"
  >
    <a>{{ item.label }}</a>
  </nuxt-link>
</template>

<script>
  export default {
    props: ['item'],
    data: () => ({
      activeClass: 'is-active'
    }),
    computed: {
      toRoute () {
        return this.item.route.route + (this.item.fragment ? ('#' + this.item.fragment) : '')
      }
    }
  }
</script>
