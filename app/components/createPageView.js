import Page from './Page.vue'

export default function createPageView (depth) {
  return {
    name: `page-${depth}`,

    async fetch ({ store, route, params }) {
      let paramCount = Math.max(1, Object
        .keys(params)
        .map((v) => {
          return params[v]
        })
        .filter((v) => { return v })
        .length)

      let data
      if (depth < paramCount) {
        data = await store.dispatch('page/FETCH_DATA', { depth, route })
      }
      return data
    },

    render (h) {
      return h(Page, { props: { depth } })
    }
  }
}
