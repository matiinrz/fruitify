<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card v-if="!loading" max-width="600" :loading="loading">
            <v-card-title v-if="reportType === 'entry'" class=" text-center">
                ویرایش ورودی
            </v-card-title>
            <v-card-title v-if="reportType === 'egress'" class=" text-center">
                ویرایش خروجی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-img v-if="plate_image" :src="imageUrl(plate_image)" height="200"
                    @click="showImageDialog(imageUrl(plate_image))" />
                <camera-picker label="تصویر پلاک" v-model="object.plate_image" :errors="errors?.plate_image" />
                <plate-picker v-model="object.plate" />
                <span v-if="errors?.plate">{{ errors?.plate || '' }}</span>
                <persian-date-picker label="تاریخ" v-model="object.entry_date" :errors="errors?.entry_date" />
                <div v-if="reportType === 'entry'">
                    <v-card-subtitle class="mb-2">مبدا</v-card-subtitle>
                    <v-row>
                        <v-col cols="6">
                            <province-picker v-model="object.province_id" :province="province"
                                :errors="errors?.province_id" />
                        </v-col>

                        <v-col cols="6">
                            <city-picker v-model="object.city_id" :city="city" :provinceId="object.province_id" />
                        </v-col>
                    </v-row>
                    <v-card-subtitle class="my-2">مقصد</v-card-subtitle>
                    <v-row>
                        <v-col>
                            <hall-picker v-model="object.hall_id" :hall="hall" :errors="errors?.hall_id" />
                        </v-col>
                        <v-col>
                            <stall-picker v-model="object.stall_id" :stall="stall" :errors="errors?.stall_id" />
                        </v-col>
                    </v-row>
                </div>

                <div v-if="reportType === 'egress'">
                    <v-card-subtitle class="mb-2">مبدا</v-card-subtitle>
                    <v-row>
                        <v-col>
                            <hall-picker v-model="object.hall_id" :hall="hall" :errors="errors?.hall_id" />
                        </v-col>
                        <v-col>
                            <stall-picker v-model="object.stall_id" :stall="stall" :errors="errors?.stall_id" />
                        </v-col>
                    </v-row>
                    <v-card-subtitle class="my-2">مقصد</v-card-subtitle>
                    <v-row>
                        <v-col cols="6">
                            <province-picker v-model="object.province_id" :province="province"
                                :errors="errors?.province_id" />
                        </v-col>

                        <v-col cols="6">
                            <city-picker v-model="object.city_id" :city="city" :provinceId="object.province_id" />
                        </v-col>
                    </v-row>
                </div>

                <v-row>
                    <v-col cols="6">
                        <fruit-picker v-model="object.fruit_id" :fruit="fruit" :errors="errors.fruit_id" />
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="object.weight" />
                    </v-col>
                </v-row>
                <v-img v-if="image" height="200" :src="imageUrl(image)" @click="showImageDialog(imageUrl(image))" />
                <camera-picker v-model="object.image" :errors="errors?.image" label="تصویر" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="updateReport()" class="text-white">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/admin/report" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    layout: "admin",
    middleware: "auth"
});
const { $event } = useNuxtApp()
$event('tilte-chaneg', 'ویرایش لیست')
import { toast } from 'vue3-toastify';

const errors = ref([])
const loading = ref(false)
const id = useRoute().params.id
const reportType = useRoute().query.type
const object = ref({
    plate: "",
    image: "",
    fruit_id: null,
    weight: "",
    entry_date: "",
    province_id: null,
    city_id: null,
    hall_id: null,
    stall_id: null,
    plate_image: ""
})
const province = ref(null)
const city = ref(null)
const hall = ref(null)
const stall = ref(null)
const fruit = ref(null)
const plate_image = ref(null)
const image = ref(null)
const getReport = async () => {
    loading.value = true
    const { data, error } = await api(`api/${reportType}/${id}`, {
        method: "GET",
        key: "get_entry_id",
    })
    if (data?.value) {
        const report = data?.value
        plate_image.value = report.plate_image
        image.value = report.image
        object.value.weight = report.weight
        object.value.entry_date = report.entry_date
        object.value.province_id = report.province_id
        province.value = report.province
        city.value = report.city
        hall.value = report.hall
        stall.value = report.stall
        fruit.value = report.fruit
        object.value.plate = report.plate
    }
    loading.value = false
}

getReport()

const updateReport = async () => {
    loading.value = true
    const formData = new FormData();

    formData.append('plate', object.value.plate);
    formData.append('entry_date', object.value.entry_date);
    formData.append('province_id', object.value.province_id);
    formData.append('city_id', object.value.city_id);
    formData.append('hall_id', object.value.hall_id);
    formData.append('stall_id', object.value.stall_id);
    formData.append('fruit_id', object.value.fruit_id);
    formData.append('weight', object.value.weight);
    formData.append('_method', "PUT");

    if (object.value.plate_image) {
        formData.append('plate_image', object.value.plate_image);

    }
    if (object.value.image) {
        formData.append("image", object.value.image)
    }


    const { data, error } = await api(`api/${reportType}/${id}`, {
        method: 'POST',
        body: formData
    });
    if (data.value) {
        toast.success(' با موفقیت ویرایش شد')
        useRouter().push('/managment/report')
    } else if (error?.value?.data?.errors) {
        errors.value = error?.value?.data?.errors
    }
    loading.value = false
}




</script>