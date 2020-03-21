<template>
    <div id="app">
        <Tracker/>
    </div>
</template>

<script>
    import Tracker from './components/Tracker.vue'

    export default {
        name: 'App',
        components: {
            Tracker
        },
        methods: {
        }
    }
</script>

<style>
    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
    }
</style>
