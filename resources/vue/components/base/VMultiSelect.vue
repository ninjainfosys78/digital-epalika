<template>
    <label v-if="label" :for="id" :class="labelClass">{{ label }}</label>
    <Multiselect
        :id="id"
        :label="nameProp"
        :value="modelValue"
        :customLabel="label"
        @input="updateInputValue"
        :disabled="disabled"
        :loading="loading"
        :valueProp="valueProp"
        :searchable="true"
        :track-by="nameProp"
        :options="options"
        :placeholder="label+ ' छान्नुहोस्'"
    />
    <div v-if="error" class="text-danger">
        {{ error }}
    </div>
</template>

<script setup>
import '@vueform/multiselect/themes/default.css';
import Multiselect from "@vueform/multiselect";

const emit = defineEmits(['update:modelValue', 'validate']);

const props=defineProps({
    id: {
        type: String
    },
    selectClass: {
        type: String,
        default: 'form-select'
    },
    label: {
        type: String
    },
    labelClass:{
        type:String,
        default:'form-label fw-bolder'
    },
    error: {
        type: String,
        default: ''
    },

    modelValue: {
        required: true
    },
    options: {
        required: true,
        type: Array
    },
    subOptions: {
        type: String,
    },
    valueProp: {
        type: String,
        default: 'id'
    },
    nameProp: {
        type: String,
    },
    subNameProp: {
        type: String
    },
    loading: {
        type: Boolean,
        default: false
    },
    disabled: {
        type: Boolean,
        default: false
    },
})

const updateInputValue = (value) => {
    emit('update:modelValue', value)
    emit('validate')
}
</script>
