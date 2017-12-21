<template>
  <div class="index">
    <bulma-components :pageData="pageData" />
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
        return this.$store.state.page.data[this.depth] || {}
      },
      title () {
        return this.pageData.title
      },
      metaDescription () {
        return this.pageData.metaDescription
      }
    }
  }
</script>
