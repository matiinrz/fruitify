<template>
    <v-bottom-navigation height="85" :active="active" back>
        <v-btn to="/">
            <v-img src="/images/home-icon-2.png" width="30" class="mb-2"></v-img>

            خانه
        </v-btn>

        <v-btn to="/entry">
            <v-img src="/images/input-icon.png" width="30" class="mb-2"></v-img>
            ورودی
        </v-btn>

        <v-btn to="/exit">
            <v-img src="/images/export-icon.png" width="30" class="mb-2"></v-img>
            خروجی
        </v-btn>

    </v-bottom-navigation>
</template>
<script setup>
const active = ref(true)
const auth = useAuth();
</script>
