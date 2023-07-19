<template>
    <v-row>
        <v-col cols="2" class="pl-0">
            <v-text-field ref="focus1" type="number" placeholder="11" v-model="value1" />
        </v-col>
        <v-col cols="4" class="pl-0">
            <v-text-field ref="focus2" type="number" placeholder="111" v-model="value2" />
        </v-col>
        <v-col cols="2" class="pl-1">
            <v-text-field ref="focus3" placeholder="ق" v-model="value3" />
        </v-col>
        <v-col cols="4" class="pr-1">
            <v-text-field ref="focus4" type="number" placeholder="11" v-model="value4" autofocus />
        </v-col>
    </v-row>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
import { useFocus } from '@vueuse/core'

const value1 = ref("")
const value2 = ref("")
const value3 = ref("")
const value4 = ref("")
const object = ref("")
const focus1 = ref()
const focus2 = ref()
const focus3 = ref()
const focus4 = ref()

const { modelValue, errors } = defineProps(['modelValue', 'errors'])


watch(value1, (newvalue) => {
    object.value = value4.value + value3.value + value2.value + newvalue
    emit('update:modelValue', object.value)
})
watch(value2, (newvalue) => {
    object.value = value4.value + value3.value + newvalue + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 3) {
        focus1.value.focus()
    }
})
watch(value3, (newvalue) => {
    object.value = value4.value + newvalue + value2.value + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 1) {
        focus2.value.focus()
    }
})

watch(value4, (newvalue) => {
    object.value = newvalue + value3.value + value2.value + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 2) {
        focus3.value.focus()
    }
})




</script>