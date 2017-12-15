<template>
  <nuxt-link class="navbar-item"
             :to="toRoute"
             v-if="!item.child"
             :active-class="activeClass"
             :exact="toRoute === '/'"
  >
    {{ item.label }}
  </nuxt-link>
  <div class="navbar-item has-dropdown is-hoverable" v-else>
    <nuxt-link class="navbar-link"
               :to="toRoute"
               :active-class="activeClass"
               :exact="toRoute === '/'"
    >
      {{ item.label }}
    </nuxt-link>
    <div class="navbar-dropdown">
      <bulma-navbar-item v-for="(childItem, childIndex) in childItems" :key="childIndex" :item="childItem" />
    </div>
  </div>
</template>

<script>
  export default {
    name: 'BulmaNavbarItem',
    props: ['item'],
    data: () => ({
      activeClass: 'is-active'
    }),
    computed: {
      childItems () {
        return !this.item.child ? null : this.item.child.items
      },
      toRoute () {
        return this.item.page.route + (this.item.fragment ? ('#' + this.item.fragment) : '')
      }
    }
  }
</script>
