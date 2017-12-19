<template>
  <div class="sub-page">
    <bulma-components :components="components" />
  </div>
</template>

<script>
  import BulmaComponents from '~/components/Bulma/components.vue'

  export default {
    props: {
      components: {
        type: Array,
        required: true
      }
    },
    components: {
      BulmaComponents
    }
  }
</script>
