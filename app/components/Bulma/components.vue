<template>
  <div class="bulma-components">
    <component v-for="component in components"
               :is="name(component)"
               :key="component.id"
               :data="component"
               :items="component.items"
               :depth="depth"
               :wrap="true"
    />
  </div>
</template>

<script>
  export default {
    props: {
      depth: {
        type: Number,
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
      components () {
        let data = this.$store.state.page.data
        let curDepth = this.depth
        while (curDepth > 0) {
          data = data.child
          curDepth--
        }
        return data.components
      }
    }
  }
</script>
