<template>
    <label v-if="label" :for="id" :class="labelClass">{{ label }}</label>
    <input
        :type="inputType"
        :id="id"
        ref="pickerElement"
        :value="modelValue"
        v-bind:class="[inputClass, { 'is-invalid': error }]"
        :disabled="disabled"
        :placeholder="[placeholder ? placeholder : label]"
        readonly
    />
    <div v-if="error" class="invalid-feedback">
        {{ error }}
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import dateHelper from "../../utils/dateHelper";
const emit=defineEmits([
    'update:modelValue', 'validate'
])
const props=defineProps({
    id: {
        type: String,
    },
    inputType: {
        type: String,
        default: "text",
    },
    inputClass: {
        type: String,
        default: "form-control",
    },
    labelClass:{
        type:String,
        default:'form-label fw-bolder'
    },
    label: {
        type: String,
    },
    placeholder: {
        type: String
    },
    disabled: {
        type: Boolean,
        default: false
    },
    error: {
        type: String,
        default: ''
    },

    modelValue: {
        type: String,
        required: true,
    },
    todayDate: {
        type: Boolean,
        default: false,
    },
    disableBefore: {
        default: null
    }
})

const pickerElement=ref('');

onMounted(() => {
    if (props.todayDate) {
        emit("update:modelValue", dateHelper.currentBsDate());
        emit("validate");
    }

    pickerElement.value.nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        disableBefore: props.disableBefore,
        onChange: function (e) {
            emit("update:modelValue", e.bs);
            emit("validate");
        },
    });
});
</script>
