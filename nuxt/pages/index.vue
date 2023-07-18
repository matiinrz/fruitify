<template>
    <v-container class="bg-pic">
        <div class="card-size mt-12">
            <v-btn block size="large" to="/entry">ثبت ورودی</v-btn>
            <v-btn block class="mt-2" size="large" to="/exit">ثبت خروجی</v-btn>
        </div>
    </v-container>
</template>
<script setup>
    
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