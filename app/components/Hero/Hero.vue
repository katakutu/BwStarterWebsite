<template>
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
    <!--<div class="hero-foot">
      <div class="container">
        <bulma-tabs _style="boxed" />
      </div>
    </div>-->
  </section>
</template>

<script>
  export default {
    props: ['data'],
    components: {
      BulmaTabs: () => import('~/components/Tabs/Tabs.vue')
    }
  }
</script>
