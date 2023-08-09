<template>
    <v-text-field v-model="stallName" label="انتخاب غرفه" @click="stallDialog = true"
        :error-messages="errors || ''"></v-text-field>
    <v-dialog v-model="stallDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getStalls" />
            </v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in stalls.data" :key="i" @click="setStall(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="stalls.last_page"
                    @update:modelValue="getStalls()"></v-pagination>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, stall } = defineProps(['modelValue', 'errors', 'stall'])
const stallDialog = ref(false)
const stalls = ref({})
const stallName = ref("")
const filters = ref({
    search: "",
    page: 1,
})
const getStalls = async () => {
    const { data, error } = await api('api/stalls', {
        method: "GET",
        key: "get_stalls",
        query: { ...filters.value }
    })
    if (data?.value) {
        stalls.value = data.value
    }
}

getStalls()

const setStall = async (item) => {
    stallName.value = item.name
    emit('update:modelValue', item.id)
    stallDialog.value = false
}

if (stall) {
    setStall(stall)
}
</script>
    