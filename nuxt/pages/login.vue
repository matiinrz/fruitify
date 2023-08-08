<template>
    <v-container class=" fill-height justify-center ">
        <v-card color="white" elevation="0" class="rounded-lg shadow-card" width="600" :loading="loading">


            <v-card-title class="d-flex justify-center">
                <!-- <v-img src="/images/Login.png" height="300" width="300" /> -->
                <v-img width="600" src="/Comp-2.gif" />

            </v-card-title>

            <!-- <v-card-title class=" text-center">
                سازمان ميادين ميوه و تره بار <br />و ساماندهي مشاغل شهري
                <br /> شهرداري اصفهان
            </v-card-title> -->
            <v-card-text>
                <v-text-field variant="outlined" label="نام کاربری" class="mt-4" v-model="username" />
                <v-text-field variant="outlined" label="رمز عبور" type="Password" v-model="password" />
            </v-card-text>
            <v-card-actions>
                <v-btn block @click="login()" size="large">تایید</v-btn>
            </v-card-actions>

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
.bg-color {
    background-color: white !important;
}

.shadow-card {
    box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset !important;
}

/* .bg-pic {
    background-image: url("/images/login.jpg");
    background-size: cover;
    background-repeat: repeat-y;
    width: 100%;
    height: 100vh;
    background-size: cover;
} */
</style>