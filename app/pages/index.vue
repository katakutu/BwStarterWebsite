<template>
  <div class="page">
    <component v-for="(component, index) in api.components"
               :is="component.type"
               :key="component.id"
               :data="component"
    />
    <!--
    <bulma-hero />
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
      Hero: () => import('~/components/Hero/Hero.vue'),
      Menu: () => import('~/components/Menu/Menu.vue'),
      Tabs: () => import('~/components/Tabs/Tabs.vue'),
      TextBlock: () => import('~/components/TextBlock.vue')
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
