<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600" :loading="loading">
            <v-card-title class=" text-center">
                افزودن غرفه
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="نام" v-model="object.name" :errors="errors?.name" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setStall()">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/managment/stall" variant="outlined" color="#6E5131">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});

const loading = ref(false)
const errors = ref([])
import { toast } from 'vue3-toastify';
const object = ref({
    name: "",
})

const setStall = async () => {
    loading.value = true

    const { data, error } = await api('api/stalls', {
        method: 'POST',
        body: { ...object.value }
    });
    if (data.value) {
        toast.success(' با موفقیت ثبت شد')
        useRouter().push('/managment/stall')
    } else if (error?.value?.data?.errors) {
        errors.value = error?.value?.data?.errors
    }
    loading.value = false
}
</script>