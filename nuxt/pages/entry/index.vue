<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card max-width="600" :loading="loading">
            <v-card-title >
                ثبت ورودی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <plate-picker v-model="object.plate" />
                <span v-if="errors?.plate">{{ errors?.plate || '' }}</span>
                <persian-date-picker label="تاریخ" v-model="object.entry_date" :errors="errors?.entry_date" />
                <v-card-subtitle class="mb-2">مبدا</v-card-subtitle>
                <v-row>
                    <v-col cols="6">
                        <province-picker v-model="object.province_id" />
                    </v-col>

                    <v-col cols="6">
                        <city-picker v-model="object.city_id" :provinceId="object.province_id" />
                    </v-col>
                </v-row>
                <v-card-subtitle class="my-2">مقصد</v-card-subtitle>
                <v-row>
                    <v-col>
                        <hall-picker v-model="object.hall_id" />
                    </v-col>
                    <v-col>
                        <stall-picker v-model="object.stall_id" />
                    </v-col>
                </v-row>
                <type-picker v-model="object.type" :errors="errors?.type" />
                <camera-picker v-model="object.image" :errors="errors?.image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setEntry()">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/" variant="outlined" color="#6E5131">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});

import { toast } from 'vue3-toastify'
const errors = ref([])
const loading = ref(false)
// entry
const object = ref({
    plate: "",
    image: "",
    type: [],
    entry_date: "",
    province_id: "",
    city_id: "",
    hall_id: "",
    stall_id: ""
})

const setEntry = async () => {
    loading.value = true
    const formData = new FormData();

    formData.append('plate', object.value.plate);
    formData.append('type', JSON.stringify(object.value.type));
    formData.append('entry_date', object.value.entry_date);
    formData.append('province_id', object.value.province_id);
    formData.append('city_id', object.value.city_id);
    formData.append('hall_id', object.value.hall_id);
    formData.append('stall_id', object.value.stall_id);


    if (object.value.image) {
        formData.append("image", object.value.image)
    }


    const { data, error } = await api('api/entry', {
        method: 'POST',
        body: formData
    });
    if (data.value) {
        toast.success(' با موفقیت ثبت شد')
        useRouter().push('/')
    } else if (error?.value?.data?.errors) {
        errors.value = error?.value?.data?.errors
    }


    loading.value = false
}
</script>
