<template>
  <section class="hero is-dark is-bold">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">
          Title
        </h1>
        <h2 class="subtitle">
          Subtitle
        </h2>
      </div>
    </div>
    <div class="hero-foot">
      <div class="container">
        <bulma-tabs _style="boxed" />
      </div>
    </div>
  </section>
</template>

<script>
  import BulmaTabs from '~/components/Bulma/Tabs/Tabs.vue'

  export default {
    components: {
      BulmaTabs
    }
  }
</script>
