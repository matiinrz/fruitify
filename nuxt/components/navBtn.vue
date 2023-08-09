<template>
    <v-bottom-navigation :active="active" back>
        <v-btn to="/">
            <v-icon>mdi-home-roof</v-icon>

            خانه
        </v-btn>

        <v-btn to="/entry">
            <v-icon>mdi-login</v-icon>
            ورودی
        </v-btn>

        <v-btn to="/exit">
            <v-icon>mdi-export</v-icon>

            خروجی
        </v-btn>

    </v-bottom-navigation>
</template>
<script setup>
const active = ref(true)
const auth = useAuth();
</script>