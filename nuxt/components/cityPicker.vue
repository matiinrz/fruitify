<template>
    <v-text-field :disabled="!provinceId" v-model="cityName" label="انتخاب شهر" @click="getCities(); cityDialog = true"
        :error-messages="errors || ''" hide-details></v-text-field>
    <v-dialog v-model="cityDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getCities" />
            </v-card-title>
            <v-card-text>
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
let emit = defineEmits(['cityUpdate:modelValue']);
const { modelValue, errors, provinceId } = defineProps(['modelValue', 'errors', 'provinceId'])
const cityDialog = ref(false)
const cities = ref({})
const cityName = ref("")
const filters = ref({
    search: "",
    page: 1,
    province_id: null
})

filters.value.province_id = provinceId

const getCities = async () => {
    const { data, error } = await api('api/cities', {
        method: "GET",
        key: "get_cities",
        query: { ...filters.value }
    })
    if (data?.value) {
        cities.value = data.value
    }
}

if (modelValue == "") cityName.value = ""

const setCity = async (item) => {
    cityName.value = item.name
    emit('cityUpdate:modelValue', item.id)
    cityDialog.value = false
}
</script>
    