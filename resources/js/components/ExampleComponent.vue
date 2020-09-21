<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                        <v-btn @click="indexing" > Test API </v-btn>
                        <v-btn @click="getindex" > Get API </v-btn>
                        <v-btn @click="sitemap" > Get sitemap </v-btn>
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        methods:{
            indexing() {
                axios
                    .post("api/google/indexing/update")
                    .then(response => {
                        this.data = response.data;
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getindex() {
                axios
                    .get("api/google/indexing/index")
                    .then(response => {
                        this.data = response.data;
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            sitemap() {
                axios
                    .get("api/google/webMaster/getSiteMap")
                    .then(response => {
                        this.data = response.data;
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
