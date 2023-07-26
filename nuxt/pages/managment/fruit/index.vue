<template>
    <v-container>
        <v-card>
            <v-card-title class=" text-center">
                مدیریت محصولات
            </v-card-title>
            <v-divider />
            <v-card-actions>
                <v-btn block to="/managment/fruit/create">افزودن</v-btn>
            </v-card-actions>
            <v-divider />
            <v-card-subtitle class="my-2">
                <v-text-field label="جستجو" v-model="filters.search" hide-details @keyup.enter="getFruit"></v-text-field>
            </v-card-subtitle>
            <v-divider />
            <v-card-text>
                <v-card class="mt-1" color="white" v-for="(item, i) in fruit?.data">
                    <v-card-text class="d-flex align-center pa-1">
                        <v-avatar>
                            <v-img :src="imageUrl(item.image) || `/images/icon.jpg`"
                                @click="showImageDialog(imageUrl(item.image))" />
                        </v-avatar>
                        {{ item.name }}
                        <v-spacer />
                        <v-btn icon="mdi-delete" size="x-small" color="red" @click="deleteFruit(item.id)"></v-btn>
                        <v-btn icon="mdi-pencil" size="x-small" color="blue" :to="`/fruit/${item.id}`" class="mr-1"></v-btn>
                    </v-card-text>
                </v-card>
            </v-card-text>
            <v-divider />
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="fruit.last_page"
                    @update:modelValue="getFruit()"></v-pagination>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/managment" variant="outlined" color="#6E5131">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});
const { $event } = useNuxtApp()
import { toast } from 'vue3-toastify';

const fruit = ref([])
const filters = ref({
    search: "",
    page: 1,
})

const getFruit = async () => {
    const { data, error } = await api('api/fruit', {
        method: "GET",
        key: "get_fruit",
        query: { ...filters.value }
    })
    if (data?.value) {
        fruit.value = data.value
    }
}

getFruit()

const showImageDialog = (image) => {
    $event('image-dialog', image)
}


const deleteFruit = async (id) => {
    const { data, error } = await api(`api/fruit/${id}`, {
        method: "DELETE",
        key: "get_fruit",
    })
    if (data?.value) {
        toast.success(' با موفقیت حذف شد')
        getFruit()
    }
}

</script>