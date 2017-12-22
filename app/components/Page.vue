<template>
  <bulma-components v-if="pageData" :pageData="pageData" />
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

    head () {
      return {
        title: this.title,
        meta: [
          { name: 'description', content: this.metaDescription }
        ]
      }
    },

    async beforeMount () {
      if (this.$root._isMounted) {
        console.log('before mount, root is mounted')
      } else {
        console.log('before mount, root is not mounted')
      }
    },

    computed: {
      /*
      pageData () {
        return this.$store.getters['page/getPageByDepth'](this.depth)
      },
      */
      title () {
        return this.pageData ? this.pageData.title : null
      },
      metaDescription () {
        return this.pageData ? this.pageData.metaDescription : null
      }
    }
  }
</script>
