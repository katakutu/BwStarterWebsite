<template>
  <div class="sub-page">
    <bulma-components :depth="depth" />
  </div>
</template>

<script>
  import BulmaComponents from '~/components/Bulma/components.vue'

  export default {
    components: {
      BulmaComponents
    },
    props: {
      depth: {
        type: Number,
        required: true
      }
    },
    async asyncData ({ app, route, isClient }) {
      if (isClient) {
        await app.$getPage({ route })
      }
      return {}
    }
  }
</script>
