<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600" :loading="loading">
            <v-card-title class=" text-center">
                افزودن تالار
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="نام" v-model="object.name" :errors="errors?.name" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setHall()" class="text-white">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/admin/hall" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    layout: "admin",
    middleware: "auth"
});
const { $event } = useNuxtApp()
$event('tilte-chaneg', 'افزودن تالار')
const loading = ref(false)
const errors = ref([])
import { toast } from 'vue3-toastify';
const object = ref({
    name: "",
})

const setHall = async () => {
    loading.value = true

    const { data, error } = await api('api/halls', {
        method: 'POST',
        body: { ...object.value }
    });
    if (data.value) {
        toast.success(' با موفقیت ثبت شد')
        useRouter().push('/admin/hall')
    } else if (error?.value?.data?.errors) {
        errors.value = error?.value?.data?.errors
    }
    loading.value = false
}
</script>