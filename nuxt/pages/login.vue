<template>
    <v-container :class="mobile ? 'login-bg' : ''">
        <v-row class="d-flex justify-center">
            <v-col cols="9" md="8" sm="6" lg="4" xl="3">

                <v-img src="/images/logo.png" />

            </v-col>
        </v-row>
        <v-row class="d-flex justify-center">
            <v-col cols="12" md="8" sm="6" lg="4" xl="3">
                <v-card color="light" elevation="2" class="rounded-lg" :loading="loading">

                    <v-card-text class="customClass">
                        <v-text-field light variant="solo-inverted" label="نام کاربری" class="mt-4" v-model="username" />
                        <v-text-field light variant="solo-inverted" label="رمز عبور" type="Password" v-model="password" />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn block @click="login()" class="text-white" size="large">تایید</v-btn>
                    </v-card-actions>
                    <v-card-subtitle class="d-flex justify-center align-end ma-6  ">
                        فراهم شده توسط شرکت فنی مهندسی <a href="https://pooyapendar.ir/" target="_blank">پویا پندار
                            پیشرو</a>
                    </v-card-subtitle>
                </v-card>

            </v-col>
        </v-row>


    </v-container>
</template>
<script setup>
import { toast } from 'vue3-toastify'
import { useDisplay } from 'vuetify'
const { mobile } = useDisplay()
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
.v-input:-webkit-autofill,
.v-input:-webkit-autofill:hover,
.v-input:-webkit-autofill:focus,
.v-textarea:-webkit-autofill,
.v-textarea:-webkit-autofill:hover,
.v-textarea:-webkit-autofill:focus,
.v-select:-webkit-autofill,
.v-select:-webkit-autofill:hover,
.v-select:-webkit-autofill:focus {
    border: 1px solid green;
    -webkit-text-fill-color: green;
    -webkit-box-shadow: 0 0 0px 1000px #000 inset;
    transition: background-color 5000s ease-in-out 0s;
}

.bg-color {
    background-color: white !important;
}

.shadow-card {
    box-shadow: rgb(204, 219, 232) 3px 3px 6px 0px inset, rgba(255, 255, 255, 0.5) -3px -3px 6px 1px inset !important;
}

.login-bg {
    background-image: url("/images/fruit-back.jpg") !important;
    background-repeat: repeat-y;
    height: 100vh;
    background-size: cover;
}
</style>
