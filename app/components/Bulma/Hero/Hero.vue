<template>
  <div>
    <section class="hero is-dark is-bold">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            {{ data.title }}
          </h1>
          <h2 class="subtitle">
            {{ data.subtitle }}
          </h2>
        </div>
      </div>
      <div v-if="data.nav"
           class="hero-foot">
        <div class="container">
          <bulma-tabs _style="boxed"
                      :items="data.nav.items"
          />
        </div>
      </div>
    </section>
    <nuxt-child v-if="data.nav"
                :components="childComponents"
                :depth="depth+1"
    />
  </div>
</template>

<script>
  import NuxtChildMixin from '~/components/_mixins/nuxtChild.js'

  export default {
    mixins: [NuxtChildMixin],
    props: {
      data: {
        type: Object,
        required: true
      }
    },
    components: {
      BulmaTabs: () => import('~/components/Bulma/Tabs/Tabs.vue')
    }
  }
</script>
