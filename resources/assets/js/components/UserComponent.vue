<template>
    <div>
        <div class="m-login__signin">
            <div class="m-login__head">
                <h3 class="m-login__title">Sign In To Admin</h3>
            </div>
            <form class="m-login__form m-form" action="">
                <div v-if="errors.length" class="form-control-feedback"><p v-for="errorLogin in errors" v-bind:key="errorLogin.id">{{ errorLogin }}</p></div>
                <div class="form-group m-form__group">
                    <input v-model="email" class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                </div>
                <div class="form-group m-form__group">
                    <input v-model="password" class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                </div>
                <div class="row m-login__form-sub">
                    <div class="col m--align-left m-login__form-left">
                        <label class="m-checkbox  m-checkbox--focus">
                            <input type="checkbox" name="remember">Remember me <span></span>
                        </label>
                    </div>
                    <div class="col m--align-right m-login__form-right"> <a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
                    </div>
                </div>
                <div class="m-login__form-action">
                    <button @click="login" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
                </div>
            </form>
        </div>
        <div class="m-login__signup">
            <div class="m-login__head">
                <h3 class="m-login__title">Sign Up</h3>
                <div class="m-login__desc">Enter your details to create your account:</div>
            </div>
            <form class="m-login__form m-form" action="">
                <div v-if="errors.length" class="form-control-feedback"><p v-for="errorRegister in errors" v-bind:key="errorRegister.id">{{ errorRegister }}</p></div>
                <div class="form-group m-form__group">
                    <input v-model="name" class="form-control m-input" type="text" placeholder="Name" name="name">
                </div>
                <div class="form-group m-form__group">
                    <input v-model="email" class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                </div>
                <div class="form-group m-form__group">
                    <input v-model="password" class="form-control m-input" type="password" placeholder="Password" name="password">
                </div>
                <div class="form-group m-form__group">
                    <input v-model="verifypw" class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                </div>
                <div class="row form-group m-form__group m-login__form-sub">
                    <div class="col m--align-left">
                        <label class="m-checkbox m-checkbox--focus">
                            <input v-model="agree" type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>. <span></span>
                        </label><span class="m-form__help"></span>
                    </div>
                </div>
                <div class="m-login__form-action">
                    <button @click="signup" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Sign Up</button>&nbsp;&nbsp;
                    <button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Cancel</button>
                </div>
            </form>
        </div>
        <div class="m-login__forget-password">
            <div class="m-login__head">
                <h3 class="m-login__title">Forgotten Password ?</h3>
                <div class="m-login__desc">Enter your email to reset your password:</div>
            </div>
            <form class="m-login__form m-form" action="">
                <div class="form-group m-form__group">
                    <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                </div>
                <div class="m-login__form-action">
                    <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Request</button>&nbsp;&nbsp;
                    <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
                </div>
            </form>
        </div>
        <div class="m-login__account"><span class="m-login__account-msg">Don't have an account yet ?</span>&nbsp;&nbsp; <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a></div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            data: '',
            name: '',
            email: '',
            password: '',
            verifypw: '',
            agree: false
        }
    },
    methods: {
        login: function(e) {
            this.clearError()
            if (!this.email) {
                this.errors.push('Email required.');
            } else if (!this.validEmail(this.email)) {
                this.errors.push('Valid email required.');
            }
            if(!this.password) {
                this.errors.push("Password required.");
            }
            e.preventDefault();
            if (!this.errors.length) {
                axios.post(`/login`, {
                    email: this.email,
                    password: this.password,
                })
                .then(response => {
                    this.data = response.data
                    window.location.href = '/'
                })
                .catch(err => {
                    this.errors.push(err.response.data.error);
                })
            }
        },
        signup: function(e) {
            this.clearError();
            if (!this.name) {
                this.errors.push("Name required.");
            }
            if (!this.email) {
                this.errors.push('Email required.');
            } else if (!this.validEmail(this.email)) {
                this.errors.push('Valid email required.');
            }
            if(!this.password || !this.verifypw) {
                this.errors.push("Password required.");
            }
            else if(this.password != this.verifypw) {
                this.errors.push("Password does not match the confirm password.");
            }
            e.preventDefault();
            if (!this.errors.length) {
                axios.post(`/register`, {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.verifypw
                })
                .then(response => {
                    window.location.href = '/'
                })
                .catch(err => {
                    this.errors.push(err.response.data.error);
                })
            }
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        clearError() {
            this.errors = [];
        }
    }
}
</script>

<style scoped>
.form-control-feedback {
    color: #f4516c;
}
</style>
