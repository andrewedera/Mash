<template>
    <div>
        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Campaigns
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <button @click="toggleModal" type="button" class="btn btn-brand m-btn">New Campaign</button>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
					<div class="m-section__content">
						<table class="table table-striped m-table text-center">
						  	<thead>
						    	<tr>
						      		<th>Campaign</th>
						      		<th>Domains</th>
						      		<th>Status</th>
						      		<th>Action</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						    	<tr v-if="campaigns.length" v-for="(campaign, index) in campaigns" v-bind:key="index">
							      	<td scope="row" class="m-widget6__text"><a @click.prevent="toggleDomain(campaign)" href="#">{{campaign.name}}</a></td>
							      	<td>{{campaign.domains_count}}</td>
							      	<td><span v-bind:class="[campaign.is_active ? 'm-badge--success' : 'm-badge--warning']" class="m-badge m-badge--wide">{{campaign.is_active | statusLabel}}</span></td>
							      	<td>
                                        <button @click.prevent="editCampaign(campaign,index)" type="button" class="btn btn-sm btn-info m-btn--icon m-btn--icon-only" title="Edit"><i class="flaticon-edit"></i></button>
                                        <button @click.prevent="updateStatus(campaign,index)" v-if="!campaign.is_active" class="btn btn-sm btn-success m-btn--icon m-btn--icon-only" title="Play"><i class="la la-play"></i></button>
                                        <button @click.prevent="updateStatus(campaign,index)" v-else class="btn btn-sm btn-warning m-btn--icon m-btn--icon-only" title="Pause"><i class="la la-pause"></i></button>
                                        <button @click.prevent="deleteEvent(campaign,index)" type="button" class="btn btn-sm btn-danger m-btn--icon m-btn--icon-only" title="Remove"><i class="flaticon-delete-2"></i></button>
                                    </td>
						    	</tr>
						  	</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
        <!--end::Portlet-->
        <!--begin::Modal-->
        <div v-show="isModalshown" class="modal fade show" id="m_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="!isEdit" class="modal-title" id="ModalLabel">New Campaign</h5>
                    <h5 v-else class="modal-title" id="ModalLabel">Edit Campaign</h5>
                    <button type="button" class="close" @click="toggleModal() + empty()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Enter Campaign name</label>
                            <input v-model="campaignModel" type="text" class="form-control" ref="campaign"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="toggleModal() + empty()">Close</button>
                    <button v-if="!isEdit" @click.prevent="submitCampaign() + toggleModal()" type="button" class="btn btn-primary">Submit</button>
                    <button v-else @click.prevent="submitCampaign() + toggleModal()" type="button" class="btn btn-primary">Update</button>
                </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
        <div v-if="isModalshown" class="modal-backdrop fade show"></div>
    </div>
</template>

<script>
var VueBus = require('vue-bus')
Vue.use(VueBus)

export default {
    data () {
        return {
            isModalshown: false,
            isEdit: false,
            isActive: false,
            campaigns: [],
            campaignID: '',
            campaignIndex: '',
            campaignModel: ''
        }
    },
    filters: {
        statusLabel: function(value) {
            if(value)
                return 'active'
            else
                return 'paused'
        }
    },
    methods: {
        submitCampaign(){
            if(this.campaignModel) {
                let campaigns = this.campaigns
                let campaign = this.$options.filters.uppercase(this.campaignModel)
                let campaignID = this.campaignID
                let edit = this.isEdit
                if(!edit){
                    axios.post(`api/campaign`, {
                        name: campaign,
                    })
                        .then(response => {
                            this.campaigns = response.data.data
                            swal("Success!", "Campaign has been saved successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.response.data.data, "error")
                        })
                }
                else {
                    let index = this.campaignIndex
                    axios.put(`api/campaign/${campaignID}`, {
                        name: campaign,
                    })
                        .then(response => {
                            Vue.set(campaigns, index, response.data.data)
                            swal("Success!", "Campaign has been updated successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.response.data.data, "error")
                        })
                }
                this.empty()
            }
        },
        updateStatus(campaign, index) {
            axios.put(`api/campaign/${campaign.id}`, {
                toggleStatus: true,
            })
                .then(response => {
                    Vue.set(this.campaigns, index, response.data.data)
                })
                .catch(err => {
                    swal("Error!", err.response.data.data, "error")
                })
        },
        editCampaign(campaign, index) {
            this.toggleModal()
            this.isEdit = true
            this.campaignID = campaign.id
            this.campaignModel = campaign.name
            this.campaignIndex = index
        },
        deleteEvent(campaign, index) {
            let campaigns = this.campaigns;
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#d33",
                reverseButtons: !0
            }).then(function(e) {
                if(e.value) {
                    axios.delete(`api/campaign/${campaign.id}`)
                        .then(response => {
                            Vue.delete( campaigns, index )
                            swal("Deleted!", "Campaign has been deleted successfully..", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.response.data.data, "error")
                        })
                }
                else {
                    "cancel" === e.dismiss
                }
            });
        },
        toggleModal() {
            this.isModalshown = !this.isModalshown
            this.$nextTick(() => this.$refs.campaign.focus())
        },
        empty() {
            this.isEdit = false
            this.campaignID = ''
            this.campaignIndex = ''
            this.campaignModel = ''
        },
        toggleDomain(campaign) {
            if(!this.$root.isDomain) this.$root.isDomain = true
            this.$bus.$emit('domain-campaign', campaign.id)
        }
    },
    mounted () {
        axios.get('api/campaign')
            .then(response => {
                this.campaigns = response.data.data
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
    }
}
</script>

<style scoped>
.m-widget6__text {
    vertical-align: middle!important;
    font-size: 1.25rem!important;
    font-weight: 600;
}
.table th,
.table td {
    vertical-align: middle;
}
#m_modal {
    display: block;
}
</style>