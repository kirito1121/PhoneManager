<template>
    <div class="container">
        <div>
            <v-alert v-if="success == true" color="#38c172">
                <v-btn class="my-2" icon @click="success = false">
                    <v-icon> mdi-close </v-icon></v-btn
                >
                Send SMS success{{ message }}
            </v-alert>

            <v-alert v-if="error == true" dark color="#e3342f">
                <v-btn class="my-2" icon @click="error = false">
                    <v-icon> mdi-close </v-icon></v-btn
                >
                Send SMS with Error! {{ message }}
            </v-alert>
        </div>
        <v-card>
            <v-card-text>SMS Managerment</v-card-text>
            <v-card-title>
                <v-row justify="space-between">
                    <v-col cols="12" md="4">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.dateSent"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuStart"
                            transition="scale-transition"
                            v-model="menuStart"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Date Sent"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.dateSent"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.dateSent"
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    @click="menuStart = false"
                                    color="primary"
                                    text
                                    >Cancel</v-btn
                                >
                                <v-btn
                                    @click="
                                        $refs.menuStart.save(
                                            searchData.dateSent
                                        )
                                    "
                                    color="primary"
                                    text
                                    >OK</v-btn
                                >
                            </v-date-picker>
                        </v-menu>
                    </v-col>

                    <v-col cols="12" md="4">
                        <v-text-field
                            hide-details
                            hint="From phone number"
                            label="From"
                            v-model="searchData.from"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-text-field
                            hide-details
                            hint="To phone number"
                            label="To"
                            v-model="searchData.to"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="4">
                        <div class="my-2">
                            <v-btn @click="search" color="#3490dc" dark small
                                >Search</v-btn
                            >
                        </div>
                    </v-col>
                    <v-col cols="12" md="4">
                        <div class="my-2">
                            <v-btn
                                @click="dialog = true"
                                color="#3490dc"
                                dark
                                small
                                >Send sms</v-btn
                            >
                        </div>
                    </v-col>
                </v-row>
            </v-card-title>
            <div class="container">
                <v-data-table
                    :headers="headers"
                    :items="data"
                    :loading="true"
                    :loading-text="
                        data.length == 0 ? 'No Data' : 'Loading... Please wait'
                    "
                    class="elevation-1"
                    item-key="name"
                >
                    <template v-slot:item.date_sent="{ item }"
                        >{{ item.date_sent.date }}
                        {{ item.date_sent.timezone }}</template
                    >
                </v-data-table>
            </div>
        </v-card>
        <v-dialog max-width="400px" persistent v-model="dialog">
            <v-card>
                <v-card-title class="headline">Send SMS </v-card-title>
                <v-card-text ref="code">
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-text-field
                            v-model="dataSend.phone"
                            label="Phone Number"
                            :rules="phoneRules"
                            required
                        ></v-text-field>
                        <v-textarea
                            v-model="dataSend.body"
                            :rules="bodyRules"
                            label="Body"
                            required
                        ></v-textarea>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="close" color="green darken-1" text
                        >Close</v-btn
                    >
                    <v-btn @click="send" color="green darken-1" text
                        >SEND</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    data() {
        return {
            valid: true,
            success: false,
            error: false,
            dialog: false,
            message: null,
            headers: [
                {
                    text: "From",
                    value: "from"
                },
                {
                    text: "To",
                    value: "to"
                },
                {
                    text: "body",
                    value: "body"
                },
                {
                    text: "Direction",
                    value: "direction"
                },
                {
                    text: "Status",
                    value: "status"
                },
                {
                    text: "Sid",
                    value: "sid"
                },
                {
                    text: "Date Sent",
                    value: "date_sent"
                }
            ],
            menuStart: false,
            modal: false,
            data: [],
            searchData: {},
            dataSend: {},
            phoneRules: [v => !!v || "Phone number is required"],
            bodyRules: [v => !!v || "Body is required"]
        };
    },

    methods: {
        getDataSMS() {
            axios
                .get("api/twilio/sms", {
                    params: this.searchData
                })
                .then(response => {
                    this.data = response.data;
                    console.log(this.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        search() {
            this.data = [];
            this.getDataSMS();
        },

        close() {
            this.dataSend = {};
            this.dialog = false;
        },

        send(sid) {
            if (this.$refs.form.validate()) {
                axios
                    .post("api/twilio/sms/send", this.dataSend)
                    .then(response => {
                        console.log(response);
                        this.success = true;
                        this.close();
                    })
                    .catch(error => {
                        this.message = error.message;
                        this.error = true;
                        console.log(error);
                        this.close();
                    });
            }
        }
    },

    mounted() {
        this.getDataSMS();
        console.log("Component mounted.");
    }
};
</script>
