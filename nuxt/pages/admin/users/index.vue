<template>
    <v-container class="d-flex justify-center">
        <v-card width="600">
            <v-card-title class=" text-center">
                مدیریت کاربران
            </v-card-title>
            <v-divider />
            <v-card-actions>
                <v-btn block to="/admin/users/create" class="text-white">افزودن</v-btn>
            </v-card-actions>
            <v-divider />
            <v-card-text>
                <v-table>
                    <thead>
                        <tr>
                            <th class="text-center text-primary">ردیف</th>
                            <th class="text-center text-primary">نام</th>
                            <th class="text-center text-primary">نام کاربری</th>
                            <th class="text-center text-primary">نقش</th>
                            <th class="text-center text-primary">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users?.data" :key="user.id">
                            <td class="text-center text-primary">{{ user.id }}</td>
                            <td class="text-center">{{ user.name }}</td>
                            <td class="text-center">{{ user.username }}</td>
                            <td class="text-center">{{ getPermission(user.permission) }}</td>
                            <td class="text-center">
                                <v-btn icon="mdi-delete" size="x-small" color="red" @click="deleteUser(user.id)"></v-btn>
                                <v-btn icon="mdi-pencil" size="x-small" color="blue" :to="`/admin/users/${user.id}`"
                                    class="mr-1"></v-btn>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-text>
            <v-divider />
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="users.last_page"
                    @update:modelValue="getFruit()"></v-pagination>
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
$event('tilte-chaneg', 'کاربران')
import { toast } from 'vue3-toastify';

const users = ref([])
const filters = ref({
    search: "",
    page: 1,
})

const getUsers = async () => {
    const { data, error } = await api('api/users', {
        method: "GET",
        key: "get_users",
        query: { ...filters.value }
    })
    if (data?.value) {
        users.value = data.value
    }
}

getUsers()

const deleteUser = async (id) => {
    const { data, error } = await api(`api/users/${id}`, {
        method: "DELETE",
        key: "delete_users",
    })
    if (data?.value) {
        toast.success(' با موفقیت حذف شد')
        getUsers()
    }
}
</script>