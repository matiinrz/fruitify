<template>
    <v-app>
        <v-locale-provider rtl>
            <VitePwaManifest />
            <v-main class="bg-image">
                <slot />
            </v-main>
        </v-locale-provider>
        <v-dialog v-model="imageDialog">
            <v-card>
                <v-img :src="imageUrl || `/images/icon.jpg`" />
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script setup>
const imageDialog = ref(false)
const { $listen } = useNuxtApp()
const imageUrl = ref("")
const changeImageDialogSatus = (url) => {
    imageUrl.value = url
    imageDialog.value = true
}

$listen('image-dialog', changeImageDialogSatus)


</script>

<style scoped></style>