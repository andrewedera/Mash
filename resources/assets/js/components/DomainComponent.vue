<template>
    <div v-if="this.$root.isDomain && this.domains">
        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Campaign
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <button @click="toggleModal" type="button" class="btn btn-sm btn-danger m-btn"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="m-section">
					<div class="m-section__content">
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
							      	<td scope="row" class="m-widget6__text"><a href="#">{{domain.name}}</a></td>
							      	<td><span v-bind:class="[domain.is_active ? 'm-badge--success' : 'm-badge--warning']" class="m-badge m-badge--wide">{{ domain.is_used|domain.is_active|statusLabel }}</span></td>
							      	<td>
                                        <button type="button" class="btn btn-sm btn-info m-btn--icon m-btn--icon-only" title="Edit"><i class="flaticon-edit"></i></button>
                                    </td>
						    	</tr>
						  	</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</template>

<script>
var VueBus = require('vue-bus')
Vue.use(VueBus)

export default {
    data() {
        return {
            domains: []
        }
    },
    filters: {
        statusLabel: function(used,active) {
            if(!used && !active)
                return 'standby'
            else if(!used && active)
                return 'running'
            else if (used && !active)
                return 'already used'
        }
    },
    methods: {
        getDomain(id) {
            axios.get(`api/campaign/`+id+`/edit`)
            .then(response => {
                this.domains = response.data.data
            })
            .catch(err => {
                swal("Error!", err.data, "error")
            })
        },
        toggleModal() {
            this.domains = []
            this.$root.isDomain = false
        }
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