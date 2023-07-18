<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600">
            <v-card-title class="peyda text-center">
                ثبت ورودی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="شماره پلاک" type="Number" />
                <persian-date-picker label="تاریخ" />
                <v-text-field label="نوع محصول" />
                <v-text-field label="وزن" type="number" />
                <camera-picker v-model="image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block>تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
const image = ref(null)
</script>