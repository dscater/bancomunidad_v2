<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-success elevation-4 bg-primary">
        <!-- Brand Logo -->
        <router-link
            exact
            :to="{ name: 'inicio' }"
            class="brand-link bg-success"
        >
            <div class="font-weight-light w-full text-center">
                BAN<strong>COMUNIDAD</strong>
            </div>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <h3
                    class="text-white text-center font-weight-bold text-lg w-full p-0 m-0"
                >
                    MENÚ
                </h3>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input
                        class="form-control form-control-sidebar bg-white"
                        type="search"
                        placeholder="Buscar Modulo"
                        aria-label="Search"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-sidebar bg-white">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column text-xs nav-flat"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link
                            exact
                            :to="{ name: 'inicio' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header"
                        v-if="
                            permisos.includes('funcionarios.index') ||
                            permisos.includes('agencias.index') ||
                            permisos.includes('regionals.index') ||
                            permisos.includes('cargos.index') ||
                            (permisos.includes('sistemas.index') &&
                                user.tipo != 'SISTEMAS') ||
                            permisos.includes('formularios.index') ||
                            permisos.includes('controls.index')
                        "
                    >
                        ADMINISTRACIÓN
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('funcionarios.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'funcionarios.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Funcionarios</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('agencias.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'agencias.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Agencias</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('regionals.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'regionals.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Regional</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('cargos.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'cargos.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Cargos</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes('sistemas.index') &&
                            user.tipo != 'SISTEMAS'
                        "
                    >
                        <router-link
                            exact
                            :to="{ name: 'sistemas.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Sistemas</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('formularios.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'formularios.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon far fa-clipboard"></i>
                            <p>Formulario FSI-08</p>
                        </router-link>
                    </li>

                    <li
                        class="nav-item"
                        v-if="permisos.includes('controls.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'controls.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Control</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('formulario.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'formulario.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Formulario</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header"
                        v-if="
                            permisos.includes('asignacions.index') ||
                            (permisos.includes('perfil_sistemas.index') &&
                                user.tipo != 'SISTEMAS') ||
                            permisos.includes('acceso_sistemas.index')
                        "
                    >
                        ACCESOS
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('perfil_sistemas.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'perfil_sistemas.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>Creación</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('asignacions.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'asignacions.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-check-square"></i>
                            <p>Asignación</p>
                        </router-link>
                    </li>

                    <li
                        class="nav-item"
                        v-if="permisos.includes('acceso_sistemas.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'acceso_sistemas.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Acceso a Sistema</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header"
                        v-if="
                            permisos.includes('reportes.funcionario_sistemas')
                        "
                    >
                        REPORTES
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes('reportes.funcionario_sistemas')
                        "
                    >
                        <router-link
                            :to="{ name: 'reportes.funcionario_sistemas' }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Reporte</p>
                        </router-link>
                    </li>
                    <li class="nav-header">OTROS</li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link"
                            @click.prevent="logout()"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="fas fa-power-off nav-icon"></i>
                            <p>Salir</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            fullscreenLoading: false,
            permisos: localStorage.getItem("permisos"),
        };
    },
    methods: {
        logout() {
            this.fullscreenLoading = true;
            axios.post("/logout").then((res) => {
                setTimeout(function () {
                    localStorage.clear();
                    location.reload();
                    this.$router.push({ name: "login" });
                }, 500);
            });
        },
    },
};
</script>

<style>
.user-panel .info {
    display: flex;
    height: 100%;
    align-items: center;
}
.user-panel .info a {
    font-size: 0.8em;
}
</style>
