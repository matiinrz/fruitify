<template>
    <v-container class="d-flex justify-center">
        <v-card width="600">
            <!-- <v-card-title>
                <v-img height="400" src="/images/fruit2.png" />
            </v-card-title> -->
            <v-card-text>
                <v-row>
                    <v-col cols="12">
                        <v-card elevation="2" class="rounded-lg">
                            <v-card-title class="d-flex justify-center">
                                <v-img height="200" src="/images/fruitEntry.png" />
                            </v-card-title>
                            <v-card-text class="ma-2 text-center">
                                <v-btn block class="mt-2 text-white" color="#CE2208" size="large" to="/entry">ثبت
                                    ورودی</v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12">
                        <v-card elevation="2" class="rounded-lg">
                            <v-card-title class="d-flex justify-center">
                                <v-img height="200" src="/images/fruitEgress.png" />
                            </v-card-title>
                            <v-card-text class="ma-2 text-center">
                                <v-btn block class="mt-2 text-white" color="#FE8901" size="large" to="/exit">ثبت
                                    خروجی</v-btn>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
                <!-- <div class="card-size mt-12">
                    <v-btn block class="mt-2" size="large" to="/managment" variant="tonal" color="primary">مدیریت</v-btn>
                    <v-btn block class="mt-2" size="large" @click="logout()" variant="outlined" color="#6E5131">خروج از
                        برنامه</v-btn>
                </div> -->
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
const { $event } = useNuxtApp()
$event('tilte-chaneg', 'خانه')

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