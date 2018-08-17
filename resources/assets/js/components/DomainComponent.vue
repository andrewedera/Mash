<template>
    <div v-if="this.$root.isDomain">
        test
    </div>
</template>

<script>

export default {
    mounted() {
        this.$eventHub.$on('myEvent', data);
    },
    beforeDestroy() {
        this.$eventHub.$off('myEvent');
    }
}
</script>