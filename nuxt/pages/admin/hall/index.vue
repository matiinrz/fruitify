<template>
    <v-container class="d-flex justify-center">
        <v-card width="600">
            <v-card-title class=" text-center">
                مدیریت تالارها
            </v-card-title>
            <v-divider />
            <v-card-actions>
                <v-btn block to="/admin/hall/create" class="text-white">افزودن</v-btn>
            </v-card-actions>
            <v-divider />
            <v-card-subtitle class="my-2">
                <v-text-field label="جستجو" v-model="filters.search" hide-details @keyup.enter="getHall"></v-text-field>
            </v-card-subtitle>
            <v-divider />
            <v-card-text>
                <v-card class="mt-1" color="white" v-for="(item, i) in halls?.data" :key="i">
                    <v-card-text class="d-flex align-center pa-1">
                        {{ item.name }}
                        <v-spacer />
                        <v-btn icon="mdi-delete" size="x-small" color="red" @click="deleteHall(item.id)"></v-btn>
                        <v-btn icon="mdi-pencil" size="x-small" color="blue" :to="`/admin/hall/${item.id}`"
                            class="mr-1"></v-btn>
                    </v-card-text>
                </v-card>
            </v-card-text>
            <v-divider />
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="halls?.last_page" :total-visible="7"
                    @update:modelValue="getHalls()"></v-pagination>
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
$event('tilte-chaneg', 'مدیریت تالار')
import { toast } from 'vue3-toastify';

const halls = ref([])
const filters = ref({
    search: "",
    page: 1,
})

const getHalls = async () => {
    const { data, error } = await api('api/halls', {
        method: "GET",
        key: "get_halls",
        query: { ...filters.value }
    })
    if (data?.value) {
        halls.value = data.value
    }
}

getHalls()

const deleteHall = async (id) => {
    const { data, error } = await api(`api/halls/${id}`, {
        method: "DELETE",
        key: "delete_hall",
    })
    if (data?.value) {
        toast.success(' با موفقیت حذف شد')
        getHalls()
    }
}
</script>