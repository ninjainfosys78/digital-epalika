<template>
  <label v-if="label" :for="id" :class="labelClass">{{ label }}</label>
  <select
      :id="id"
      v-bind:class="[selectClass,{'is-invalid':error}]"
      :disabled="disabled"
      :value="modelValue"
      @input="updateInputValue"
  >
    <option value=""> {{ label }} छान्नुहोस्</option>
    <option v-for="(option,index) in options" :value="option[valueProp]??option[nameProp]??option" :key="index">
      {{ option[nameProp] ?? option }}
    </option>
  </select>
  <div v-if="error" class="invalid-feedback">
    {{ error }}
  </div>
</template>

<script setup>

const emit = defineEmits(['update:modelValue', 'validate']);

const props=defineProps({
  id: {
    type: String
  },
  selectClass: {
    type: String,
    default: 'form-select'
  },
    labelClass:{
      type:String,
        default:'form-label fw-bolder'
    },
  label: {
    type: String
  },
  error: {
    type: String,
    default: ''
  },

  modelValue: {
    type: [String, Number],
    required: true
  },
  options: {
    required: true,
    type: Array
  },
  valueProp: {
    type: String,
    default: 'id'
  },
  nameProp: {
    type: String,
    default: 'name'
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const updateInputValue = (event) => {
  emit('update:modelValue', event.target.value)
  emit('validate')
}

</script>
