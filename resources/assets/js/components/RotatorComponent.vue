<template>
    <!--begin::Portlet-->
    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">Rotator Settings</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="m-section">
                <div class="m-section__content">
                    <div class="m-form__section m-form__section--first">
						<div class="m-form__group form-group row">
							<label class="col-lg-3 col-form-label">Auto Rotate?</label>
							<div class="col-lg-6">
								<div class="m-checkbox-inline mt-0">
									<label class="m-checkbox"><input v-model="isRotate" type="checkbox"><span></span></label>
			                    </div>
		                   </div>
		                </div>
                        <div class="form-group m-form__group row">
							<label class="col-lg-3 col-form-label">Minutes before rotate</label>
							<div class="col-lg-2">
								<input v-model="rotateMinute" type="text" class="form-control m-input">
							</div>
						</div>
                        <div class="m-form__actions m-form__actions mt-5">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                    <button @click.prevent="editRotator" type="button" class="btn btn-success">Save</button>
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
            isRotate: false,
            rotateMinute: ''
        }
    },
    methods: {
        editRotator() {
            let content = {
                data: [
                    {
                        setting_name: 'setting_isRotate',
                        setting_value: this.isRotate
                    },
                    {
                        setting_name: 'setting_rotateMinute',
                        setting_value: this.rotateMinute
                    }
                ]
            }
            axios.put(`api/rotator`, content)
            .then(response => {
                swal("Success!", "Settings has been saved successfully.", "success")
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
        }
    },
    mounted () {
        axios.get(`api/rotator`)
            .then(response => {
                this.isRotate = response.data.isRotate.setting_value
                this.rotateMinute = response.data.rotateMinute.setting_value
            })
            .catch(err => {
                swal("Error!", err.response.data.data, "error")
            })
    }
}
</script>