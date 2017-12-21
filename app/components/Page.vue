<template>
  <div class="index">
    <bulma-components v-if="pageData" :pageData="pageData" />
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

    head () {
      return {
        title: this.title,
        meta: [
          { name: 'description', content: this.metaDescription }
        ]
      }
    },

    computed: {
      pageData () {
        return this.$store.getters['page/getPageByDepth'](this.depth)
      },
      title () {
        return this.pageData ? this.pageData.title : null
      },
      metaDescription () {
        return this.pageData ? this.pageData.metaDescription : null
      }
    }
  }
</script>
