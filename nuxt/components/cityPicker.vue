<template>
    <v-text-field :disabled="!provinceId" v-model="cityName" label="انتخاب شهر" @click="cityDialog = true"
        :error-messages="errors || ''" hide-details></v-text-field>
    <v-dialog v-model="cityDialog">
        <v-card color="white">
            <v-card-title class=" text-center">
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getCities" />
            </v-card-title>
            <v-card-text class="d-flex justify-center">
                <v-progress-circular v-if="loading" color="primary" indeterminate :size="45"
                    :width="7"></v-progress-circular>
                <v-list>
                    <v-list-item v-for="(item, i) in cities" :key="i" @click="setCity(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { $listen } = useNuxtApp()

const { modelValue, errors, provinceId, city } = defineProps(['modelValue', 'errors', 'provinceId', 'city'])
const loading = ref(false)
const cityDialog = ref(false)
const cities = ref({})
const cityName = ref("")
const filters = ref({
    search: "",
    page: 1,
    province_id: 0
})

const getCities = async () => {
    loading.value = true
    const { data, error } = await api('api/cities', {
        method: "GET",
        key: "get_cities_2",
        query: { ...filters.value }
    })
    if (data?.value) {
        cities.value = data.value
    }
    loading.value = false
}


const setCity = async (item) => {
    cityName.value = item.name
    emit('update:modelValue', item.id)
    cityDialog.value = false
}

const changeCityPicker = (x) => {
    setCity({ name: "", id: null })
    console.log('x', x, filters.value.province_id);
    if (x !== filters.value.province_id) {
        filters.value.province_id = x
        getCities()
    }
}


$listen('city-picker', changeCityPicker)

if (city) {
    setCity(city)
}


</script>
    