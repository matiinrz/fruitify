<template>
    <v-text-field v-model="fruitName" label="انتخاب محصول" @click="fruitDialog = true"></v-text-field>
    <v-dialog v-model="fruitDialog">
        <v-card color="white">
            <v-card-title>
                <v-text-field label="جستجو" />
            </v-card-title>
            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in fruit.data" :key="i" @click="setFruit(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="filters.page" :length="fruit.last_page"
                    @update:modelValue="getFruit()"></v-pagination>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
const { modelValue } = defineProps(['modelValue'])
const fruitDialog = ref(false)
const fruit = ref({})
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
        fruit.value = data.value
    }
}

getFruit()

const setFruit = async (item) => {
    fruitName.value = item.name
    emit('update:modelValue', item.id)
    fruitDialog.value = false
}
</script>