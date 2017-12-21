<template>
  <div v-if="wrap">
    <div class="navbar has-shadow is-light">
      <div class="container">
        <div class="column is-paddingless">
          <slot></slot>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
    <slot></slot>
  </div>
</template>

<script>
  export default {
    props: {
      wrap: {
        type: Boolean,
        default: false
      }
    }
  }
</script>