<template>
    <v-text-field v-model="hallName" label="انتخاب تالار" @click="hallDialog = true"
        :error-messages="errors || ''"></v-text-field>
    <v-dialog v-model="hallDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getHalls" />
            </v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in halls.data" :key="i" @click="setHall(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="halls.last_page" :total-visible="7"
                    @update:modelValue="getHalls()"></v-pagination>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, hall } = defineProps(['modelValue', 'errors', 'hall'])
const hallDialog = ref(false)
const halls = ref({})
const hallName = ref("")
const filters = ref({
    search: "",
    page: 1,
})
const getHalls = async () => {
    const { data, error } = await api('api/halls', {
        method: "GET",
        key: "get_halls",
        query: { ...filters.value }
    })
    if (data?.value) {
        halls.value = data.value
    }
}

getHalls()


const setHall = async (item) => {
    hallName.value = item.name
    emit('update:modelValue', item.id)
    hallDialog.value = false
}

if (hall) {
    setHall(hall)
}
</script>
    