<template>
    <v-bottom-navigation height="70" :active="active" back>

        <v-btn to="/admin/report">
            <v-img src="/images/report.png" width="30"></v-img>
            گزارش
        </v-btn>

        <v-btn to="/admin/users">
            <v-img src="/images/teamwork.png" width="30"></v-img>
            کاربر
        </v-btn>

        <v-btn to="/admin/fruit">
            <v-img src="/images/vegetables.png" width="30"></v-img>
            محصول
        </v-btn>


        <v-btn to="/admin/hall">
            <v-img src="/images/store.png" width="30"></v-img>
            تالار
        </v-btn>

        <v-btn to="/admin/stall">
            <v-img src="/images/stand.png" width="30"></v-img>
            غرفه
        </v-btn>
    </v-bottom-navigation>
</template>
<script setup>
const active = ref(true)
const auth = useAuth();
</script>