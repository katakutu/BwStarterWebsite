import Vue from 'vue'

const ApiPage = {
  install () {
    if (Vue.__apipage_installed__) {
      return
    }
    Vue.__apipage_installed__ = true

    if (!Vue.prototype.hasOwnProperty('$getPage')) {
      Object.defineProperty(Vue.prototype, '$getPage', {
        get () {
          return this.$root.$options.$getPage
        }
      })
    }
  }
}

Vue.use(ApiPage)

async function fetchPage ({ app, error, store }, { route }) {
  const PAGE_URL = '/routes/' + route.path
  try {
    let { data } = await app.$axios.get(PAGE_URL)
    store.commit('page/setData', data)
    return store.state.page.data
  } catch (err) {
    error({ statusCode: err.statusCode, message: 'Error (' + PAGE_URL + '): ' + err.message })
  }
}

export default (ctx) => {
  const { app } = ctx
  // Make accessible using *.$getPage
  app.$getPage = (payload) => {
    return fetchPage(ctx, payload)
  }
}
