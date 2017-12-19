export default {
  props: {
    depth: {
      type: Number,
      required: true
    }
  },
  computed: {
    child () {
      return this.$store.state.page.data.child
    },
    childComponents () {
      return this.child ? this.child.components : []
    }
  }
}
