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
                <div class="m-widget6">
                    <div class="m-widget6__head">
                        <div class="m-widget6__item">
                            <span class="m-widget6__caption">Campaign</span>
                            <span class="m-widget6__caption m--align-right">Action</span>
                        </div>
                    </div>
                    <div class="m-widget6__body">
                        <div v-if="campaigns.length" class="m-widget6__item" v-for="(campaign, index) in campaigns" v-bind:key="index">
                            <span class="m-widget6__text"><a href="#">{{campaign.name}}</a></span>
                            <span class="m-widget6__text m--align-right m--font-boldest m--font-brand"><button @click="editCampaign(campaign,index)" type="button" class="btn btn-sm btn-info mx-1"><i class="flaticon-edit"></i></button><button @click="deleteEvent(campaign,index)" type="button" class="btn btn-sm btn-danger mx-1"><i class="flaticon-delete-2"></i></button></span>
                        </div>
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
                            <input v-model="campaignModel" type="text" class="form-control" id="message-text"/>
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
export default {
    data () {
        return {
            isModalshown: false,
            isEdit: false,
            campaigns: [],
            campaignID: '',
            campaignIndex: '',
            campaignModel: ''
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
                            campaigns.push(response.data.data)
                            swal("Success!", "Campaign has been saved successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.data, "error")
                        })
                }
                else {
                    let index = this.campaignIndex
                    axios.put(`api/campaign/${campaignID}`, {
                        name: campaign,
                    })
                        .then(response => {
                            Vue.set(campaigns, index, response.data.data)
                            swal("Success!", "Campaign has been saved successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.data, "error")
                        })
                }
                this.empty()
            }
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
                            swal("Deleted!", "Campaign has been deleted.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.data, "error")
                        })
                }
                else {
                    "cancel" === e.dismiss
                }
            });
        },
        toggleModal() {
            this.isModalshown = !this.isModalshown
        },
        empty() {
            this.isEdit = false
            this.campaignID = ''
            this.campaignIndex = ''
            this.campaignModel = ''
        }
    },
    mounted () {
        axios.get('api/campaign')
            .then(response => {
                this.campaigns = response.data.data
            })
            .catch(err => {
                swal("Error!", err.data, "error")
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
#m_modal {
    display: block;
}
</style>