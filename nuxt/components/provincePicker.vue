<template>
    <v-text-field v-model="provinceName" label="انتخاب استان" @click="provinceDialog = true"
        :error-messages="errors || ''"></v-text-field>
    <v-dialog v-model="provinceDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getProvinces" />
            </v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in provinces" :key="i" @click="setProvince(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, errors, province } = defineProps(['modelValue', 'errors', 'province'])
const provinceDialog = ref(false)
const provinces = ref({})
const provinceName = ref("")
const filters = ref({
    search: "",
    page: 1,
})

const { $event } = useNuxtApp()
const getProvinces = async () => {
    const { data, error } = await api('api/provinces', {
        method: "GET",
        key: "get_provinces",
        query: { ...filters.value }
    })
    if (data?.value) {
        provinces.value = data.value
    }
}

getProvinces()



const setProvince = async (item) => {
    provinceName.value = item.name
    emit('update:modelValue', item.id)
    $event('city-picker', item.id)
    provinceDialog.value = false
}

if (province) {
    console.log('province', province);
    setProvince(province)
}
</script>
    