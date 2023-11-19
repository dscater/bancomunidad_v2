<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Formulario FSI-08</h1>
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
                                                    'formularios.create'
                                                )
                                            "
                                            class="btn btn-outline-primary bg-primary btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaFormulario();
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Nuevo
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <button
                                            class="btn btn-outline-primary bg-success btn-flat btn-block"
                                            @click="excel()"
                                        >
                                            <i class="fa fa-file-excel"></i>
                                            Exportar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <b-col lg="10" class="my-1">
                                        <b-form-group
                                            label="Buscar"
                                            label-for="filter-input"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                            label-size="sm"
                                            class="mb-0"
                                        >
                                            <b-input-group size="sm">
                                                <b-form-input
                                                    id="filter-input"
                                                    v-model="filter"
                                                    type="search"
                                                    placeholder="Buscar"
                                                ></b-form-input>

                                                <b-input-group-append>
                                                    <b-button
                                                        class="bg-primary"
                                                        variant="primary"
                                                        :disabled="!filter"
                                                        @click="filter = ''"
                                                        >Borrar</b-button
                                                    >
                                                </b-input-group-append>
                                            </b-input-group>
                                        </b-form-group>
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
                                                <template #cell(detalle)="row">
                                                    <template
                                                        v-if="
                                                            row.item
                                                                .tipo_acceso ==
                                                                'ALTO DE ACCESO' ||
                                                            row.item
                                                                .tipo_acceso ==
                                                                'BAJA DE ACCESO'
                                                        "
                                                    >
                                                        <p>
                                                            <strong
                                                                >Cargo: </strong
                                                            ><br />{{
                                                                row.item.cargo
                                                                    .nombre
                                                            }}
                                                        </p>
                                                    </template>
                                                    <template v-else>
                                                        <p>
                                                            <strong
                                                                >Agencia origen: </strong
                                                            ><br />{{
                                                                row.item.origen
                                                                    .nombre
                                                            }}
                                                        </p>
                                                        <p>
                                                            <strong
                                                                >Agencia
                                                                destino: </strong
                                                            ><br />{{
                                                                row.item.destino
                                                                    .nombre
                                                            }}
                                                        </p>
                                                    </template>
                                                </template>
                                                <template
                                                    #cell(fecha_solicitud)="row"
                                                >
                                                    {{
                                                        row.item.fecha_solicitud
                                                            ? formatoFecha(
                                                                  row.item
                                                                      .fecha_solicitud
                                                              )
                                                            : ""
                                                    }}
                                                </template>
                                                <template
                                                    #cell(fecha_respuesta)="row"
                                                >
                                                    {{
                                                        row.item.fecha_respuesta
                                                            ? formatoFecha(
                                                                  row.item
                                                                      .fecha_respuesta
                                                              )
                                                            : ""
                                                    }}
                                                </template>
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
                                                                eliminaFormulario(
                                                                    row.item.id,
                                                                    row.item
                                                                        .funcionario
                                                                        .full_name +
                                                                        ' <br/><small>' +
                                                                        row.item
                                                                            .tipo_acceso +
                                                                        '</small>'
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
            :formulario="oFormulario"
            @close="muestra_modal = false"
            @envioModal="getFormularios"
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
                    key: "codigo",
                    label: "Código",
                    sortable: true,
                },
                {
                    key: "fecha_solicitud",
                    label: "Fecha de Solicitud",
                    sortable: true,
                },
                {
                    key: "fecha_respuesta",
                    label: "Fecha de Respuesta",
                    sortable: true,
                },
                {
                    key: "hora_solicitud",
                    label: "Hora de Solicitud",
                    sortable: true,
                },
                {
                    key: "hora_respuesta",
                    label: "Hora de Respuesta",
                    sortable: true,
                },
                {
                    key: "funcionario.full_name",
                    label: "Funcionario",
                    sortable: true,
                },
                {
                    key: "tipo_acceso",
                    label: "Tipo de Acceso",
                    sortable: true,
                },
                {
                    key: "detalle",
                    label: "Detalle",
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
            oFormulario: {
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
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getFormularios();
    },
    methods: {
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oFormulario.id = item.id;
            this.oFormulario.codigo = item.codigo ? item.codigo : "";
            this.oFormulario.fecha_solicitud = item.fecha_solicitud
                ? item.fecha_solicitud
                : "";
            this.oFormulario.fecha_respuesta = item.fecha_respuesta
                ? item.fecha_respuesta
                : "";
            this.oFormulario.hora_solicitud = item.hora_solicitud
                ? item.hora_solicitud
                : "";
            this.oFormulario.hora_respuesta = item.hora_respuesta
                ? item.hora_respuesta
                : "";
            this.oFormulario.funcionario_id = item.funcionario_id
                ? item.funcionario_id
                : "";
            this.oFormulario.tipo_acceso = item.tipo_acceso
                ? item.tipo_acceso
                : "";
            this.oFormulario.cargo_id = item.cargo_id ? item.cargo_id : "";
            this.oFormulario.agencia_origen = item.agencia_origen
                ? item.agencia_origen
                : "";
            this.oFormulario.agencia_destino = item.agencia_destino
                ? item.agencia_destino
                : "";

            this.modal_accion = "edit";
            this.muestra_modal = true;
        },
        excel() {
            let config = {
                responseType: "blob",
            };
            axios
                .post("/admin/formularios/excel", null, config)
                .then((response) => {
                    console.log(response);
                    let nom =
                        response.headers["content-disposition"].split("=");
                    var fileURL = window.URL.createObjectURL(
                        new Blob([response.data])
                    );
                    var fileLink = document.createElement("a");

                    fileLink.href = fileURL;
                    fileLink.setAttribute("download", "formularios.xlsx");
                    document.body.appendChild(fileLink);

                    fileLink.click();
                })
                .catch(async (error) => {
                    console.log(error);
                    let responseObj = await error.response.data.text();
                    responseObj = JSON.parse(responseObj);
                    this.enviando = false;
                    if (error.response) {
                    }
                });
        },

        // Listar Formularios
        getFormularios() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = "/admin/formularios";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: { per_page: this.per_page },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.formularios;
                    this.totalRows = res.data.total;
                });
        },
        eliminaFormulario(id, descripcion) {
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
                        .post("/admin/formularios/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            this.getFormularios();
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
        abreModal(tipo_accion = "nuevo", formulario = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (formulario) {
                this.oFormulario = formulario;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaFormulario() {
            this.oFormulario.codigo = "";
            this.oFormulario.fecha_solicitud = "";
            this.oFormulario.fecha_respuesta = "";
            this.oFormulario.hora_solicitud = "";
            this.oFormulario.hora_respuesta = "";
            this.oFormulario.funcionario_id = "";
            this.oFormulario.tipo_acceso = "";
            this.oFormulario.cargo_id = "";
            this.oFormulario.agencia_origen = "";
            this.oFormulario.agencia_destino = "";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style></style>
