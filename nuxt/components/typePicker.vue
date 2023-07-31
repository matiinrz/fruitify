<template>
    <v-row>
        <v-col cols="6" >
            <!-- <v-text-field label="نوع محصول" v-model="proType.type" :error-messages="errors" /> -->
            <!-- <fruit-picker v-model="proType.fruit_id" /> -->
            <v-text-field v-model="fruitName" label="انتخاب محصول" @click="fruitDialog = true" :error-messages="errors || ''"></v-text-field>
        </v-col>
        <v-col cols=" 4" >
            <v-text-field label=" وزن(کیلوگرم)" type="number" v-model="proType.weight" :error-messages="errors || ''" />
        </v-col>
        
    </v-row>
    <v-col class="px-0">
            <v-btn  height="50" block  @click="setType()"
                :disabled="!proType.fruit_id || !proType.weight">
                <v-icon>mdi-check</v-icon>
            </v-btn>
        </v-col>
    <v-card class="mb-2" v-if="type.length > 0">
        <v-card-text>
            <v-chip closable @click.clear="cleared(item.fruit_id)" v-for="(item, i) in showType" :key="i">{{
                item.fruit_id +
                ',' + item.weight }}
            </v-chip>
        </v-card-text>
    </v-card>
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
const proType = ref({ fruit_id: "", weight: null })
const proName = ref({ fruit_id: "", weight: null })
const fruitDialog = ref(false)
const fruit = ref({})
const fruitName = ref("")
const type = ref([])
const showType = ref([])
const filters = ref({
    search: "",
    page: 1,
})
let emit = defineEmits(['update:modelValue']);

const { modelValue, errors } = defineProps(['modelValue', 'errors'])

const setType = () => {
    type.value.push(proType.value)
    proName.value.weight = proType.value.weight
    showType.value.push(proName.value)
    fruitName.value = ""
    proType.value = { fruit_id: "", weight: "" }
    proName.value = { fruit_id: "", weight: "" }
}

watch(type.value, (newValue) => {
    emit('update:modelValue', newValue)
})

const cleared = async (value) => {
    type.value = type.value.filter(arr => {
        return arr.fruit_id !== value;
    });
}

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
    proType.value.fruit_id = item.id
    proName.value.fruit_id = item.name
    fruitDialog.value = false
}
</script>
