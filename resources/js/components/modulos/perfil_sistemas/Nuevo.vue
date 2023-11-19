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
                            <div class="form-group col-md-12">
                                <label
                                    :class="{
                                        'text-danger': errors.sistema_id,
                                    }"
                                    >Sistema*</label
                                >
                                <el-select
                                    class="w-100 d-block"
                                    :class="{
                                        'is-invalid': errors.sistema_id,
                                    }"
                                    v-model="perfil_sistema.sistema_id"
                                    clearable
                                    @change="getOpcionesSistema"
                                >
                                    <el-option
                                        v-for="item in listSistemas"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    >
                                    </el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.sistema_id"
                                    v-text="errors.sistema_id[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-12">
                                <label
                                    :class="{
                                        'text-danger': errors.perfil_id,
                                    }"
                                    >Nombre Perfil*</label
                                >
                                <div
                                    class="input-group"
                                    :class="{
                                        'is-invalid': errors.perfil_id,
                                    }"
                                >
                                    <input
                                        type="text"
                                        placeholder="Escriba un nombre"
                                        class="form-control"
                                        v-if="inputsModulos.perfils.muestra"
                                        v-model="inputsModulos.perfils.nombre"
                                    />
                                    <select
                                        class="form-control"
                                        :class="{
                                            'is-invalid': errors.perfil_id,
                                        }"
                                        v-model="perfil_sistema.perfil_id"
                                        v-if="!inputsModulos.perfils.muestra"
                                    >
                                        <option
                                            v-for="item in listInputs.perfils"
                                            :key="item.id"
                                            :value="item.id"
                                            :label="item.nombre"
                                        ></option>
                                    </select>
                                    <template
                                        v-if="!inputsModulos.perfils.muestra"
                                    >
                                        <!-- nuevo -->
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-outline-primary"
                                                type="button"
                                                @click="
                                                    muestraInput(
                                                        'perfils',
                                                        true
                                                    )
                                                "
                                            >
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- eliminar -->
                                        <div
                                            class="input-group-append"
                                            v-if="
                                                perfil_sistema.perfil_id != ''
                                            "
                                        >
                                            <button
                                                class="btn btn-outline-danger"
                                                type="button"
                                                @click="
                                                    eliminaRegistro(
                                                        'perfils',
                                                        perfil_sistema.perfil_id
                                                    )
                                                "
                                            >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </template>
                                    <template
                                        v-if="inputsModulos.perfils.muestra"
                                    >
                                        <!-- enviar/guardar -->
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-success"
                                                type="button"
                                                @click="
                                                    enviaRegistro('perfils')
                                                "
                                            >
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                        <!-- cancelar -->
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-outline-light"
                                                type="button"
                                                @click="
                                                    muestraInput(
                                                        'perfils',
                                                        false
                                                    )
                                                "
                                            >
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.perfil_id"
                                    v-text="errors.perfil_id[0]"
                                ></span>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div
                                v-for="(opcion, index) in listOpciones"
                                class="col-md-12 mb-1"
                                :key="index"
                            >
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{
                                            index + 1
                                        }}</span>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="opcion.nombre"
                                        readonly
                                    />
                                </div>
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

        perfil_sistema: {
            type: Object,
            default: {
                id: 0,
                perfil_id: "",
                sistema_id: "",
            },
        },
    },
    watch: {
        muestra_modal: function (newVal, oldVal) {
            this.errors = [];
            this.getOpcionesSistema();
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
            inputsModulos: {
                perfils: {
                    muestra: false,
                    nombre: "",
                },
            },
            listInputs: {
                perfils: [],
            },
            listSistemas: [],
            listOpciones: [],
        };
    },
    mounted() {
        this.getPerfils();
        this.getSistemas();
        this.bModal = this.muestra_modal;
    },
    methods: {
        //get Cargos
        getPerfils() {
            axios.get("/admin/perfils").then((response) => {
                console.log(response.data.perfils);
                this.listInputs["perfils"] = response.data.perfils;
            });
        },
        //get Sistemas
        getSistemas() {
            axios.get("/admin/sistemas").then((response) => {
                this.listSistemas = response.data.sistemas;
            });
        },
        getOpcionesSistema() {
            if (this.perfil_sistema.sistema_id != "") {
                axios
                    .get(
                        "/admin/sistemas/getOpcionesSistema/" +
                            this.perfil_sistema.sistema_id
                    )
                    .then((response) => {
                        this.listOpciones = response.data;
                    });
            } else {
                console.log("aSDasdasd");
                this.listOpciones = [];
            }
        },

        // envia modal
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = "/admin/perfil_sistemas";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "perfil_id",
                    this.perfil_sistema.perfil_id
                        ? this.perfil_sistema.perfil_id
                        : ""
                );
                formdata.append(
                    "sistema_id",
                    this.perfil_sistema.sistema_id
                        ? this.perfil_sistema.sistema_id
                        : ""
                );

                if (this.accion == "edit") {
                    url = "/admin/perfil_sistemas/" + this.perfil_sistema.id;
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
                        this.limpiaPerfilSistema();
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
        limpiaPerfilSistema() {
            this.errors = [];
            this.perfil_sistema.perfil_id = "";
            this.perfil_sistema.sistema_id = "";
        },
        muestraInput(modulo, muestra) {
            this.inputsModulos[modulo].muestra = muestra;
            if (!muestra) {
                this.inputsModulos[modulo].nombre = "";
            }
        },
        enviaRegistro(modulo) {
            if (this.inputsModulos[modulo].nombre != "") {
                axios
                    .post("/admin/" + modulo, {
                        nombre: this.inputsModulos[modulo].nombre,
                    })
                    .then((response) => {
                        this.listInputs[modulo].push(
                            response.data[modulo.slice(0, -1)]
                        );
                        this.perfil_sistema[modulo.slice(0, -1) + "_id"] =
                            response.data[modulo.slice(0, -1)].id;
                        this.muestraInput(modulo, false);
                    });
            }
        },
        eliminaRegistro(modulo, id) {
            if (id != "") {
                Swal.fire({
                    title: "¿Quierés eliminar este registro?",
                    html: ``,
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Si, eliminar",
                    cancelButtonText: "No, cancelar",
                    denyButtonText: `No, cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios
                            .post("/admin/" + modulo + "/" + id, {
                                _method: "DELETE",
                            })
                            .then((response) => {
                                this.listInputs[modulo] = this.listInputs[
                                    modulo
                                ].filter(function (obj) {
                                    return obj.id !== id;
                                });
                                this.perfil_sistema[
                                    modulo.slice(0, -1) + "_id"
                                ] = "";
                            });
                    }
                });
            }
        },
    },
};
</script>

<style></style>
