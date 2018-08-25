<template>
    <div v-if="this.$root.isDomain && this.domains">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Campaign  <strong class="campaign">{{ this.campaign }}</strong></h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <button @click="toggleModal" type="button" class="btn btn-sm btn-danger m-btn"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
					<div class="m-section__content">
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1">Domains</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#m_tabs_2">Server</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_tabs_1" role="tabpanel">
                                <button @click="toggleDomainModal" type="button" class="btn btn-brand m-btn mb-3">Add Domain</button>
                                <table class="table table-striped m-table text-center">
                                    <thead>
                                        <tr>
                                            <th>Domain Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="domains.length" v-for="(domain, index) in domains" v-bind:key="index">
                                            <td scope="row" class="m-widget6__text"><a @click.prevent href="#">{{domain.name}}</a></td>
                                            <td><span v-bind:class="[!domain.is_used && !domain.is_active ? 'm-badge--warning' : domain.is_active && !domain.is_used ? 'm-badge--success' : 'm-badge--metal']" class="m-badge m-badge--wide">{{ domain.is_used | statusLabel(domain.is_active) }}</span></td>
                                            <td>
                                                <button @click.prevent="editDomain(domain,index)" type="button" class="btn btn-sm btn-info m-btn--icon m-btn--icon-only" title="Edit"><i class="flaticon-edit"></i></button>
                                                <button @click.prevent="updateStatus(domain,index)" v-if="!domain.is_active && !domain.is_used" class="btn btn-sm btn-success m-btn--icon m-btn--icon-only" title="Play"><i class="la la-play"></i></button>
                                                <button @click.prevent="updateStatus(domain,index)" v-else-if="domain.is_active && !domain.is_used" class="btn btn-sm btn-warning m-btn--icon m-btn--icon-only" title="Pause"><i class="la la-pause"></i></button>
                                                <button @click.prevent="deleteDomain(domain,index)" type="button" class="btn btn-sm btn-danger m-btn--icon m-btn--icon-only" title="Remove"><i class="flaticon-delete-2"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="m_tabs_2" role="tabpanel">
                                <div class="form-group m-form__group row">
                                    <p class="col-2 col-form-label text-center"><strong>Name</strong></p>
                                    <div class="col-10">
                                        <p class="col-form-label">{{ this.serverName }}</p>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <p class="col-2 col-form-label text-center"><strong>Host</strong></p>
                                    <div class="col-10">
                                        <p class="col-form-label">{{ this.serverHost }}</p>
                                    </div>
                                </div>

                                <div class="form-group m-form__group">
                                    <label for="serverName">Server Name</label>
                                    <input v-model="serverName" type="text" class="form-control m-input m-input--solid" id="serverName">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="serverHost">Server Type</label>
                                    <input v-model="serverType" type="text" class="form-control m-input m-input--solid" id="serverType">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="serverHost">Host</label>
                                    <input v-model="serverHost" type="text" class="form-control m-input m-input--solid" id="serverHost">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="serverHost">Username</label>
                                    <input v-model="serverUsername" type="text" class="form-control m-input m-input--solid" id="serverUsername">
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="serverPassword">Password</label>
                                    <input v-model="serverPassword" type="password" class="form-control m-input m-input--solid" id="serverPassword">
                                </div>
                                <div class="m-form__actions text-right">
                                    <button @click.prevent="submitServer" type="button" class="btn btn-accent">Save</button>
                                </div>
                            </div>
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
                    <h5 v-if="!isEdit" class="modal-title" id="ModalLabel">New Domain</h5>
                    <h5 v-else class="modal-title" id="ModalLabel">Edit Domain</h5>
                    <button type="button" class="close" @click="toggleDomainModal() + empty()" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Enter Domain</label>
                            <input v-model="domainModel" type="text" class="form-control" ref="domain"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="toggleDomainModal() + empty()">Close</button>
                    <button v-if="!isEdit" @click.prevent="submitDomain() + toggleDomainModal()" type="button" class="btn btn-primary">Submit</button>
                    <button v-else @click.prevent="submitDomain() + toggleDomainModal()" type="button" class="btn btn-primary">Update</button>
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
    data() {
        return {
            campaign: '',
            domainModel: '',
            domainID: '',
            domainIndex: '',
            campaignID: '',
            isModalshown: false,
            isEdit: false,
            domains: [],
            serverName: '',
            serverType: '',
            serverHost: '',
            serverUsername: '',
            serverPassword: ''
        }
    },
    filters: {
        statusLabel: function(used,active) {
            if(!used && !active)
                return 'standby'
            else if(!used && active)
                return 'running'
            else
                return 'already used'
        }
    },
    methods: {
        getDomain(id) {
            axios.get(`api/campaign/`+id+`/edit`)
            .then(response => {
                this.domains = response.data.data
                this.campaignID = response.data.campaign_id
                this.campaign = response.data.campaign
                this.serverName = ''
                this.serverType = ''
                this.serverHost = ''
                this.serverUsername = ''
                this.serverPassword = ''
                if(response.data.server) {
                    this.serverName = response.data.server.name
                    this.serverType = response.data.server.server_type
                    this.serverHost = response.data.server.server_ip
                    this.serverUsername = response.data.server.server_username
                    this.serverPassword = response.data.server.server_password
                }
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
        },
        submitDomain(){
            if(this.domainModel) {
                let domains = this.domains
                let campaign_id = this.campaignID
                let domain = this.domainModel
                let domainID = this.domainID
                let edit = this.isEdit
                if(!edit){
                    axios.post(`api/domain`, {
                        name: domain,
                        campaign_id: campaign_id,
                    })
                        .then(response => {
                            domains.push(response.data.data)
                            swal("Success!", "Domain has been saved successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.response.data.errors, "error")
                        })
                }
                else {
                    let index = this.domainIndex
                    axios.put(`api/domain/${domainID}`, {
                        name: domain,
                    })
                        .then(response => {
                            Vue.set(domains, index, response.data.data)
                            swal("Success!", "Domain has been updated successfully.", "success")
                        })
                        .catch(err => {
                            swal("Error!", err.response.data.data, "error")
                        })
                }
                this.empty()
            }
        },
        deleteDomain(domain, index) {
            let domains = this.domains;
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
                    axios.delete(`api/domain/${domain.id}`)
                        .then(response => {
                            Vue.delete( domains, index )
                            swal("Deleted!", "Domain has been deleted successfully..", "success")
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
        editDomain(domain, index) {
            this.toggleDomainModal()
            this.isEdit = true
            this.domainID = domain.id
            this.domainModel = domain.name
            this.domainIndex = index
        },
        updateStatus(campaign, index) {
            axios.put(`api/domain/${campaign.id}`, {
                toggleStatus: true,
            })
                .then(response => {
                    Vue.set(this.domains, index, response.data.data)
                })
                .catch(err => {
                    console.log(err.response)
                    swal("Error!", err.response.data.data, "error")
                })
        },
        submitServer(){
            if(this.serverName && this.serverHost && this.serverType && this.serverPassword) {
                let campaign_id = this.campaignID
                let serverName = this.serverName
                let serverType = this.serverType
                let serverHost = this.serverHost
                let serverUsername = this.serverUsername
                let serverPassword = this.serverPassword
                axios.post(`api/server`, {
                    campaign_id: campaign_id,
                    name: serverName,
                    server_ip: serverHost,
                    server_password: serverPassword,
                    server_type: serverType,
                    server_username: serverUsername,
                })
                    .then(response => {
                        swal("Success!", "Server has been saved successfully.", "success")
                    })
                    .catch(err => {
                        swal("Error!", err.response.data.errors, "error")
                    })
            }
        },
        toggleDomainModal() {
            this.isModalshown = !this.isModalshown
            this.$nextTick(() => this.$refs.domain.focus())
        },
        toggleModal() {
            this.domains = []
            this.$root.isDomain = false
        },
        empty() {
            this.isEdit = false
            this.domainModel = ''
            this.domainID = ''
            this.domainIndex = ''
            this.campaign = ''
            this.campaignID = ''
        },
    },
    created() {
        let self = this
        this.$bus.$on('domain-campaign', function(id) {
            self.getDomain(id)
        })
    },
    beforeDestroy() {
        this.$bus.$off('domain-campaign')
    }
}
</script>

<style scoped>
.m-widget6__text {
    vertical-align: middle!important;
    font-weight: 400;
}
.table th,
.table td {
    vertical-align: middle;
}
#m_modal {
    display: block;
}
.campaign {
    margin-left: 1rem;
    font-size: 1.75rem;
}
</style>