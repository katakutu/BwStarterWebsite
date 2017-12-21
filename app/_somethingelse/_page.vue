<template>
  <div class="sub-page">
    <bulma-components :depth="depth"
                      :components="components"
    />
  </div>
</template>

<script>
  import BulmaComponents from '~/components/Bulma/components.vue'

  export default {
    components: {
      BulmaComponents
    },
    props: {
      components: {
        type: Array
      },
      depth: {
        type: Number,
        required: true
      }
    },
    beforeCreate () {
      this.$emit('sub-page')
    }
  }
</script>