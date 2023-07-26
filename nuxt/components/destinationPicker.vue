<template>
    <v-row>
        <v-col class="pl-0">
            <!-- <v-text-field label="نوع محصول" v-model="proType.type" :error-messages="errors" /> -->
            <!-- <fruit-picker v-model="proType.fruit_id" /> -->
            <v-text-field v-model="destinationName" label="نوع مقصد" @click="destinationDialog = true"></v-text-field>
        </v-col>

        <v-col cols="2" class="pr-0">
            <v-btn size="x-small" height="46" width="46" @click="setType()"
                :disabled="!proType.destination_id || !proType.destination">
                <v-icon>mdi-check</v-icon>
            </v-btn>
        </v-col>
    </v-row>
    <v-card class="mb-2" v-if="type.length > 0">
        <v-card-text>
            <v-chip closable @click.clear="cleared(item.destination_id)" v-for="(item, i) in showType" :key="i">{{
                item.destination_id +
                ',' + item.destination }}
            </v-chip>
        </v-card-text>
    </v-card>
    <v-dialog v-model="destinationDialog">
        <v-card color="white">

            <v-card-text>
                <v-list>
                    <v-list-item v-for="(item, i) in destination.data" :key="i" @click="setdestination(item)">
                        {{ item.name }}
                    </v-list-item>
                </v-list>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-select>

                </v-select>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script setup>
const proType = ref({ destination_id: "", destination: null })
const proName = ref({ destination_id: "", destination: null })
const destinationDialog = ref(false)
const destination = ref({})
const destinationName = ref("")
const type = ref([])
const showType = ref([])
const filters = ref({
    search: "",
    page: 1,
})
let emit = defineEmits(['destinUpdate:modelValue']);

const { modelValue, errors } = defineProps(['modelValue', 'errors'])

const setType = () => {
    type.value.push(proType.value)
    proName.value.weight = proType.value.weight
    showType.value.push(proName.value)
    destinationName.value = ""
    proType.value = { destination_id: "", weight: "" }
    proName.value = { destination_id: "", weight: "" }
}

watch(type.value, (newValue) => {
    emit('destinUpdate:modelValue', newValue)
})

const cleared = async (value) => {
    type.value = type.value.filter(arr => {
        return arr.destination_id !== value;
    });
}

const getdestination = async () => {
    const { data, error } = await api('api/fruit', {
        method: "GET",
        key: "get_destination",
        query: { ...filters.value }
    })
    if (data?.value) {
        destination.value = data.value
    }
}

getdestination()

const setdestination = async (item) => {
    destinationName.value = item.name
    proType.value.destination_id = item.id
    proName.value.destination_id = item.name
    destinationDialog.value = false
}
</script>
