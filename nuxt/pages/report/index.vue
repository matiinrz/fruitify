<template>
    <v-container>
        <v-card max-width="600">
            <v-card-title class="peyda text-center">گزارش گیری</v-card-title>
            <v-divider />
            <v-card-subtitle class="mt-2">
                <v-select label="نوع گزارش" v-model="reportType" :items="reportsItem" item-title="name"
                    item-value="value" />
            </v-card-subtitle>
            <v-divider />
            <v-card-text>
                <v-card class="mt-1" color="white" v-for="(item, i) in reports.data" :key="reports">
                    <v-card-subtitle class="pa-1 d-flex">
                        پلاک : <div class="text-blue">{{ item.plate }}</div>
                        <v-spacer />
                        <div> {{ datetime(item.entry_date) }}</div>
                    </v-card-subtitle>
                    <v-divider />
                    <v-card-text>
                        <v-row>
                            <v-col cols="3">
                                <v-avatar>
                                    <v-img :src="`/images/icon.jpg`" />
                                </v-avatar>
                            </v-col>
                            <v-col>
                                <v-chip class="mx-1" v-for="(x, y) in JSON.parse(item.type)" :key="y">{{ x?.type }} , {{
                                    x?.weight
                                }}</v-chip>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="page" :length="reports.last_page" @update:modelValue="changePage()"></v-pagination>
            </v-card-actions>
            <v-card-actions>

                <v-btn variant="outlined" block to="/">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});

const reports = ref([])
const page = ref(1)

const reportsItem = ref([
    { name: 'ورودی', value: 'entry' },
    { name: 'خروجی', value: 'egress' },
])

const reportType = ref("entry")

const getEntry = async () => {
    const { data, error } = await api('api/entry', {
        method: "GET",
        key: "get_entry",
        query: {
            page: page.value
        }
    })
    if (data?.value) {
        reports.value = data.value
    }
}

getEntry()

const getEgress = async () => {
    const { data, error } = await api('api/egress', {
        method: "GET",
        key: "get_egress",
        query: {
            page: page.value
        }
    })
    if (data?.value) {
        reports.value = data.value
    }
}

watch(reportType, (newValue) => {
    if (newValue === 'entry') getEntry()
    if (newValue === 'egress') getEgress()
})

const changePage = () => {
    if (reportType.value === 'entry') getEntry()
    if (reportType.value === 'egress') getEgress()
}

</script>