<template>
    <div class="container">
        <v-card>
            <v-card-text>Voice Managerment</v-card-text>
            <v-card-title>
                <v-row justify="space-between">
                    <v-col cols="12" md="4">
                        <v-col class="d-flex" cols="12">
                            <v-select
                                :items="options"
                                label="Option search time"
                                solo
                                v-model="option"
                            ></v-select>
                        </v-col>
                    </v-col>

                    <v-col cols="12" md="4" v-if="option == 'in date'">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.startTime"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuStart"
                            transition="scale-transition"
                            v-model="menuStart"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Start Time"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.startTime"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.startTime"
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
                                            searchData.startTime
                                        )
                                    "
                                    color="primary"
                                    text
                                    >OK</v-btn
                                >
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4" v-if="option == 'after date'">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.startTimeAfter"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuStart"
                            transition="scale-transition"
                            v-model="menuStart"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Start Time After"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.startTimeAfter"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.startTimeAfter"
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
                                            searchData.startTimeAfter
                                        )
                                    "
                                    color="primary"
                                    text
                                    >OK</v-btn
                                >
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4" v-if="option == 'before date'">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.startTimeBefore"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuStart"
                            transition="scale-transition"
                            v-model="menuStart"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Start Time Before"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.startTimeBefore"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.startTimeBefore"
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
                                            searchData.startTimeBefore
                                        )
                                    "
                                    color="primary"
                                    text
                                    >OK</v-btn
                                >
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4" v-if="option == 'period'">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.startTimeAfter"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuEnd"
                            transition="scale-transition"
                            v-model="menuEnd"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Start Time After"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.startTimeAfter"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.startTimeAfter"
                            >
                                <v-spacer></v-spacer>
                                <v-btn
                                    @click="menuEnd = false"
                                    color="primary"
                                    text
                                    >Cancel</v-btn
                                >
                                <v-btn
                                    @click="
                                        $refs.menuEnd.save(
                                            searchData.startTimeAfter
                                        )
                                    "
                                    color="primary"
                                    text
                                    >OK</v-btn
                                >
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="4" v-if="option == 'period'">
                        <v-menu
                            :close-on-content-click="false"
                            :return-value.sync="searchData.startTimeBefore"
                            dark
                            min-width="290px"
                            offset-y
                            ref="menuStart"
                            transition="scale-transition"
                            v-model="menuStart"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    label="Start Time Before"
                                    readonly
                                    v-bind="attrs"
                                    v-model="searchData.startTimeBefore"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                no-title
                                scrollable
                                v-model="searchData.startTimeBefore"
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
                                            searchData.startTimeBefore
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
                        <v-col class="d-flex" cols="12">
                            <v-select
                                :items="status"
                                hint="Status of call event"
                                label="Status"
                                solo
                                v-model="searchData.status"
                            ></v-select>
                        </v-col>
                    </v-col>

                    <v-col cols="12" md="4">
                        <div class="my-2">
                            <v-btn @click="search" color="#3490dc" dark small
                                >Search</v-btn
                            >
                        </div>
                        <div class="my-2">
                            <v-btn
                                @click="showDialogCall()"
                                color="#3490dc"
                                dark
                                small
                                >Make a Call</v-btn
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
                    <template v-slot:item.start_time="{ item }"
                        >{{ item.start_time.date }}
                        {{ item.start_time.timezone }}</template
                    >
                    <template v-slot:item.end_time="{ item }"
                        >{{ item.end_time.date }}
                        {{ item.start_time.timezone }}</template
                    >
                    <template v-slot:item.sid="{ item }">
                        <v-btn @click="recording(item.sid)" icon>
                            <v-icon>mdi-play-circle-outline</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
            </div>
        </v-card>
        <v-dialog max-width="400px" persistent v-model="dialog">
            <v-card>
                <v-card-title class="headline">Recording </v-card-title>
                <v-card-text ref="code">
                    <vuetify-audio
                        v-if="re"
                        :file="file"
                        downloadable
                    ></vuetify-audio>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="close" color="green darken-1" text
                        >Close</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog max-width="400px" persistent v-model="dialogCall">
            <v-card>
                <v-card-title class="headline">Make a call </v-card-title>
                <v-card-text>
                    <v-text-field
                        v-model="callStatus"
                        placeholder="Connecting to Twilio..."
                        label="Status"
                        disabled
                    ></v-text-field>
                    <v-btn disabled> Answer call</v-btn>
                    <v-btn disabled @click="hangUp()"> Hang up</v-btn>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="closeCall" color="green darken-1" text
                        >Close</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
export default {
    components: {
        VuetifyAudio: () => import("vuetify-audio")
    },
    data() {
        return {
            dialogCall: false,
            valid: true,
            phoneNumber: null,
            phoneRules: [v => !!v || "Phone number is required"],
            file: null,
            copyS: false,
            re: false,
            dialog: false,
            option: null,
            options: ["period", "after date", "in date", "before date"],
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
                    text: "Duration",
                    value: "duration"
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
                    text: "Recording",
                    value: "sid"
                },
                {
                    text: "Start Time",
                    value: "start_time"
                },
                {
                    text: "End Time",
                    value: "end_time"
                }
            ],
            menuStart: false,
            menuEnd: false,
            modal: false,
            status: [
                "completed",
                "failed",
                "undialed",
                "answered",
                "busy",
                "no-answer",
                "ringing",
                "canceled",
                "in-progress",
                "initiated",
                "queued"
            ],
            data: [],
            searchData: {},
            callStatus: null
        };
    },

    methods: {
        getDataVoiceCall() {
            axios
                .get("api/twilio/voice", {
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
            this.getDataVoiceCall();
        },

        recording(sid) {
            axios
                .get("api/twilio/voice/recording", {
                    params: {
                        sid: sid
                    }
                })
                .then(response => {
                    if (response.data) {
                        this.re = response.data;
                        this.fetchRecording(this.re);
                        this.dialog = true;
                    } else {
                        this.dialog = true;
                        this.re = null;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },

        fetchRecording(re) {
            this.file =
                "https://api.twilio.com/2010-04-01/Accounts/ACd40df911a63cea4375b1a8166a443a5e/Recordings/" +
                re +
                ".mp3";
            console.log("file" + this.file);
        },

        call() {},

        close() {
            this.copyS = false;
            this.dialog = false;
            this.file = null;
        },
        closeCall() {
            this.dialogCall = false;
            this.phoneNumber = null;
        },
        showDialogCall() {
            this.token();
            this.dialogCall = true;
        },

        updateCallStatus(status) {
            this.callStatus = status;
        },

        callCustomer(phoneNumber) {
            updateCallStatus("Calling " + phoneNumber + "...");

            var params = { phoneNumber: phoneNumber };
            Twilio.Device.connect(params);
        },

        // /* Call the support_agent from the home page */
        callSupport() {
            updateCallStatus("Calling support...");

            // Our backend will assume that no params means a call to support_agent
            Twilio.Device.connect();
        },

        hangUp() {
            Twilio.Device.disconnectAll();
        },

        token() {
            axios
                .post("api/token")
                .then(response => {
                    Twilio.Device.setup(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },

    mounted() {
        this.getDataVoiceCall();
        console.log("Component mounted.");
    }
};
</script>
