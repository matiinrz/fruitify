<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600">
            <v-card-title class="peyda text-center">
                ثبت خروجی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <plate-picker v-model="object.plate" />
                <span v-if="errors?.plate">{{ errors?.plate || '' }}</span>
                <persian-date-picker label="تاریخ" v-model="object.entry_date" :errors="errors?.entry_date" />
                <type-picker v-model="object.type" :errors="errors?.type" />
                <v-text-field label="مبدا" v-model="object.origin" />
                <v-select label="نوع مقصد"  v-model="object.destination_type"
                    
                    :items="destinationItems"
                    item-title="name"
                    item-value="value"
                    >
                </v-select>
                <v-text-field label="مقصد" v-model="object.destination" />
                <camera-picker v-model="object.image" :errors="errors?.image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setExit()">تایید</v-btn>
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
import { toast } from 'vue3-toastify';
const errors = ref([])
const loading = ref(false)
const object = ref({
    plate: "",
    image: "",
    type: [],
    entry_date: "",
    destination: "",
    destination_type : "",
    Origins : "" ,
})
const OriginsItems = ref([
    // {name:"stall" " hall" }
    {name : "تالار" , value : "hall"},
    {name : "غرفه" , value : "stall"},
])
const destinationItems = ref([
    // {name:"stall" " hall" }
    {name : "تالار" , value : "hall"},
    {name : "غرفه" , value : "stall"},
])
const setExit = async () => {
    loading.value = true
    const formData = new FormData();
    formData.append('plate', object.value.plate);
    formData.append('type', JSON.stringify(object.value.type));
    formData.append('entry_date', object.value.entry_date);
    formData.append('destination', object.value.destination);
    formData.append('destination_type' , object.value.destination_type );
    formData.append('origin' , object.value.origin );

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
