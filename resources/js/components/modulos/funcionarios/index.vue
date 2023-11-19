<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Funcionarios</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button
                                            v-if="
                                                permisos.includes(
                                                    'funcionarios.create'
                                                )
                                            "
                                            class="btn btn-outline-primary bg-primary btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaFuncionario();
                                            "
                                        >
                                            <i class="fa fa-upload"></i>
                                            Importar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <b-col lg="4" class="my-1 ml-auto">
                                        <div class="form-group text-xs">
                                            <label>Buscar:</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="filter_ci"
                                                @keyup="getFuncionarios"
                                                placeholder="C.I."
                                            />
                                        </div>
                                    </b-col>
                                    <div class="col-md-12">
                                        <b-overlay
                                            :show="showOverlay"
                                            rounded="sm"
                                        >
                                            <b-table
                                                :fields="fields"
                                                :items="listRegistros"
                                                show-empty
                                                stacked="md"
                                                responsive
                                                :current-page="currentPage"
                                                :per-page="perPage"
                                                @filtered="onFiltered"
                                                empty-text="Sin resultados"
                                                empty-filtered-text="Sin resultados"
                                                :filter="filter"
                                            >
                                                <template
                                                    #cell(fecha_registro)="row"
                                                >
                                                    {{
                                                        formatoFecha(
                                                            row.item
                                                                .fecha_registro
                                                        )
                                                    }}
                                                </template>

                                                <template #cell(accion)="row">
                                                    <div
                                                        class="row justify-content-between"
                                                    >
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-warning"
                                                            class="btn-flat btn-block"
                                                            title="Editar registro"
                                                            @click="
                                                                editarRegistro(
                                                                    row.item
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-edit"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            size="sm"
                                                            pill
                                                            variant="outline-danger"
                                                            class="btn-flat btn-block"
                                                            title="Eliminar registro"
                                                            @click="
                                                                eliminaFuncionario(
                                                                    row.item.id,
                                                                    row.item
                                                                        .full_name
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-trash"
                                                            ></i>
                                                        </b-button>
                                                    </div>
                                                </template>
                                            </b-table>
                                        </b-overlay>
                                        <div class="row">
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="ml-auto my-1"
                                            >
                                                <b-form-select
                                                    align="right"
                                                    id="per-page-select"
                                                    v-model="perPage"
                                                    :options="pageOptions"
                                                    size="sm"
                                                ></b-form-select>
                                            </b-col>
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="my-1 mr-auto"
                                                v-if="perPage"
                                            >
                                                <b-pagination
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
                                                    :per-page="perPage"
                                                    align="left"
                                                ></b-pagination>
                                            </b-col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Nuevo
            :muestra_modal="muestra_modal"
            :accion="modal_accion"
            :funcionario="oFuncionario"
            @close="muestra_modal = false"
            @envioModal="getFuncionarios"
        ></Nuevo>
    </div>
</template>

<script>
import Nuevo from "./Nuevo.vue";
export default {
    components: {
        Nuevo,
    },
    data() {
        return {
            permisos: localStorage.getItem("permisos"),
            search: "",
            listRegistros: [],
            showOverlay: false,
            fields: [
                {
                    key: "ci",
                    label: "C.I.",
                    sortable: true,
                },
                { key: "nombre", label: "Nombre(s)", sortable: true },
                { key: "paterno", label: "Ap. Patenro", sortable: true },
                { key: "materno", label: "Ap. Materno", sortable: true },
                {
                    key: "cargo.nombre",
                    label: "Cargo",
                    sortable: true,
                },
                {
                    key: "regional.nombre",
                    label: "Regional",
                    sortable: true,
                },
                {
                    key: "agencia.nombre",
                    label: "Agencia",
                    sortable: true,
                },
                {
                    key: "fecha_registro",
                    label: "Fecha de registro",
                    sortable: true,
                },
                { key: "accion", label: "Acción" },
            ],
            loading: true,
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            muestra_modal: false,
            modal_accion: "nuevo",
            oFuncionario: {
                id: 0,
                ci: "",
                nombre: "",
                paterno: "",
                materno: "",
                cargo_id: "",
                regional_id: "",
                agencia_id: "",
            },
            currentPage: 1,
            perPage: 5,
            pageOptions: [
                { value: 5, text: "Mostrar 5 Registros" },
                { value: 10, text: "Mostrar 10 Registros" },
                { value: 25, text: "Mostrar 25 Registros" },
                { value: 50, text: "Mostrar 50 Registros" },
                { value: 100, text: "Mostrar 100 Registros" },
                { value: this.totalRows, text: "Mostrar Todo" },
            ],
            totalRows: 10,
            filter: null,
            listCargos: [],
            listRegionals: [],
            listAgencias: [],
            filter_ci: "",
            filter_nombre: "",
            filter_cargo: "",
            filter_regional: "",
            filter_agencia: "",
            filter_fecha: "",
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getFuncionarios();
        this.getCargos();
        this.getRegionals();
        this.getAgencias();
    },
    methods: {
        //get Cargos
        getCargos() {
            axios.get("/admin/cargos").then((response) => {
                this.listCargos = response.data.cargos;
                this.listCargos.unshift({ id: "", nombre: "Todos" });
            });
        },
        //get Regionals
        getRegionals() {
            axios.get("/admin/regionals").then((response) => {
                this.listRegionals = response.data.regionals;
                this.listRegionals.unshift({ id: "", nombre: "Todos" });
            });
        },
        //get Agencias
        getAgencias() {
            axios.get("/admin/agencias").then((response) => {
                this.listAgencias = response.data.agencias;
                this.listAgencias.unshift({ id: "", nombre: "Todos" });
            });
        },
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oFuncionario.id = item.id;
            this.oFuncionario.ci = item.ci ? item.ci : "";
            this.oFuncionario.nombre = item.nombre ? item.nombre : "";
            this.oFuncionario.paterno = item.paterno ? item.paterno : "";
            this.oFuncionario.materno = item.materno ? item.materno : "";
            this.oFuncionario.cargo_id = item.cargo_id ? item.cargo_id : "";
            this.oFuncionario.regional_id = item.regional_id
                ? item.regional_id
                : "";
            this.oFuncionario.agencia_id = item.agencia_id
                ? item.agencia_id
                : "";

            this.modal_accion = "edit";
            this.muestra_modal = true;
        },

        // Listar Funcionarios
        getFuncionarios() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = "/admin/funcionarios";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: {
                        filter_ci: this.filter_ci,
                        filter_nombre: this.filter_nombre,
                        filter_cargo: this.filter_cargo,
                        filter_regional: this.filter_regional,
                        filter_agencia: this.filter_agencia,
                        filter_fecha: this.filter_fecha,
                    },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.funcionarios;
                    this.totalRows = res.data.total;
                });
        },
        eliminaFuncionario(id, descripcion) {
            Swal.fire({
                title: "¿Quierés eliminar este registro?",
                html: `<strong>${descripcion}</strong>`,
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                denyButtonText: `No, cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .post("/admin/funcionarios/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            this.getFuncionarios();
                            this.filter = "";
                            Swal.fire({
                                icon: "success",
                                title: res.data.msj,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        });
                }
            });
        },
        abreModal(tipo_accion = "nuevo", funcionario = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (funcionario) {
                this.oFuncionario = funcionario;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaFuncionario() {
            this.oFuncionario.ci = "";
            this.oFuncionario.nombre = "";
            this.oFuncionario.paterno = "";
            this.oFuncionario.materno = "";
            this.oFuncionario.cargo_id = "";
            this.oFuncionario.regional_id = "";
            this.oFuncionario.agencia_id = "";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style></style>
