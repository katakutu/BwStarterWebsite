<template>
  <div v-show="pageData">
    <bulma-components v-if="pageData"
                      :pageData="pageData"
                      :depth="depth"
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
      depth: {
        type: Number,
        required: true
      },
      pageData: {
        type: Object
      }
    },

    async beforeMount () {
      if (this.$root._isMounted) {
        console.log('before mount, root is mounted')
      } else {
        console.log('before mount, root is not mounted')
      }
    }
  }
</script>
