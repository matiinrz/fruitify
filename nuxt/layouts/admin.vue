<template>
    <v-app>
        <v-locale-provider rtl>
            <VitePwaManifest />
            <v-main>
                <app-bar v-if="route.path !== '/login' && route.path !== '/register'" />
                <slot />
                <admin-nav-btn />
            </v-main>
        </v-locale-provider>
    </v-app>
</template>
<script setup>
const route = useRoute()

</script>