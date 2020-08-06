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
                v-model="option"
                solo
              ></v-select>
            </v-col>
          </v-col>

          <v-col cols="12" md="4" v-if="option == 'in date'">
            <v-menu
              ref="menuStart"
              v-model="menuStart"
              :close-on-content-click="false"
              :return-value.sync="searchData.startTime"
              transition="scale-transition"
              offset-y
              min-width="290px"
              dark
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="searchData.startTime"
                  label="Start Time"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="searchData.startTime" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menuStart = false">Cancel</v-btn>
                <v-btn text color="primary" @click="$refs.menuStart.save(searchData.startTime)">OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="4" v-if="option == 'after date'">
            <v-menu
              ref="menuStart"
              v-model="menuStart"
              :close-on-content-click="false"
              :return-value.sync="searchData.startTimeAfter"
              transition="scale-transition"
              offset-y
              min-width="290px"
              dark
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="searchData.startTimeAfter"
                  label="Start Time After"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="searchData.startTimeAfter" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menuStart = false">Cancel</v-btn>
                <v-btn
                  text
                  color="primary"
                  @click="$refs.menuStart.save(searchData.startTimeAfter)"
                >OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="4" v-if="option == 'before date'">
            <v-menu
              ref="menuStart"
              v-model="menuStart"
              :close-on-content-click="false"
              :return-value.sync="searchData.startTimeBefore"
              transition="scale-transition"
              offset-y
              min-width="290px"
              dark
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="searchData.startTimeBefore"
                  label="Start Time Before"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="searchData.startTimeBefore" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menuStart = false">Cancel</v-btn>
                <v-btn
                  text
                  color="primary"
                  @click="$refs.menuStart.save(searchData.startTimeBefore)"
                >OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="4" v-if="option == 'period'">
            <v-menu
              ref="menuEnd"
              v-model="menuEnd"
              :close-on-content-click="false"
              :return-value.sync="searchData.startTimeAfter"
              transition="scale-transition"
              offset-y
              min-width="290px"
              dark
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="searchData.startTimeAfter"
                  label="Start Time After"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="searchData.startTimeAfter" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menuEnd = false">Cancel</v-btn>
                <v-btn
                  text
                  color="primary"
                  @click="$refs.menuEnd.save(searchData.startTimeAfter)"
                >OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>
          <v-col cols="12" md="4" v-if="option == 'period'">
            <v-menu
              ref="menuStart"
              v-model="menuStart"
              :close-on-content-click="false"
              :return-value.sync="searchData.startTimeBefore"
              transition="scale-transition"
              offset-y
              min-width="290px"
              dark
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="searchData.startTimeBefore"
                  label="Start Time Before"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="searchData.startTimeBefore" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menuStart = false">Cancel</v-btn>
                <v-btn
                  text
                  color="primary"
                  @click="$refs.menuStart.save(searchData.startTimeBefore)"
                >OK</v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>

          <v-col cols="12" md="4">
            <v-text-field
              hide-details
              label="From"
              hint="From phone number"
              v-model="searchData.from"
            ></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field hide-details label="To" hint="To phone number" v-model="searchData.to"></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-col class="d-flex" cols="12">
              <v-select
                :items="status"
                label="Status"
                hint="Status of call event"
                solo
                v-model="searchData.status"
              ></v-select>
            </v-col>
          </v-col>

          <v-col cols="12" md="4">
            <div class="my-2">
              <v-btn color="#3490dc" @click="search" dark small>Search</v-btn>
            </div>
          </v-col>
        </v-row>
      </v-card-title>
      <div class="container">
        <v-data-table
          :headers="headers"
          :items="data"
          :loading="true"
          class="elevation-1"
          hide-default-footer
          item-key="name"
          :loading-text=" data.length == 0 ? 'No Data' : 'Loading... Please wait'"
        >
            <template v-slot:item.start_time="{ item }">{{item.start_time.date}}</template>
            <template v-slot:item.end_time="{ item }">{{item.end_time.date}}</template>
            <template v-slot:item.sid="{ item }">
                <v-btn icon @click="recording(item.sid)">
                    <v-icon>
                        mdi-play-circle-outline
                    </v-icon>
                </v-btn>
                <!-- {{item.sid}} -->
            </template>
        </v-data-table>
      </div>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      option: null,
      options: ["period", "after date", "in date","before date"],
      headers: [
        {
          text: "From",
          value: "from",
        },
        {
          text: "To",
          value: "to",
        },
        {
          text: "Duration",
          value: "duration",
        },
        {
          text: "Direction",
          value: "direction",
        },
        {
          text: "Status",
          value: "status",
        },
        {
          text: "Recording",
          value: "sid",
        },
        {
          text: "Start Time",
          value: "start_time",
        },
        {
          text: "End Time",
          value: "end_time",
        },
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
        "queued",
      ],
      data: [],
      searchData: {},
    };
  },

  methods: {
    getDataVoiceCall() {
      axios
        .get("api/twilio/voice", {
          params: this.searchData,
        })
        .then((response) => {
          this.data = response.data;
          console.log(this.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    search() {
      this.data = [];
      this.getDataVoiceCall();
    },

    recording(sid){
        axios
        .post("api/twilio/voice/recording", {
            sid: sid
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },

  mounted() {
    this.getDataVoiceCall();
    console.log("Component mounted.");
  },
};
</script>
