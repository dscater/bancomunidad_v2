<template>
    <div
        class="modal fade"
        :class="{ show: bModal }"
        id="modal-default"
        aria-modal="true"
        role="dialog"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="cierraModal"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <!-- <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.codigo,
                                    }"
                                    >Código* (Automatico)</label
                                >
                                <el-input
                                    placeholder="Código"
                                    :class="{ 'is-invalid': errors.codigo }"
                                    v-model="formulario.codigo"
                                    clearable
                                    readonly
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.codigo"
                                    v-text="errors.codigo[0]"
                                ></span>
                            </div> -->
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.fecha_solicitud,
                                    }"
                                    >Fecha de Solicitud</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.fecha_solicitud,
                                    }"
                                    v-model="formulario.fecha_solicitud"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.fecha_solicitud"
                                    v-text="errors.fecha_solicitud[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.fecha_respuesta,
                                    }"
                                    >Fecha de Respuesta</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.fecha_respuesta,
                                    }"
                                    v-model="formulario.fecha_respuesta"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.fecha_respuesta"
                                    v-text="errors.fecha_respuesta[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.hora_solicitud,
                                    }"
                                    >Hora de Solicitud</label
                                >
                                <input
                                    type="time"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.hora_solicitud,
                                    }"
                                    v-model="formulario.hora_solicitud"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.hora_solicitud"
                                    v-text="errors.hora_solicitud[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.hora_respuesta,
                                    }"
                                    >Hora de Respuesta</label
                                >
                                <input
                                    type="time"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.hora_respuesta,
                                    }"
                                    v-model="formulario.hora_respuesta"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.hora_respuesta"
                                    v-text="errors.hora_respuesta[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.funcionario_id,
                                    }"
                                    >Seleccionar Funcionario*</label
                                >
                                <el-select
                                    class="w-full"
                                    :class="{
                                        'is-invalid': errors.funcionario_id,
                                    }"
                                    v-model="formulario.funcionario_id"
                                    filterable
                                >
                                    <el-option
                                        v-for="item in listFuncionarios"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.full_name"
                                    ></el-option>
                                </el-select>

                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.funcionario_id"
                                    v-text="errors.funcionario_id[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.tipo_acceso,
                                    }"
                                    >Tipo de acceso*</label
                                >
                                <el-select
                                    class="w-full"
                                    :class="{
                                        'is-invalid': errors.tipo_acceso,
                                    }"
                                    v-model="formulario.tipo_acceso"
                                >
                                    <el-option
                                        v-for="item in [
                                            'ALTA DE ACCESO',
                                            'BAJA DE ACCESO',
                                            'CAMBIO DE AGENCIA',
                                        ]"
                                        :key="item"
                                        :value="item"
                                        :label="item"
                                    ></el-option>
                                </el-select>

                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.tipo_acceso"
                                    v-text="errors.tipo_acceso[0]"
                                ></span>
                            </div>
                            <div
                                class="form-group col-md-6"
                                v-if="
                                    formulario.tipo_acceso != '' &&
                                    formulario.tipo_acceso ==
                                        'CAMBIO DE AGENCIA'
                                "
                            >
                                <label
                                    :class="{
                                        'text-danger': errors.agencia_origen,
                                    }"
                                    >Agencia Origen*</label
                                >
                                <el-select
                                    class="w-full"
                                    :class="{
                                        'is-invalid': errors.agencia_origen,
                                    }"
                                    v-model="formulario.agencia_origen"
                                    filterable
                                >
                                    <el-option
                                        v-for="item in listAgencias"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    ></el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.agencia_origen"
                                    v-text="errors.agencia_origen[0]"
                                ></span>
                            </div>
                            <div
                                class="form-group col-md-6"
                                v-if="
                                    formulario.tipo_acceso != '' &&
                                    formulario.tipo_acceso ==
                                        'CAMBIO DE AGENCIA'
                                "
                            >
                                <label
                                    :class="{
                                        'text-danger': errors.agencia_destino,
                                    }"
                                    >Agencia Destino*</label
                                >
                                <el-select
                                    class="w-full"
                                    :class="{
                                        'is-invalid': errors.agencia_destino,
                                    }"
                                    v-model="formulario.agencia_destino"
                                    filterable
                                >
                                    <el-option
                                        v-for="item in listAgencias"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    ></el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.agencia_destino"
                                    v-text="errors.agencia_destino[0]"
                                ></span>
                            </div>

                            <div
                                class="form-group col-md-6"
                                v-if="
                                    (formulario.tipo_acceso != '' &&
                                        formulario.tipo_acceso ==
                                            'ALTA DE ACCESO') ||
                                    formulario.tipo_acceso == 'BAJA DE ACCESO'
                                "
                            >
                                <label
                                    :class="{
                                        'text-danger': errors.cargo_id,
                                    }"
                                    >Cargo*</label
                                >
                                <el-select
                                    class="w-100 d-block"
                                    :class="{
                                        'is-invalid': errors.cargo_id,
                                    }"
                                    v-model="formulario.cargo_id"
                                    clearable
                                    filterable
                                >
                                    <el-option
                                        v-for="item in listCargos"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    >
                                    </el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.cargo_id"
                                    v-text="errors.cargo_id[0]"
                                ></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal"
                        @click="cierraModal"
                    >
                        Cerrar
                    </button>
                    <el-button
                        type="primary"
                        class="bg-primary"
                        :loading="enviando"
                        @click="setRegistroModal()"
                        >{{ textoBoton }}</el-button
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        muestra_modal: {
            type: Boolean,
            default: false,
        },
        accion: {
            type: String,
            default: "nuevo",
        },
        formulario: {
            type: Object,
            default: {
                id: 0,
                codigo: "",
                fecha_solicitud: "",
                fecha_respuesta: "",
                hora_solicitud: "",
                hora_respuesta: "",
                funcionario_id: "",
                tipo_acceso: "",
                cargo_id: "",
                agencia_origen: "",
                agencia_destino: "",
            },
        },
    },
    watch: {
        muestra_modal: function (newVal, oldVal) {
            this.errors = [];
            if (newVal) {
                this.bModal = true;
            } else {
                this.bModal = false;
            }
        },
    },
    computed: {
        tituloModal() {
            if (this.accion == "nuevo") {
                return "AGREGAR REGISTRO";
            } else {
                return "MODIFICAR REGISTRO";
            }
        },
        textoBoton() {
            if (this.accion == "nuevo") {
                return "Registrar";
            } else {
                return "Actualizar";
            }
        },
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            bModal: this.muestra_modal,
            enviando: false,
            errors: [],
            listCargos: [],
            listAgencias: [],
            listFuncionarios: [],
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
        this.getCargos();
        this.getAgencias();
        this.getFuncionarios();
    },
    methods: {
        //get Cargos
        getCargos() {
            axios
                .get("/admin/cargos", {
                    params: { habilitados: 1 },
                })
                .then((response) => {
                    this.listCargos = response.data.cargos;
                });
        },
        //get Agencias
        getAgencias() {
            axios
                .get("/admin/agencias", {
                    params: { habilitados: 1 },
                })
                .then((response) => {
                    this.listAgencias = response.data.agencias;
                });
        },
        //get Agencias
        getFuncionarios() {
            axios
                .get("/admin/funcionarios", {
                    params: { habilitados: 1 },
                })
                .then((response) => {
                    this.listFuncionarios = response.data.funcionarios;
                });
        },
        // envia modal
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = "/admin/formularios";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "codigo",
                    this.formulario.codigo ? this.formulario.codigo : ""
                );
                formdata.append(
                    "fecha_solicitud",
                    this.formulario.fecha_solicitud
                        ? this.formulario.fecha_solicitud
                        : ""
                );
                formdata.append(
                    "fecha_respuesta",
                    this.formulario.fecha_respuesta
                        ? this.formulario.fecha_respuesta
                        : ""
                );
                formdata.append(
                    "hora_solicitud",
                    this.formulario.hora_solicitud
                        ? this.formulario.hora_solicitud
                        : ""
                );
                formdata.append(
                    "hora_respuesta",
                    this.formulario.hora_respuesta
                        ? this.formulario.hora_respuesta
                        : ""
                );
                formdata.append(
                    "funcionario_id",
                    this.formulario.funcionario_id
                        ? this.formulario.funcionario_id
                        : ""
                );
                formdata.append(
                    "tipo_acceso",
                    this.formulario.tipo_acceso
                        ? this.formulario.tipo_acceso
                        : ""
                );
                formdata.append(
                    "cargo_id",
                    this.formulario.cargo_id ? this.formulario.cargo_id : ""
                );
                formdata.append(
                    "agencia_origen",
                    this.formulario.agencia_origen
                        ? this.formulario.agencia_origen
                        : ""
                );
                formdata.append(
                    "agencia_destino",
                    this.formulario.agencia_destino
                        ? this.formulario.agencia_destino
                        : ""
                );

                if (this.accion == "edit") {
                    url = "/admin/formularios/" + this.formulario.id;
                    formdata.append("_method", "PUT");
                }
                axios
                    .post(url, formdata, config)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.msj,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.limpiaFormulario();
                        this.$emit("envioModal");
                        this.errors = [];
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
                        if (error.response) {
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors;
                            }
                        }
                    });
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaFormulario() {
            this.errors = [];
            this.formulario.codigo = "";
            this.formulario.fecha_solicitud = "";
            this.formulario.fecha_respuesta = "";
            this.formulario.hora_solicitud = "";
            this.formulario.hora_respuesta = "";
            this.formulario.funcionario_id = "";
            this.formulario.tipo_acceso = "";
            this.formulario.cargo_id = "";
            this.formulario.agencia_origen = "";
            this.formulario.agencia_destino = "";
        },
    },
};
</script>

<style></style>
