<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600">
            <v-card-title class="peyda text-center">
                ثبت خروجی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <v-text-field label="شماره پلاک"  type="Number" />
                <persian-date-picker label="تاریخ"  />
                <v-row>
                    <v-col cols="6" class="pl-0">
                        <v-text-field label="نوع محصول" v-model="proType.type" :rules="typeRules"  />
                    </v-col>
                    <v-col cols="4" class="px-1">
                        <v-text-field label=" وزن(kg)"    type="number" v-model="proType.weight" :rules="weightRules"  />
                    </v-col>
                    <v-col cols="2" class="pr-0">
                        <v-btn size="x-small" height="46" width="46" @click="setType()">
                            <v-icon>mdi-check</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
                <v-card class="mb-2" v-if="object.type.length > 0">
                    <v-card-text>
                        <v-chip closable @click.clear="cleared(item.type)" v-for="(item, i) in object.type" :key="i">{{
                            item.type +
                            ',' + item.weight
                        }}</v-chip>
                    </v-card-text>
                </v-card>
                <v-text-field label="مقصد" />
                <camera-picker v-model="image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setExit()" >تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>

import { toast } from 'vue3-toastify';
const router = useRouter()
const proType = ref({ type: "", weight: "" })
const object = ref({
    type: []
})
const setType = () => {
    object.value.type.push(proType.value)
    proType.value = { type: "", weight: "" }
}
const setExit = async() => {
    const {data , error} = await api('api/egress' , {
    method:"POST",
    key:"exit_post",
    body : {...object.value}
})
if(error?.value){
    errors.value = error.value.data.errors
}else{
    toast.success("عملیات با موفقیت انجام شد")
    router.push('/')
}

}
const cleared = async (value) => {
    object.value.type = object.value.type.filter(arr => {
        return arr.type !== value;
    });
}
const weightRules = ref (
[
(v) => !!v || " وزن لازم است ",
(v) => ( v && v.length ==0 ) || "وزن لازم است"
]
)
const typeRules = ref (
[
(v) => !!v || " نوع نباید خالی باشد"
]
)
</script>