<template>
    <v-app>
      <v-locale-provider rtl>
        <VitePwaManifest />
        <admin-app-bar/>
        <v-main>
          <slot />
        </v-main>
        <admin-nav-btn/>
      </v-locale-provider>
    </v-app>
</template>

<script setup>
</script>

<style scoped></style>