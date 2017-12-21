<template>
  <div class="bulma-components">
    <component v-for="component in _components"
               :is="name(component)"
               :key="component.id"
               :data="component"
               :wrap="true"
    ></component>
  </div>
</template>

<script>
  export default {
    props: {
      pageData: {
        type: Object,
        required: true
      }
    },
    components: {
      BulmaHero: () => import('~/components/Bulma/Hero/Hero.vue'),
      BulmaContent: () => import('~/components/Bulma/Content/Content.vue'),
      BulmaMenu: () => import('~/components/Bulma/Menu/Menu.vue'),
      BulmaTabs: () => import('~/components/Bulma/Tabs/Tabs.vue')
    },
    methods: {
      name (component) {
        return 'bulma-' + (component.type === 'Nav' ? 'tabs' : component.type)
      }
    },
    computed: {
      _components () {
        return this.pageData.components
      }
    }
  }
</script>
