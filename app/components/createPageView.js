import Page from './Page.vue'

export default function createPageView (depth) {
  return {
    name: `page-${depth}`,

    async asyncData ({ store, route }) {
      return { pageData: await store.dispatch('page/FETCH_DEPTH_DATA', { depth, route }) }
    },

    render (h) {
      return h(Page, { props: { depth, pageData: this.pageData } })
    }
  }
}
