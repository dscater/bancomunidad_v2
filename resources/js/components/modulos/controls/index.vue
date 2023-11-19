<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Administrar Control</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Funcionario y Sistema</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Funcionario</label>
                                        <el-select
                                            v-model="funcionario_id"
                                            class="d-block"
                                            filterable
                                            @change="getCargo"
                                        >
                                            <el-option
                                                v-for="item in listFuncionarios"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.full_name"
                                            >
                                            </el-option>
                                        </el-select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Cargo</label>
                                        <el-input
                                            v-model="cargo"
                                            class="d-block"
                                            readonly
                                        >
                                        </el-input>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Sistema</label>
                                        <el-select
                                            v-model="sistema_id"
                                            class="d-block"
                                            filterable
                                            @change="getEstado()"
                                        >
                                            <el-option
                                                v-for="item in listSistemas"
                                                :key="item.id"
                                                :value="item.id"
                                                :label="item.nombre"
                                            >
                                            </el-option>
                                        </el-select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Estado</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <strong>Estado:</strong>
                                        <span
                                            v-text="oEstado.estado"
                                            class="badge"
                                            :class="{
                                                'badge-success':
                                                    oEstado.estado ==
                                                        'CORRECTO' &&
                                                    oEstado.total_perfiles > 0,
                                                'badge-danger':
                                                    oEstado.estado ==
                                                    'PENDIENTE',
                                            }"
                                        ></span>
                                    </div>
                                    <div class="col-md-8">
                                        <strong>Accesos:</strong>
                                        <span
                                            v-text="
                                                oEstado.asignaciones_funcionario
                                            "
                                        ></span>
                                        -
                                        <span
                                            v-text="oEstado.total_perfiles"
                                        ></span>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-12">
                                        <ol>
                                            <li
                                                v-for="(
                                                    perfil, index
                                                ) in listPerfilSistema"
                                                :key="index"
                                                :class="{
                                                    'text-success':
                                                        perfil.check,
                                                    'text-danger':
                                                        !perfil.check,
                                                }"
                                            >
                                                {{ perfil.perfil.nombre }}
                                                <i
                                                    class="fa"
                                                    :class="{
                                                        'fa-check':
                                                            perfil.check,
                                                        'fa-times':
                                                            !perfil.check,
                                                    }"
                                                ></i>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            listFuncionarios: [],
            listSistemas: [],
            funcionario_id: "",
            cargo: "",
            sistema_id: "",
            listPerfilSistema: [],
            oEstado: {
                estado: "",
                total_perfiles: "",
                asignaciones_funcionario: "",
            },
        };
    },
    mounted() {
        this.getFuncionarios();
        this.getSistemas();
        this.loadingWindow.close();
    },
    methods: {
        // getPerfiles() {
        //     if (this.sistema_id != "") {
        //         axios
        //             .get("/admin/sistemas/getPerfiles/" + this.sistema_id)
        //             .then((response) => {
        //                 this.listPerfilSistema = response.data;
        //             });
        //     } else {
        //         this.listPerfilSistema = [];
        //     }
        // },
        getFuncionarios() {
            axios.get("/admin/funcionarios").then((response) => {
                this.listFuncionarios = response.data.funcionarios;
            });
        },
        getCargo() {
            if (this.funcionario_id != "") {
                this.cargo = this.listFuncionarios.filter(
                    (item) => item.id == this.funcionario_id
                )[0].cargo.nombre;
                this.getEstado();
            } else {
                this.cargo = "";
            }
        },
        getSistemas() {
            axios.get("/admin/sistemas").then((response) => {
                this.listSistemas = response.data.sistemas;
                this.getEstado();
            });
        },
        getEstado() {
            if (this.sistema_id != "" && this.funcionario_id != "") {
                axios
                    .get("/admin/asignacions/getEstadoAsignacion", {
                        params: {
                            sistema_id: this.sistema_id,
                            funcionario_id: this.funcionario_id,
                        },
                    })
                    .then((response) => {
                        this.oEstado.estado = response.data.estado;
                        this.oEstado.total_perfiles =
                            response.data.total_perfiles;
                        this.oEstado.asignaciones_funcionario =
                            response.data.asignaciones_funcionario;
                        this.listPerfilSistema = response.data.array_perfiles;
                    });
            } else {
                this.oEstado.total_perfiles = "";
                this.oEstado.asignaciones_funcionario = "";
            }
        },
    },
};
</script>

<style></style>
