<template>
  <div class="page">
    <bulma-components :components="api.components" />
  </div>
</template>

<script>
  import BulmaComponents from '~/components/Bulma/components.vue'

  export default {
    components: {
      BulmaComponents
    },
    head () {
      return {
        title: this.api.title,
        meta: [
          { name: 'description', content: this.api.metaDescription }
        ]
      }
    },
    async asyncData ({ app, route }) {
      return {
        api: await app.$getPage({ route })
      }
    }
  }
</script>
