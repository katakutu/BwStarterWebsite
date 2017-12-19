<template>
  <div class="page">
    <component v-for="(component, index) in api.components"
               :is="component.type"
               :key="component.id"
               :data="component"></component>
    <!--
    <div class="navbar has-shadow is-light">
      <div class="container">
        <div class="column is-paddingless">
          <bulma-tabs />
        </div>
      </div>
    </div>
    <section class="section">
      <div class="container">
        <div class="columns">
          <div class="column is-narrow">
            <bulma-menu />
          </div>
          <div class="column">
            <text-block />
          </div>
        </div>
      </div>
    </section>
    -->
  </div>
</template>

<script>
  export default {
    components: {
      Hero: () => import('~/components/Bulma/Hero/Hero.vue'),
      Content: () => import('~/components/Bulma/Content/Content.vue'),
      Menu: () => import('~/components/Bulma/Menu/Menu.vue'),
      Tabs: () => import('~/components/Bulma/Tabs/Tabs.vue')
    },
    head () {
      return {
        title: this.api.title,
        meta: [
          { name: 'description', content: this.api.metaDescription }
        ]
      }
    },
    async asyncData ({ app, route }) {
      return {
        api: await app.$getPage({ route })
      }
    }
  }
</script>
