<template>
    <!--begin::Portlet-->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">3rd party keys</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-section">
                <div class="m-section__content">
                    <div class="m-form__section m-form__section--first">
                        <div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label text-center font-weight-bold">DO</label>
							<div class="col-lg-6">
								<input v-model="do_key" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label text-center font-weight-bold">VU</label>
							<div class="col-lg-6">
								<input v-model="vu_key" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label text-center font-weight-bold">RC</label>
							<div class="col-lg-6">
								<input v-model="rc_key" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label text-center font-weight-bold">NC</label>
							<div class="col-lg-6">
								<input v-model="nc_key" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-lg-2 col-form-label text-center font-weight-bold">FN</label>
							<div class="col-lg-6">
								<input v-model="fn_key" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="m-form__actions m-form__actions mt-5">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button @click.prevent="editKeys" type="button" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
		            </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Portlet-->
</template>

<script>
export default {
    data() {
        return {
            do_key: '',
            fn_key: '',
            nc_key: '',
            rc_key: '',
            vu_key: '',
        }
    },
    methods: {
        editKeys() {
            let content = {
                data: [
                    {
                        setting_name: 'setting_do_key',
                        setting_value: this.do_key
                    },
                    {
                        setting_name: 'setting_fn_key',
                        setting_value: this.fn_key
                    },
                    {
                        setting_name: 'setting_nc_key',
                        setting_value: this.nc_key
                    },
                    {
                        setting_name: 'setting_rc_key',
                        setting_value: this.rc_key
                    },
                    {
                        setting_name: 'setting_vu_key',
                        setting_value: this.vu_key
                    }
                ]
            }
            axios.put(`api/keys`, content)
            .then(response => {
                swal("Success!", "Settings has been saved successfully.", "success")
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
        }
    },
    mounted () {
        axios.get(`api/keys`)
            .then(response => {
                this.do_key = response.data.do_key.setting_value
                this.fn_key = response.data.fn_key.setting_value
                this.nc_key = response.data.nc_key.setting_value
                this.rc_key = response.data.rc_key.setting_value
                this.vu_key = response.data.vu_key.setting_value
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
    }
}
</script>