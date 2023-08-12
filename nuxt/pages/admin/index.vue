<template>
    <v-container class="d-flex justify-center">
        <v-row>

            <v-col cols="12" sm="10" md="6">

                <v-card flat :loading="loading" class="overflow-hidden" style="direction: ltr !important;">
                    <v-card-title class="text-right">
                        ورودی
                    </v-card-title>
                    <v-divider />

                    <v-card-text class="d-flex justify-center">
                        <div id="donutEntrey"></div>
                    </v-card-text>
                </v-card>

            </v-col>

            <v-col cols="12" sm="10" md="6">

                <v-card flat :loading="loading" class="overflow-hidden" style="direction: ltr !important;">
                    <v-card-title class="text-right">
                        خروجی
                    </v-card-title>
                    <v-divider />

                    <v-card-text class="d-flex justify-center">
                        <!-- <apexchart width="380" type="donut" :options="optionDonutEgress" :series="series"></apexchart> -->
                        <div id="donutEgress"></div>
                    </v-card-text>
                </v-card>

            </v-col>
        </v-row>
    </v-container>
</template>
<script setup>
import ApexCharts from "apexcharts";

definePageMeta({
    layout: "admin",
    middleware: "auth"
});
const { $event } = useNuxtApp()
$event('tilte-chaneg', 'پنل مدیریت')
const loading = ref(false)
const optionDonutEntry = ref({
    series: [],
    chart: {
        height: 475,
        type: 'polarArea',
    },
    stroke: {
        width: 1,
        colors: ['#fff']
    },
    fill: {
        opacity: .9
    },
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 1,
                strokeColor: '#7c7c7c',
            },
            spokes: {
                strokeWidth: 1,
                connectorColors: '#7c7c7c',
            }
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 300
            },
            legend: {
                position: 'bottom',
            }
        }
    }],
    theme: {
        mode: 'dark',
        palette: 'palette1',
    }
})
const optionDonutEgress = ref({
    series: [],
    chart: {
        height: 475,
        type: 'polarArea',
    },
    stroke: {
        width: 1,
        colors: ['#fff']
    },
    fill: {
        opacity: .9
    },
    plotOptions: {
        polarArea: {
            rings: {
                strokeWidth: 1,
                strokeColor: '#7c7c7c',
            },
            spokes: {
                strokeWidth: 1,
                connectorColors: '#7c7c7c',
            }
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 300
            },
            legend: {
                position: 'bottom',
            }
        }
    }],
    theme: {
        mode: 'dark',
        palette: 'palette1',
    }
})
const getEntry = (data) => {
    let quantity = [], labels = [];

    for (let i = 0; i < data.length; i++) {
        quantity.push(Number(data[i].weight));
        labels.push(data[i].name);
    }

    optionDonutEntry.value.series = quantity;
    optionDonutEntry.value.labels = labels;

    nextTick(() => {
        let donut = new ApexCharts(
            document.querySelector("#donutEntrey"),
            optionDonutEntry.value
        )
        donut.render();
    })
}

const getEgress = (data) => {
    let quantity = [], labels = [];

    for (let i = 0; i < data.length; i++) {
        quantity.push(Number(data[i].weight));
        labels.push(data[i].name);
    }

    optionDonutEgress.value.series = quantity;
    optionDonutEgress.value.labels = labels;

    nextTick(() => {
        let donut = new ApexCharts(
            document.querySelector("#donutEgress"),
            optionDonutEgress.value
        )
        donut.render();
    })
}

const getDashboards = async () => {
    loading.value = true

    const { data } = await api('api/dashboard', {
        method: "GET",
        key: "get_dashboard"
    })
    if (data?.value) {
        getEntry(data.value.entry);
        getEgress(data.value.egress)
    }
    loading.value = false
}

getDashboards()

</script>
<style scoped>
.bg-pic {
    background-image: url("/images/login.jpg");
    background-size: cover;
    background-repeat: repeat-y;
    width: 100%;
    height: 96vh;
    background-size: cover;
}
</style>
