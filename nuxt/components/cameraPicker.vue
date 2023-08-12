<template>
    <v-file-input v-model="file" :label="label" accept="image/*" @change="capturePhoto" @click.clear="cleared()"
        variant="solo" :error-messages="errors || ''"></v-file-input>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, errors, label } = defineProps(['modelValue', 'errors', 'label'])
const file = ref(null)
const capturePhoto = () => {
    if (file) {
        // Here, you can process the captured photo as per your requirements
    }
}

console.log('camera picker :', modelValue);

watch(file, (newItem) => {
    emit('update:modelValue', newItem[0])
});


const cleared = () => {
    file.value = null;
    emit('update:modelValue', "")
}
</script>