<template>
  <div class="page">
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

  </div>
</template>

<script>
  import BulmaHero from '~/components/Bulma/Hero/Hero.vue'
  import BulmaMenu from '~/components/Bulma/Menu/Menu.vue'
  import BulmaTabs from '~/components/Bulma/Tabs/Tabs.vue'
  import TextBlock from '~/components/TextBlock.vue'

  export default {
    components: {
      BulmaHero,
      BulmaMenu,
      BulmaTabs,
      TextBlock
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
