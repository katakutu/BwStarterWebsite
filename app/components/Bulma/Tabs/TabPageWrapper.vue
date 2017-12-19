<template>
  <div v-if="wrap">
    <div class="navbar has-shadow is-light">
      <div class="container">
        <div class="column is-paddingless">
          <slot></slot>
        </div>
      </div>
    </div>
    <nuxt-child :components="childComponents"
                :depth="depth+1"
    />
  </div>
  <div v-else>
    <slot></slot>
  </div>
</template>

<script>
  import NuxtChildMixin from '~/components/_mixins/nuxtChild.js'

  export default {
    mixins: [NuxtChildMixin],
    props: {
      wrap: {
        type: Boolean,
        default: false
      }
    }
  }
</script>