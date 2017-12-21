import Page from './Page.vue'

export default function createPageView (depth) {
  return {
    name: `page-${depth}`,

    render (h) {
      return h(Page, { props: { depth } })
    }
  }
}
