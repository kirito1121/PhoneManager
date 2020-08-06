<template>
  <div class="container">
    <v-card>
      <v-card-text>SMS Managerment</v-card-text>
      <v-card-title>
        <v-row justify="space-between">
          <v-col cols="12" md="4">
            <v-text-field hide-details label="From" single-line></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field hide-details label="To" single-line></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field hide-details label="Date" single-line></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field hide-details label="Status" single-line></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <div class="my-2">
              <v-btn color="#3490dc" dark small>Search</v-btn>
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
				loading-text="Loading... Please wait"
				show-expand
			>
			</v-data-table>
		</div>
    </v-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
        headers:[
            {
                text: 'From',
                value: 'from'
            },
            {
                text: 'To',
                value: 'to'
            },
            {
                text: 'Duration',
                value: 'duration'
            },
            {
                text: 'Direction',
                value: 'direction'
            },
            {
                text: 'Status',
                value: 'status'
            },
            {
                text: 'Sid',
                value: 'sid'
            },
            {
                text: 'Start Time',
                value: 'start_time'
            },
            {
                text: 'End Time',
                value: 'end_time'
            },
            {
                text: 'Action',
                value: ''
            },
        ],
        data:[{}]
    };
  },

  mounted() {
    console.log("Component mounted.");
  },
};
</script>
