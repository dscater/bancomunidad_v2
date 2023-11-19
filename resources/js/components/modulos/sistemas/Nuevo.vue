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
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.nombre,
                                    }"
                                    >Nombre sistema*</label
                                >
                                <el-input
                                    placeholder="Nombre sistema"
                                    :class="{ 'is-invalid': errors.nombre }"
                                    v-model="sistema.nombre"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.nombre"
                                    v-text="errors.nombre[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.objetivo,
                                    }"
                                    >Objetivo*</label
                                >

                                <el-input
                                    type="textarea"
                                    autosize
                                    placeholder="Objetivo"
                                    :class="{ 'is-invalid': errors.objetivo }"
                                    v-model="sistema.objetivo"
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.objetivo"
                                    v-text="errors.objetivo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.version,
                                    }"
                                    >Versión*</label
                                >
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Versión"
                                    :class="{ 'is-invalid': errors.version }"
                                    v-model="sistema.version"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.version"
                                    v-text="errors.version[0]"
                                ></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.tipo,
                                    }"
                                    >Tipo de Procesamiento o Ejecución*</label
                                >
                                <el-select
                                    class="w-100 d-block"
                                    :class="{
                                        'is-invalid': errors.tipo,
                                    }"
                                    v-model="sistema.tipo"
                                    clearable
                                >
                                    <el-option
                                        v-for="item in listTipos"
                                        :key="item"
                                        :value="item"
                                        :label="item"
                                    >
                                    </el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.tipo"
                                    v-text="errors.tipo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.fecha_produccion,
                                    }"
                                    >Fecha Puesta en Producción*</label
                                >
                                <el-date-picker
                                    type="date"
                                    class="w-100"
                                    :class="{
                                        'is-invalid': errors.fecha_produccion,
                                    }"
                                    placeholder="dd/mm/yyyy"
                                    format="dd/MM/yyyy"
                                    value-format="yyyy-MM-dd"
                                    v-model="sistema.fecha_produccion"
                                    :picker-options="pickerOptions"
                                >
                                </el-date-picker>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.fecha_produccion"
                                    v-text="errors.fecha_produccion[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger':
                                            errors.empresa_proveedora,
                                    }"
                                    >Empresa Proveedora</label
                                >
                                <el-input
                                    placeholder="Empresa Proveedora"
                                    :class="{
                                        'is-invalid': errors.empresa_proveedora,
                                    }"
                                    v-model="sistema.empresa_proveedora"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.empresa_proveedora"
                                    v-text="errors.empresa_proveedora[0]"
                                ></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Opciones</label>
                                <button
                                    class="btn btn-success btn-xs"
                                    @click.prevent="agregarOpcion"
                                >
                                    <i class="fa fa-plus"></i> Agregar
                                </button>
                            </div>
                            <div class="row mt-2">
                                <div
                                    v-for="(opcion, index) in sistema.opciones"
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
                                        />
                                        <div class="input-group-append">
                                            <button
                                                class="btn btn-default"
                                                type="button"
                                                @click="
                                                    quitarOpcion(
                                                        index,
                                                        opcion.id
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fa fa-times text-red"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
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
        sistema: {
            type: Object,
            default: {
                id: 0,
                nombre: "",
                objetivo: "",
                version: "",
                tipo: "",
                fecha_produccion: "",
                empresa_proveedora: "",
                opciones: [],
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
            eliminados: [],
            errors: [],
            listTipos: ["EXTERNO", "INTERNO"],
            pickerOptions: {
                disabledDate(time) {
                    return time.getTime() > Date.now();
                },
                shortcuts: [
                    {
                        text: "Hoy",
                        onClick(picker) {
                            picker.$emit("pick", new Date());
                        },
                    },
                    {
                        text: "Ayer",
                        onClick(picker) {
                            const date = new Date();
                            date.setTime(date.getTime() - 3600 * 1000 * 24);
                            picker.$emit("pick", date);
                        },
                    },
                    {
                        text: "Hace una semana",
                        onClick(picker) {
                            const date = new Date();
                            date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                            picker.$emit("pick", date);
                        },
                    },
                ],
            },
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
    },
    methods: {
        // envia modal
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = "/admin/sistemas";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "nombre",
                    this.sistema.nombre ? this.sistema.nombre : ""
                );
                formdata.append(
                    "objetivo",
                    this.sistema.objetivo ? this.sistema.objetivo : ""
                );
                formdata.append(
                    "version",
                    this.sistema.version ? this.sistema.version : ""
                );
                formdata.append(
                    "tipo",
                    this.sistema.tipo ? this.sistema.tipo : ""
                );
                formdata.append(
                    "fecha_produccion",
                    this.sistema.fecha_produccion
                        ? this.sistema.fecha_produccion
                        : ""
                );
                formdata.append(
                    "empresa_proveedora",
                    this.sistema.empresa_proveedora
                        ? this.sistema.empresa_proveedora
                        : ""
                );

                this.sistema.opciones.forEach((elem) => {
                    formdata.append("opciones_id[]", elem.id);
                    formdata.append("opciones_nombre[]", elem.nombre);
                });

                if (this.accion == "edit") {
                    url = "/admin/sistemas/" + this.sistema.id;
                    formdata.append("_method", "PUT");
                    this.eliminados.forEach((elem) => {
                        formdata.append("eliminados[]", elem);
                    });
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
                        this.limpiaSistema();
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
        limpiaSistema() {
            this.errors = [];
            this.sistema.ci = "";
            this.sistema.nombre = "";
            this.sistema.paterno = "";
            this.sistema.materno = "";
            this.sistema.cargo_id = "";
            this.sistema.regional_id = "";
            this.sistema.agencia_id = "";
        },
        fechaActual() {
            // crea un nuevo objeto `Date`
            var today = new Date();

            // `getDate()` devuelve el día del mes (del 1 al 31)
            var day = today.getDate();
            if (day < 10) {
                day = "0" + day;
            }
            // `getMonth()` devuelve el mes (de 0 a 11)
            var month = today.getMonth() + 1;
            if (month < 10) {
                month = "0" + month;
            }

            // `getFullYear()` devuelve el año completo
            var year = today.getFullYear();

            // muestra la fecha de hoy en formato `MM/DD/YYYY`
            return `${year}-${month}-${day}`;
        },

        agregarOpcion() {
            this.sistema.opciones.push({
                id: 0,
                nombre: "",
            });
        },
        quitarOpcion(index, id) {
            if (id != 0) {
                this.eliminados.push(id);
            }
            this.sistema.opciones.splice(index, 1);
        },
    },
};
</script>

<style></style>
