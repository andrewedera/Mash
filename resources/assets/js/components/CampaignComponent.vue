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
                    <button type="button" class="btn btn-brand m-btn" data-toggle="modal" data-target="#m_modal_5">New Campaign</button>
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
                        <div v-if="campaigns.length" class="m-widget6__item" v-for="campaign in campaigns" v-bind:key="campaign.id">					 
                            <span class="m-widget6__text"><a href="#">{{campaign.name}}</a></span>
                            <span class="m-widget6__text m--align-right m--font-boldest m--font-brand"><button type="button" class="btn btn-sm btn-danger"><i class="flaticon-delete-2"></i></button></span>					 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
        <!--begin::Modal-->
        <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">New Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click.prevent="submitCampaign" type="button" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->
    </div>
</template>

<script>
export default {
    data () {
        return {
            campaigns: [], 
            campaignModel: ''
        }
    },
    methods: {
        submitCampaign(){
           if(this.campaignModel) {
                axios.post(`campaign`, {
                    name: this.campaignModel,
                })
                .then(response => {
                    this.data = response.data,
                    console.log(this.data)
                })
                .catch(err => {
                    this.errors.push(err.response.data.errors)
                })
           }
        }
    },
    created () {
    axios.get('campaign')
        .then(response => {
            //console.log(response)
            this.campaigns = response.data.data
        })
        .catch(err => {
            console.log(err)
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
</style>