<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand logo text-light" href="#">COVID-19</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://covid-19-api.tracker.rowles.ch/statistics?limit=315">API</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/raekw0n/covid-19-tracker">Github</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <Tracker/>
        </main>
        <footer class="footer bg-light">
            <div class="content w-100 bg-light text-muted py-3">
                <div class="container">
                <span class="small">
                    The data this API serves including all data, mapping, and analysis, copyright © 2020 Johns Hopkins
                    University, all rights reserved, is provided to the public strictly for educational and academic
                    research purposes. The Website relies upon publicly available data from multiple sources, that do
                    not always agree. Johns Hopkins University (the author of the data provided by this API) hereby
                    disclaims any and all representations and warranties with respect to this website, including
                    accuracy, fitness for use, and merchantability. Reliance on this website or API for medical guidance
                    or use of this website or API in commerce is strictly prohibited.
                </span>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import Tracker from './components/Tracker.vue'

    export default {
        name: 'App',
        components: {
            Tracker
        }
    }
</script>

<style lang="scss">
    html {
        position: relative;
        min-height: 100%;
    }

    #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
        margin-bottom: 100px;
    }

    .logo {
        font-weight: 700;
        background-color: rgba(0,0,0,.5);
        border-radius: 3px;
        margin-top: 16px;
        margin-bottom: 16px;
        padding: 4px 12px;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 100px;
    }
</style>
