<template>
    <v-container class="d-flex justify-center">
        <v-card width="600">
            <v-card-title>
                <v-img height="450" src="/images/fruit2.png" />
            </v-card-title>
            <v-card-text>
                <div class="card-size mt-12">
                    <v-btn block size="large" to="/fruit">افزودن محصولات</v-btn>
                    <v-btn block class="mt-2" size="large" to="/entry">ثبت ورودی</v-btn>
                    <v-btn block class="mt-2" size="large" to="/exit">ثبت خروجی</v-btn>
                    <v-btn block class="mt-2" size="large" to="/report">مشاهده گزارش</v-btn>
                    <v-btn block class="mt-2" size="large" @click="logout()" variant="outlined" color="#6E5131">خروج از
                        برنامه</v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});
const router = useRouter()
const auth = useAuth()

const logout = async () => {
    await auth.logout();
    router.replace({ path: "/login" });
}
</script>
<style scoped>
.bg-pic {
    background-image: url("/images/login.jpg");
    background-size: cover;
    background-repeat: repeat-y;
    width: 100%;
    height: 96vh;
    background-size: cover;
}
</style>