<template>
    <h1>{{ id }}</h1>
</template>

<script>
    export default {
        data() {
            return {
                'id' : '',
            };
        },
        mounted(){
            this.id = this.$route.params.id
            console.log(this.$route.params.id)
        },
    }
</script>
