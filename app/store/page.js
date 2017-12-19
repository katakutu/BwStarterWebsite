export const state = () => ({
  data: null
})

export const mutations = {
  setData (state, data) {
    // Reverse parent/child - fetches as child first with single parents
    // VueJs has top down architecture so we will want our root data first
    let newData = Object.assign({}, data)
    while (newData.parent) {
      newData.parent.child = newData
      newData = newData.parent
      newData.child.parent = newData.child.parent['@id']
    }
    state.data = newData
  }
}
