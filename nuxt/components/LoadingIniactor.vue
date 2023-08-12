<template>
    <div
        v-if="loading"
        id="loadingIndicator"
        ref="loadingIndicator"
        class="loadingIndicator text-center"
        :style="'margin-top: ' + this.computedYposition + 'px; margin-left: ' + this.computedXposition + 'px'"
    >
        <div class="loadingIndicatorAnimation">
            <img src="~/assets/images/Loader.svg" width="104" height="70">
        </div>
        <div class="text-center loadingText">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            windowHeight: document.documentElement.clientHeight,
            computedXposition: 0,
            computedYposition: 0,
            loading: false
        };
    },
    mounted() {
        window.addEventListener('resize', this.getWindowDimensions);
        this.centerLoadingIndicator();
    },
    unmounted() {
        window.removeEventListener('resize', this.getWindowDimensions);
    },
    methods: {
        getWindowDimensions() {
            this.windowHeight = document.documentElement.clientHeight;
            this.centerLoadingIndicator();
        },
        centerLoadingIndicator() {
            this.computedYposition = '-' + ((this.$refs.loadingIndicator.clientHeight / 2));
            this.computedXposition = '-' + ((this.$refs.loadingIndicator.clientWidth / 2));
        },
        start() {
            this.loading = true
        },
        finish() {
            this.loading = false
        }
    },
}
</script>

<style scoped>
.loadingIndicator
{
    width: 150px;
    height: auto;
    position: absolute;
    top: 50%;
    left: 50%;
}

.loadingIndicatorAnimation
{
    -webkit-animation: pulse 2s linear infinite;
    animation: pulse 2s linear infinite;
    opacity: 0.1;
}

@-webkit-keyframes pulse
{
    50% { opacity: 1; }
}

@keyframes pulse
{
    50% { opacity: 1; }
}

.loadingText
{
    margin-top: 10px;
    color: #999;
}
</style>
