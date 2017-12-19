<template>
  <section class="section">
    <div class="container">
      <div class="content" v-html="data.content"></div>
    </div>
  </section>
</template>

<script>
  export default {
    props: ['data']
  }
</script>
