<template>
	<div class="container">
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
							<v-date-picker no-title scrollable v-model="searchData.dateSent">
								<v-spacer></v-spacer>
								<v-btn @click="menuStart = false" color="primary" text>Cancel</v-btn>
								<v-btn
									@click="
                                        $refs.menuStart.save(
                                            searchData.dateSent
                                        )
                                    "
									color="primary"
									text
								>OK</v-btn>
							</v-date-picker>
						</v-menu>
					</v-col>

					<v-col cols="12" md="4">
						<v-text-field hide-details hint="From phone number" label="From" v-model="searchData.from"></v-text-field>
					</v-col>
					<v-col cols="12" md="4">
						<v-text-field hide-details hint="To phone number" label="To" v-model="searchData.to"></v-text-field>
					</v-col>
					<v-col cols="12" md="4">
						<div class="my-2">
							<v-btn @click="search" color="#3490dc" dark small>Search</v-btn>
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
					<template
						v-slot:item.date_sent="{ item }"
					>{{item.date_sent.date}} {{ item.date_sent.timezone }}</template>
				</v-data-table>
			</div>
		</v-card>
	</div>
</template>
<script>
export default {
  data() {
    return {
      headers: [
        {
          text: 'From',
          value: 'from',
        },
        {
          text: 'To',
          value: 'to',
        },
        {
          text: 'body',
          value: 'body',
        },
        {
          text: 'Direction',
          value: 'direction',
        },
        {
          text: 'Status',
          value: 'status',
        },
        {
          text: 'Sid',
          value: 'sid',
        },
        {
          text: 'Date Sent',
          value: 'date_sent',
        },
      ],
      menuStart: false,
      modal: false,
      data: [],
      searchData: {},
    }
  },

  methods: {
    getDataSMS() {
      axios
        .get('api/twilio/sms', {
          params: this.searchData,
        })
        .then((response) => {
          this.data = response.data
          console.log(this.data)
        })
        .catch((error) => {
          console.log(error)
        })
    },

    search() {
      this.data = []
      this.getDataSMS()
    },

    recording(sid) {
      axios
        .get('api/twilio/voice/recording', {
          sid: sid,
        })
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },

  mounted() {
    this.getDataSMS()
    console.log('Component mounted.')
  },
}
</script>
