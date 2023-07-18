<template>
    <v-app>
        <v-locale-provider rtl>
            <VitePwaManifest />
            <v-main class="bg-image">
                <slot />
            </v-main>
        </v-locale-provider>
    </v-app>
</template>

<script setup></script>

<style scoped></style>