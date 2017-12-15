<template>
  <nav class="tabs" :class="this.classModifiers">
    <ul>
      <li>
        <a href="/documentation/overview/start/">Overview</a>
      </li>
      <li>
        <a href="https://bulma.io/documentation/modifiers/syntax">Modifiers</a>
      </li>
      <li>
        <a href="https://bulma.io/documentation/columns/basics">Columns</a>
      </li>
      <li>
        <a href="https://bulma.io/documentation/layout/container/">Layout</a>
      </li>
      <li>
        <a href="https://bulma.io/documentation/form/general">Form</a>
      </li>
      <li>
        <a href="https://bulma.io/documentation/elements/box/">Elements</a>
      </li>
      <li class="is-active">
        <a href="https://bulma.io/documentation/components/breadcrumb/">Components</a>
      </li>
    </ul>
  </nav>
</template>

<script>
  export default {
    props: {
      align: {
        type: String,
        default: null,
        validator: function (value) {
          return ['centered', 'right'].indexOf(value) !== false
        }
      },
      size: {
        type: String,
        default: null,
        validator: function (value) {
          return ['small', 'medium', 'large'].indexOf(value) !== false
        }
      },
      _style: {
        type: String,
        default: null,
        validator: function (value) {
          return ['boxed', 'toggle', 'toggle-rounded'].indexOf(value) !== false
        }
      },
      fullwidth: {
        type: Boolean,
        default: false
      }
    },
    methods: {
      isser (values) {
        if (!values) {
          return false
        }
        if (typeof values === 'string') {
          values = [values]
        }
        let classes = []
        values.map((value) => {
          if (value) {
            classes.push('is-' + value)
          }
        })
        return classes
      },
      styleClassFixer (cls) {
        return cls === 'toggle-rounded' ? ['toggle', cls] : cls
      },
      fullwidthClassFixer (cls) {
        return cls ? 'fullwidth' : false
      }
    },
    computed: {
      classModifiers () {
        return [
          this.isser(this.align),
          this.isser(this.size),
          this.isser(this.styleClassFixer(this._style)),
          this.isser(this.fullwidthClassFixer(this.fullwidth))
        ]
      }
    },
    data () {
      return {}
    }
  }
</script>
