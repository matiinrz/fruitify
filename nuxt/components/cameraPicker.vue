<template>
    <v-file-input v-model="file" label="تصویر" accept="image/*" @change="capturePhoto" @click.clear="cleared()"
        :error-messages="errors || ''"></v-file-input>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, errors } = defineProps(['modelValue', 'errors'])

const file = ref(null)
const capturePhoto = () => {
    if (file) {
        // Here, you can process the captured photo as per your requirements
        console.log('Captured photo:', file);

    }

}

watch(file, (newItem) => {
    emit('update:modelValue', newItem[0])
    console.log('new item', newItem[0])
});


const cleared = () => {
    file.value = null;
    emit('update:modelValue', "")
}
</script>