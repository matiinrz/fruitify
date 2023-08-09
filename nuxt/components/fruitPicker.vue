<template>
    <v-text-field v-model="fruitName" label="انتخاب محصول" @click="fruitDialog = true"
        :error-messages="errors || ''"></v-text-field>
    <v-dialog v-model="fruitDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" v-model="filters.search" @keyup.enter="getFruit" />
            </v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in fruits.data" :key="i" @click="setFruit(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="fruits.last_page"
                    @update:modelValue="getFruit()"></v-pagination>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue, fruit } = defineProps(['modelValue', 'errors', 'fruit'])
const fruitDialog = ref(false)
const fruits = ref({})
const fruitName = ref("")
const filters = ref({
    search: "",
    page: 1,
})
const getFruit = async () => {
    const { data, error } = await api('api/fruit', {
        method: "GET",
        key: "get_fruit",
        query: { ...filters.value }
    })
    if (data?.value) {
        fruits.value = data.value
    }
}

getFruit()

const setFruit = async (item) => {
    fruitName.value = item.name
    emit('update:modelValue', item.id)
    fruitDialog.value = false
}

if (fruit) {
    setFruit(fruit)
}
</script>
