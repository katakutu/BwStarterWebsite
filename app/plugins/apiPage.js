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

async function fetchPage ({ app, error }, { path }) {
  const PAGE_URL = '/routes/' + path
  try {
    let { data } = await app.$axios.get(PAGE_URL)
    return data
  } catch (err) {
    error({ statusCode: err.statusCode, message: 'Error (' + PAGE_URL + '): ' + err.message })
  }
}

export default (ctx, inject) => {
  ctx.$getPage = (payload) => {
    return fetchPage(ctx, payload)
  }
  inject('getPage', ctx.$getPage)
}
