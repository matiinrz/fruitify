<template>
    <v-container>
        <v-card max-width="600">
            <v-card-title class=" text-center" >گزارش گیری</v-card-title>
            <v-divider />
            <v-card-subtitle class="mt-2">
                <v-select label="نوع گزارش" v-model="reportType" :items="reportsItem" item-title="name"
                    item-value="value" />
            </v-card-subtitle>
            <v-divider />
            <v-card-actions>
                <v-btn class="mx-2" block  >خروجی اکسل</v-btn>

            </v-card-actions>
            <v-card-text>
                <v-table>
                    <thead>
                        <tr>
                            <th class="text-center text-primary">ردیف</th>
                            <th class="text-center text-primary">پلاک</th>
                            <th class="text-center text-primary">تاریخ</th>
                            <th class="text-center text-primary">میوه</th>
                            <th class="text-center text-primary">وزن</th>
                            <th class="text-center text-primary">مبدا</th>
                            <th class="text-center text-primary">مقصد</th>
                            <th class="text-center text-primary">تصویر</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, i) in reports.data" :key="reports">
                            <td class="text-center text-primary">{{ i + 1 }}</td>
                            <td class="text-center">{{ item.plate }}</td>
                            <td class="text-center">{{ datetime(item.entry_date) }}</td>
                            <td class="text-center">{{ item?.fruit.name }}</td>
                            <td class="text-center">{{ item?.weight }}</td>
                            <td class="text-center" v-if="reportType === 'entry'">{{ item?.province.name }} - {{
                                item?.city.name }}</td>
                            <td class="text-center" v-if="reportType === 'entry'">{{ item?.hall.name }} - {{
                                item?.stall.name }}</td>
                            <td class="text-center" v-if="reportType === 'egress'">{{ item?.hall.name }} - {{
                                item?.stall.name }}</td>
                            <td class="text-center" v-if="reportType === 'egress'">{{ item?.province.name }} - {{
                                item?.city.name }}</td>
                            <td class="text-center">
                                <v-avatar v-if="item.image">
                                    <v-img :src="imageUrl(item.image)" @click="showImageDialog(imageUrl(item.image))" />
                                </v-avatar>
                                <span v-else>-</span>
                            </td>

                        </tr>
                    </tbody>
                </v-table>
            </v-card-text>
            <v-card-actions class="justify-center">
                <v-pagination v-model="page" :length="reports.last_page" @update:modelValue="changePage()"></v-pagination>
            </v-card-actions>
            <v-card-actions>

                <v-btn variant="outlined" block to="/managment" color="#6E5131">بازگشت</v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>
<script setup>
definePageMeta({
    middleware: "auth",
});
const { $event } = useNuxtApp()
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

const showImageDialog = (image) => {
    $event('image-dialog', image)
}

</script>
<style scoped>
.report-bg {
    background: rgb(236, 235, 171) !important;
    height: 95vh !important;
}
</style>
