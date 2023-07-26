<template>
    <v-file-input v-model="file" label="تصویر" accept="image/*" @change="capturePhoto" @click.clear="cleared()"
        :error-messages="errors || ''"></v-file-input>
</template>
<script setup>
let emit = defineEmits(['imageUpdate:modelValue']);
const { modelValue, errors } = defineProps(['modelValue', 'errors'])

const file = ref(null)
const capturePhoto = () => {
    if (file) {
        // Here, you can process the captured photo as per your requirements

    }

}

watch(file, (newItem) => {
    emit('imageUpdate:modelValue', newItem[0])
});


const cleared = () => {
    file.value = null;
    emit('imageUpdate:modelValue', "")
}
</script>