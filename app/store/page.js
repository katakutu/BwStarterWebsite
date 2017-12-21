import Vue from 'vue'
import { compile } from '~/.nuxt/utils'

export const state = () => ({
  data: {}
})

export const mutations = {
  SET_PAGE: (state, { depth, data }) => {
    Vue.set(state.data, depth, data)
  }
}

export const actions = {
  async FETCH_DATA ({ commit }, { depth, route }) {
    const MATCHED = route.matched[depth]
    let path = compile(MATCHED.path)(route.params) || '/'

    console.log('FETCH_DATA', path)
    let data = await this.$getPage({ path: path })

    commit('SET_PAGE', { depth, data })
  }
}
