<template>
    <v-container class="bg-pic">
        <v-card color="transparent" :loading="loading">
            <v-row class="d-flex justify-center align-center">
                <v-col cols="12" sm="7" md="5">

                    <v-card-text>
                        <v-text-field label="نام کاربری" class="mt-4" v-model="username" />
                        <v-text-field label="رمز عبور" type="password" v-model="password" />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn block @click="login()">تایید</v-btn>
                    </v-card-actions>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>
<script setup>
import { toast } from 'vue3-toastify'
const { $event } = useNuxtApp()
const auth = useAuth()
const loading = ref(false)
if (auth.loggedIn) {
    useRouter().push({ path: '/' });
}
const username = ref()
const password = ref()
const errors = ref([])
// aA123456*
const login = async () => {
    loading.value = true

    await auth.loginWith("local", {
        body: {
            username: username.value,
            password: password.value,
        },
    })
        .then(({ data }) => {
            useRouter().push({ path: '/' });
            toast.success('شما با موقیت وارد شدید')
        })
        .catch(({ response }) => {
            if (response?._data?.message) {
                toast.error(response?._data?.message)
                errors.value.code = response._data.message
            }
        })
        .finally(() => (loading.value = false));
}



</script>
<style scoped>
.bg-pic {
    background-image: url("/images/login.jpg");
    background-size: cover;
    background-repeat: repeat-y;
    width: 100%;
    height: 100vh;
    background-size: cover;
}
</style>