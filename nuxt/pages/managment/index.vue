<template>
    <v-container class="d-flex justify-center">
        <v-card width="600">
            <v-card-title>
                <v-img height="450" src="/images/fruit2.png" />
            </v-card-title>
            <v-card-text>
                <div class="card-size mt-12">
                    <v-btn block size="large" to="/managment/dashboard">داشبورد</v-btn>
                    <v-btn block class="mt-2" size="large" to="/managment/report">مشاهده گزارش</v-btn>
                    <v-btn block class="mt-2" size="large" to="/managment/fruit">افزودن محصولات</v-btn>
                    <v-btn block class="mt-2" size="large" to="/managment/hall">افزودن تالار</v-btn>
                    <v-btn block class="mt-2" size="large" to="/managment/stall">افزودن غرفه</v-btn>
                    <v-btn block class="mt-2" size="large" to="/" variant="outlined" color="#6E5131">بازگشت</v-btn>
                </div>
            </v-card-text>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});
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