<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <input :id="id" ref="input" v-model="checked" v-bind="{ ...$attrs, class: null }" :type="type"  class="form-input" :class="{ error: error }" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `checkbox-input-${uuid()}`
      },
    },

    type: {
      type: String,
      default: 'checkbox',
    },

    error: String,
    label: String,
    modelValue: Boolean,
  },
  emits: ['update:modelValue'],
  data() {
    return {
      checked: this.modelValue,
    }
  },
  watch: {
    checked(checked) {
      this.$emit('update:modelValue', checked)
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
