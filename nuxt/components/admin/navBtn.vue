<template>
    <v-bottom-navigation :active="active" back>
        <v-btn to="/">
            <v-icon>mdi-home-roof</v-icon>

            خانه
        </v-btn>

        <v-btn to="/admin/report">
            <v-icon>mdi-home-analytics</v-icon>
            گزارش
        </v-btn>

        <v-btn to="/admin/fruit">
            <v-icon>mdi-archive-star</v-icon>
            محصول
        </v-btn>


        <v-btn to="/admin/hall">
            <v-icon>mdi-home-city</v-icon>
            تالار
        </v-btn>

        <v-btn to="/admin/stall">
            <v-icon>mdi-home-map-marker</v-icon>
            غرفه
        </v-btn>
    </v-bottom-navigation>
</template>
<script setup>
const active = ref(true)
const auth = useAuth();
</script>