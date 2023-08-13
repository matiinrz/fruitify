<template>
    <v-bottom-navigation height="70" :active="active" back>
        <v-btn to="/">
            <v-img src="/images/house.png" width="30"></v-img>

            خانه
        </v-btn>

        <v-btn to="/entry">
            <v-img src="/images/login.png" width="30"></v-img>
            ورودی
        </v-btn>

        <v-btn to="/exit">
            <v-img src="/images/exit.png" width="30"></v-img>
            خروجی
        </v-btn>

    </v-bottom-navigation>
</template>
<script setup>
const active = ref(true)
const auth = useAuth();
</script>