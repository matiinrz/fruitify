<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600">
            <v-card-title class=" text-center">
                ثبت خروجی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <camera-picker label="تصویر پلاک" v-model="object.plate_image" :errors="errors?.plate_image" />
                <plate-picker v-model="object.plate" />
                <span v-if="errors?.plate">{{ errors?.plate || '' }}</span>
                <persian-date-picker label="تاریخ" v-model="object.entry_date" :errors="errors?.entry_date" />
                <v-text-field v-model="object.price" label="مبلغ (تومان)" :error="errors?.price"/>
                <v-card-subtitle class="mb-2">مبدا</v-card-subtitle>
                <v-row>
                    <v-col>
                        <hall-picker v-model="object.hall_id" :errors="errors?.hall_id" />
                    </v-col>
                    <v-col>
                        <stall-picker v-model="object.stall_id" :errors="errors?.stall_id" />
                    </v-col>
                </v-row>
                <v-card-subtitle class="my-2">مقصد</v-card-subtitle>
                <v-row>
                    <v-col cols="6">
                        <province-picker v-model="object.province_id" :errors="errors?.province_id" />
                    </v-col>
                    <v-col cols="6">
                        <city-picker v-model="object.city_id" :provinceId="object.province_id" />
                    </v-col>
                </v-row>
                <type-picker v-model="object.type" :errors="errors?.type" />
                <camera-picker v-model="object.image" :errors="errors?.image" label="تصویر فاکتور" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setExit()" class="text-white">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});
import { toast } from 'vue3-toastify';
const { $event } = useNuxtApp()
$event('tilte-chaneg', 'ثبت خروجی')
const errors = ref([])
const loading = ref(false)
const object = ref({
    plate: "",
    image: "",
    type: null,
    entry_date: "",
    province_id: "",
    city_id: "",
    hall_id: "",
    stall_id: "",
    plate_image: "",
    price: ""

})

object.value.entry_date = current()

const setExit = async () => {
    loading.value = true
    const formData = new FormData();
    formData.append('plate', object.value.plate);
    formData.append('type', JSON.stringify(object.value.type));
    formData.append('entry_date', object.value.entry_date);
    formData.append('province_id', object.value.province_id);
    formData.append('city_id', object.value.city_id);
    formData.append('hall_id', object.value.hall_id);
    formData.append('stall_id', object.value.stall_id);
    formData.append('price', object.value.price);

    if (object.value.plate_image) {
        formData.append('plate_image', object.value.plate_image);

    }
    if (object.value.image) {
        formData.append("image", object.value.image)
    }


    const { data, error } = await api('api/egress', {
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
