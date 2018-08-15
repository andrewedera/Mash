<template>
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
		<li class="m-menu__item "><a href="/" class="m-menu__link "><i class="m-menu__link-icon flaticon-home"></i><span class="m-menu__link-text">Dashboard</span></a></li>
		<li class="m-menu__section ">
			<h4 class="m-menu__section-text">Menu</h4>
			<i class="m-menu__section-icon flaticon-more-v2"></i>
		</li>
		<li class="m-menu__item"><a href="/campaigns" class="m-menu__link"><i class="m-menu__link-icon flaticon-analytics"></i><span class="m-menu__link-text">Campaigns</span></a></li>
		<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-settings-1"></i><span class="m-menu__link-text">Settings</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
			<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
				<ul class="m-menu__subnav">
					<li class="m-menu__item " aria-haspopup="true"><a href="../../components/icons/flaticon.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Rotator</span></a>
					</li>
					<li class="m-menu__item " aria-haspopup="true"><a href="../../components/icons/fontawesome5.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Keys</span></a>
					</li>
				</ul>
			</div>
		</li>
		<li class="m-menu__item"><a @click.prevent="logout" href="/logout" class="m-menu__link"><i class="m-menu__link-icon flaticon-logout"></i><span class="m-menu__link-text">Logout</span></a></li>
		</ul>
	</div>
</template>

<script>
    export default {
        methods: {
			logout() {
				axios.post(`/logout`)
                .then(response => {
                    this.data = response.data
                    console.log(this.data)
                })
                .catch(err => {
					console.log(err.response.data.errors)
                    //this.errors.push(err.response.data.errors);
                })
			}
		}
    }
</script>
