<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600" :loading="loading">
            <v-card-title class="peyda text-center">
                ویرایش محصولات
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="نام" v-model="object.name" :errors="errors?.name" />
                <camera-picker v-model="object.image" :errors="errors?.image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setFruits()">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/fruit" variant="outlined" color="#6E5131">بازگشت</v-btn>
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
    image: "",
    name: "",
})

const fruitId = useRoute().params.id

const getFruit = async () => {
    const { data, error } = await api(`api/fruit/${fruitId}`, {
        method: "GET",
        key: "get_fruit",
    })
    if (data?.value) {
        object.value.name = data.value.name
        object.value.image = data.value.image
    }
}

getFruit()

const setFruits = async () => {
    loading.value = true
    const formData = new FormData();

    formData.append('name', object.value.name);

    if (object.value.image) {
        formData.append("image", object.value.image)
    }


    const { data, error } = await api(`api/fruit/${fruitId}`, {
        method: 'PUT',
        key: "fruit_put",
        body: formData
    });
    if (data.value) {
        toast.success(' با موفقیت ویرایش شد')
        useRouter().push('/managment/fruit')
    } else if (error?.value?.data?.errors) {
        errors.value = error?.value?.data?.errors
    }


    loading.value = false
}
</script>