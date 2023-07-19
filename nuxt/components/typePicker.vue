<template>
    <v-row>
        <v-col cols="6" class="pl-0">
            <v-text-field label="نوع محصول" v-model="proType.type" :error-messages="errors" />
        </v-col>
        <v-col cols="4" class="px-1">
            <v-text-field label=" وزن(kg)" type="number" v-model="proType.weight" />
        </v-col>
        <v-col cols="2" class="pr-0">
            <v-btn size="x-small" height="46" width="46" @click="setType()" :disabled="!proType.type || !proType.weight">
                <v-icon>mdi-check</v-icon>
            </v-btn>
        </v-col>
    </v-row>
    <v-card class="mb-2" v-if="type.length > 0">
        <v-card-text>
            <v-chip closable @click.clear="cleared(item.type)" v-for="(item, i) in type" :key="i">{{
                item.type +
                ',' + item.weight }}
            </v-chip>
        </v-card-text>
    </v-card>
</template>
<script setup>
const proType = ref({ type: "", weight: null })
const type = ref([])
let emit = defineEmits(['update:modelValue']);

const { modelValue, errors } = defineProps(['modelValue', 'errors'])

const setType = () => {
    type.value.push(proType.value)
    proType.value = { type: "", weight: "" }
}

watch(type.value, (newValue) => {
    emit('update:modelValue', newValue)
})

const cleared = async (value) => {
    type.value = type.value.filter(arr => {
        return arr.type !== value;
    });
    emit('update:modelValue', type.value)
}
</script>