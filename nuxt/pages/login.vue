<template>
    <v-container class="fill-height">
        <v-row class="d-flex justify-center align-center">
            <v-col cols="12" sm="7" md="5">
                <v-card>
                    <v-card-title style="background-color : #0C1222">
                        ورود
                    </v-card-title>
                    <v-card-text>
                        <v-text-field label="نام کاربری" type="number" class="mt-4" v-model="phone" />
                        <v-text-field label="رمز عبور" type="password" v-model="password" />
                    </v-card-text>
                    <v-card-actions>
                        <v-btn block @click="login()">تایید</v-btn>
                    </v-card-actions>
                    <v-card-actions>
                        <v-btn variant="outlined" block to="/">بازگشت</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script setup>
definePageMeta({
    layout: "user",
});
import { toast } from 'vue3-toastify'
const { $event } = useNuxtApp()
const auth = useAuth()

if (auth.loggedIn) {
    useRouter().push({ path: '/user' });
}
const phone = ref()
const password = ref()
const errors = ref([])

const login = async () => {
    $event('loading', true)

    await auth.loginWith("local", {
        body: {
            phone: phone.value,
            password: password.value,
        },
    })
        .then(({ data }) => {
            useRouter().push({ path: '/user' });
            toast.success('شما با موقیت وارد شدید')
        })
        .catch(({ response }) => {
            if (response?._data?.message) {
                toast.error(response?._data?.message)
                errors.value.code = response._data.message
            }
        })
        .finally(() => ($event('loading', false)));
}



</script>