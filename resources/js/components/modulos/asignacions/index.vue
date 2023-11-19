<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Asignación</h1>
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input
                                                    type="text"
                                                    class="form-control mb-1"
                                                    placeholder="C.I."
                                                    v-model="filter_ci"
                                                    @keyup="buscaFuncionario"
                                                />
                                            </div>
                                            <div class="col-md-12">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="nombre_funcionario"
                                                    readonly
                                                />
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <el-select
                                                    placeholder="Funcionario"
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
                                            </div> -->
                                        </div>
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
                                            @change="getPerfiles"
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
                                        <h4>Perfiles - Accesos</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead class="bg-primary">
                                                <th>Perfil</th>
                                                <th>Acceso</th>
                                            </thead>
                                            <tbody>
                                                <Acceso
                                                    v-for="(
                                                        perfil_sistema, index
                                                    ) in listPerfilSistema"
                                                    :key="index"
                                                    :sistema_id="sistema_id"
                                                    :perfil_sistema="
                                                        perfil_sistema
                                                    "
                                                    :funcionario_id="
                                                        funcionario_id
                                                    "
                                                ></Acceso>
                                            </tbody>
                                        </table>
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
import Acceso from "./Acceso.vue";
export default {
    components: { Acceso },
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            listFuncionarios: [],
            listSistemas: [],
            funcionario_id: "",
            nombre_funcionario: "",
            cargo: "",
            sistema_id: "",
            listPerfilSistema: [],
            filter_ci: "",
        };
    },
    mounted() {
        this.getFuncionarios();
        this.getSistemas();
        this.loadingWindow.close();
    },
    methods: {
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
                this.filter_ci = this.listFuncionarios.filter(
                    (item) => item.id == this.funcionario_id
                )[0].ci;
            } else {
                this.cargo = "";
            }
        },
        getSistemas() {
            axios.get("/admin/sistemas").then((response) => {
                this.listSistemas = response.data.sistemas;
            });
        },
        getPerfiles() {
            if (this.sistema_id != "") {
                axios
                    .get("/admin/sistemas/getPerfiles/" + this.sistema_id)
                    .then((response) => {
                        this.listPerfilSistema = response.data;
                    });
            } else {
                this.listPerfilSistema = [];
            }
        },
        buscaFuncionario() {
            if (this.filter_ci.trim() != "") {
                let existe = this.listFuncionarios.filter(
                    (item) => item.ci == this.filter_ci
                );
                if (existe.length > 0) {
                    this.funcionario_id = existe[0].id;
                    this.nombre_funcionario = existe[0].full_name;
                    this.cargo = existe[0].cargo.nombre;
                } else {
                    this.funcionario_id = "";
                    this.nombre_funcionario = "";
                    this.cargo = "";
                }
            } else {
                this.funcionario_id = "";
                this.nombre_funcionario = "";
                this.cargo = "";
            }
        },
    },
};
</script>

<style></style>
