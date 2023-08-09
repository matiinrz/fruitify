<template>
    <v-row class="pb-0 ">
        <v-col cols="2" class="pl-0 pb-0">
            <v-text-field ref="focus1" type="number" placeholder="11" v-model="value1" hide-details />
        </v-col>
        <v-col cols="4" class="pl-0 pb-0">
            <v-text-field ref="focus2" type="number" placeholder="111" v-model="value2" hide-details />
        </v-col>
        <v-col cols="2" class="pl-1 pb-0">
            <v-text-field ref="focus3" placeholder="ق" v-model="value3" hide-details />
        </v-col>
        <v-col cols="4" class="pr-1 pb-0">
            <v-text-field ref="focus4" type="number" placeholder="11" v-model="value4" autofocus hide-details />
        </v-col>
        <v-col cols="12" class="d-flex justify-center">
            <div class="d-flex plate-bg">
                <div class="ir-bg text-center">
                    <div class="text-center" style=" font-size:10px">
                        ایران
                    </div>
                    <span style="font-weight : bold ; font-size:22px"> {{ value1 }}</span>
                </div>
                <div class="content-bg mt-1 d-flex align-center">
                    <div style="font-weight : bold ; font-size : 22px">
                        <v-row style="width : 160px" class="d-flex justify-center">
                            <v-col cols="5" class="text-left">
                                {{ value2 }}
                            </v-col>
                            <v-col cols="3" class="text-center">
                                {{ value3 }}
                            </v-col>
                            <v-col cols="4" class="text-center">
                                {{ value4 }}
                            </v-col>
                        </v-row>
                    </div>
                </div>

                <div class="flag-bg">
                    <div class="mt-1"
                        style="width:30px !important ; height:15px !important ; left:0px ; right:0px ; margin : auto">
                        <div style="width:100% ; height:5px ; background-color: #019415;">

                        </div>
                        <div style="width:100% ; height:5px ; background-color: #ffffff;">

                        </div>
                        <div style="width:100% ; height:5px ; background-color: #ff0000;">

                        </div>
                        <div class="text-left text-white mb-0" style="direction : ltr">
                            I.R.
                        </div>
                        <div class="text-right text-white" style="font-size : 10px ; margin-top : -7px">
                            IRAN
                        </div>
                    </div>
                </div>
            </div>
        </v-col>
    </v-row>

    <v-row>
        <v-col class="">

        </v-col>
    </v-row>
</template>
<script setup>
let emit = defineEmits(['update:modelValue']);
import { useFocus } from '@vueuse/core'

const value1 = ref("")
const value2 = ref("")
const value3 = ref("")
const value4 = ref("")
const object = ref("")
const focus1 = ref()
const focus2 = ref()
const focus3 = ref()
const focus4 = ref()

const { modelValue, errors } = defineProps(['modelValue', 'errors'])

if (modelValue) {
    value4.value = modelValue.substring(0, 2)
    value3.value = modelValue.substring(2, 3)
    value2.value = modelValue.substring(3, 6)
    value1.value = modelValue.substring(6, 9)
}

watch(value1, (newvalue) => {
    object.value = value4.value + value3.value + value2.value + newvalue
    emit('update:modelValue', object.value)
})
watch(value2, (newvalue) => {
    object.value = value4.value + value3.value + newvalue + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 3) {
        focus1.value.focus()
    }
})
watch(value3, (newvalue) => {
    object.value = value4.value + newvalue + value2.value + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 1) {
        focus2.value.focus()
    }
})

watch(value4, (newvalue) => {
    object.value = newvalue + value3.value + value2.value + value1.value
    emit('update:modelValue', object.value)
    if (newvalue.toString().length == 2) {
        focus3.value.focus()
    }
})




</script>

<style scoped>
.plate-bg {
    width: 250px !important;
    height: 50px !important;
    border-radius: 0.2em;
    border: 0.08em solid #333;
    background-color: #ddd;
    box-shadow: inset 0.05em 0.05em 0.1em rgba(0, 0, 0, 0.3),
        inset -0.05em -0.05em 0.1em #ffffff, 0.05em 0.05em 0.1em rgba(0, 0, 0, 0.3);
}

.flag-bg {
    width: 40px !important;
    height: 100% !important;
    background-color: blue;
}

.content-bg {
    width: 160px !important;
    height: 100% !important;
}

.ir-bg {
    width: 50px !important;
    height: 100% !important;
    border-left: 1px solid black;
}

.iran-font {
    font-size: 9px !important;
}
</style>
