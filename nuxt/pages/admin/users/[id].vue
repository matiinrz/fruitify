<template>
    <v-container class="fill-height justify-center">
        <v-card width="600" :loading="loading">
            <v-card-title class="text-center">
                ویرایش کاربر
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="نام" v-model="object.name" :error-message="errors?.name || ''" />
                <v-text-field label="نام کاربری" v-model="object.username" :error-message="errors?.username || ''" />
                <v-select label="نقش" :items="[{ name: 'ادمین', value: 'superuser' }, { name: 'اپراتور', value: 'user' }]"
                    item-title="name" item-value="value" v-model="object.permission"
                    :error-message="errors?.permission || ''" />

            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setUser()" class="text-white">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/admin/users" variant="outlined">بازگشت</v-btn>
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
$event('tilte-chaneg', 'ویرایش کاربر')
import { toast } from 'vue3-toastify';

const loading = ref(false)
const errors = ref([])
const object = ref({
    name: "",
    username: "",
    permission: "",
})

const userId = useRoute().params.id

const getUser = async () => {
    const { data, error } = await api(`api/users/${userId}`, {
        method: "GET",
        key: "get_user"
    })
    if (data?.value) {
        object.value.name = data.value.name
        object.value.username = data.value.username
        object.value.permission = data.value.permission
    }
}

getUser()

const setUser = async () => {
    loading.value = true
    const { data, error } = await api(`api/users/${userId}`, {
        method: 'PUT',
        body: { ...object.value }
    })
    if (data?.value) {
        toast.success(' با موفقیت ویرایش شد')
        useRouter().push('/admin/users')
    } else if (error?.value?.data?.errors) {
        console.log('error :', error?.value);
        errors.value = error?.value?.data?.errors
    }
    loading.value = false

}
</script>