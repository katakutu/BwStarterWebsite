export default async function ({ store, route }) {
  await store.dispatch('page/FETCH_DEPTH_DATA', { route })
}
