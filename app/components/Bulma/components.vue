<template>
  <div class="bulma-components">
    <component v-for="component in components"
               :is="name(component)"
               :key="component.id"
               :data="component"></component>
  </div>
</template>

<script>
  export default {
    props: ['components'],
    components: {
      BulmaHero: () => import('~/components/Bulma/Hero/Hero.vue'),
      BulmaContent: () => import('~/components/Bulma/Content/Content.vue'),
      BulmaMenu: () => import('~/components/Bulma/Menu/Menu.vue'),
      BulmaTabs: () => import('~/components/Bulma/Tabs/Tabs.vue')
    },
    methods: {
      name (component) {
        return 'bulma-' + component.type
      }
    }
  }
</script>
