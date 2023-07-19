<template>
    <v-container class="d-flex fill-height justify-center">
        <v-card width="600">
            <v-card-title class="peyda text-center">
                ثبت ورودی
            </v-card-title>
            <v-divider />
            <v-card-text>
                <plate-picker v-model="object.plate" />
                <persian-date-picker label="تاریخ" v-model="object.entry_date" />
                <type-picker v-model="object.type" />
                <camera-picker v-model="object.image" />
            </v-card-text>
            <v-divider />
            <v-card-actions>
                <v-btn block @click="setEntry()">تایید</v-btn>
            </v-card-actions>
            <v-card-actions>
                <v-btn block to="/" variant="outlined">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
const image = ref(null)
// entry
const object = ref({
    plate: "",
    image: "",
    weight: "",
    type: [],
    entry_date: "",

})

const setEntry = async () => {
    const { data, error } = await api('api/entry', {
        method: "POST",
        key: "entry_post",
        body: { ...object.value }
    })
    if (error?.value) {
        errors.value = error.value.data.errors
    } else {
        toast.success("عملیات با موفقیت انجام شد")
        router.push('/')
    }

}
</script>