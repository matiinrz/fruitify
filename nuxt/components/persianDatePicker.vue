<template>
    <div class="w-100">
        <v-text-field v-model="object" :value="datetime(object)" class="cursor-pointer" :error-messages="errors" readonly
            clearable :label="label" @click.clear="cleared()" :messages="dateString" @click="makeVisible()"
            @focus="makeVisible" append-inner-icon="mdi-calendar" />


        <custom-date-picker class="font-color" @change="confirm" v-model="object" :min="min" :max="max"
            @close="visible = false" :show="visible" :format="type === 'datetime' ? 'YYYY-MM-DD HH:mm' : 'YYYY-MM-DD'"
            :type="pickerType" element="my-custom-input" :readonly="readonly != null && readonly !== 'NO'" />

    </div>
</template>

<script setup >
let emit = defineEmits(['update:modelValue']);

const object = ref("")
const visible = ref(false)

const { modelValue, label, errors, min, max, type, readonly } = defineProps(['readonly', 'modelValue', 'label', 'errors', 'min', 'max', 'type'])


const pickerType = ref(type)

if (modelValue) {
    object.value = modelValue
}

watch(object, (newItem) => {
    emit('update:modelValue', newItem)
});

const cleared = () => {
    object.value = "";
    emit('update:modelValue', "")
}

const dateString = computed(() => {
    if (object.value === undefined || modelValue === null) return '';

    try {
        let moment = require('moment-jalaali')
        moment.locale("fa", null);
        moment.loadPersian({ dialect: 'persian-modern' });
        if (type === 'datetime')
            return moment(object.value, 'YYYY-M-D HH:mm:ss').format('dddd LL ساعت HH:mm');
        else
            return moment(object.value, 'YYYY-M-D').format('dddd LL');
    } catch (e) {
    }
})

const makeVisible = () => {
    if (readonly != null && readonly !== 'NO') return;
    visible.value = true;
}

const confirm = () => {
    emit('update:modelValue', object.value)
}

// pickerType.value = type
// watch(object, (newItem) => {
//     emit('update:modelValue', newItem)
//     textObject.value = newItem
// });

// watch(type, (newItem) => {
//     pickerType.value = type.value != null ? type.value : 'date';

// });


// object.value = modelValue.value

// const dateString = computed(() => {
//     if (object.value === undefined || modelValue === null) return '';

//     try {
//         let moment = require('moment-jalaali')
//         moment.locale("fa", null);
//         moment.loadPersian({ dialect: 'persian-modern' });
//         if (type.value === 'datetime')
//             return moment(object.value, 'YYYY-M-D HH:mm:ss').format('dddd LL ساعت HH:mm');
//         else
//             return moment(object.value, 'YYYY-M-D HH:mm:ss').format('dddd LL');
//     } catch (e) {
//     }
// })

</script>

<style scoped>
.font-color {
    color: black !important;
}
</style>
