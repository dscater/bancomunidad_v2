<template>
    <tr>
        <td>{{ o_sistema.nombre }}</td>
        <td>
            <template v-if="o_funcionario_id != ''">
                <div class="d-flex justify-content-center align-items-center">
                    <el-switch
                        v-model="sw_acceso"
                        active-text="SI"
                        inactive-text="NO"
                        active-color="#13ce66"
                        inactive-color="#ff4949"
                        @change="cambiaAcceso"
                        :disabled="enviando"
                    >
                    </el-switch>
                    <div class="cargando ml-2">
                        <template v-if="enviando">
                            <i
                                class="fa"
                                :class="{
                                    'fa-spinner fa-spin text-gray': !enviado,
                                    'fa-check text-green': enviado,
                                }"
                            ></i>
                        </template>
                    </div>
                </div>
            </template>
            <template v-else>
                <b class="text-gray"
                    ><small><i>Seleccione funcionario</i></small></b
                >
            </template>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["sistema", "funcionario_id"],
    data() {
        return {
            o_sistema: this.sistema,
            o_funcionario_id: this.funcionario_id,
            sw_acceso: false,
            enviando: false,
            enviado: false,
        };
    },
    watch: {
        sistema(newVal, oldVal) {
            this.o_sistema = newVal;
            this.getAccesoSistema();
        },
        funcionario_id(newVal, oldVal) {
            this.o_funcionario_id = newVal;
            this.getAccesoSistema();
        },
    },
    mounted() {
        this.getAccesoSistema();
    },
    methods: {
        getAccesoSistema() {
            axios
                .get("/admin/acceso_sistemas/getAccesoSistema", {
                    params: {
                        funcionario_id: this.o_funcionario_id,
                        sistema_id: this.o_sistema.id,
                    },
                })
                .then((response) => {
                    this.sw_acceso = response.data;
                });
        },
        cambiaAcceso() {
            this.enviando = true;
            this.enviado = false;
            axios
                .post("/admin/acceso_sistemas", {
                    funcionario_id: this.o_funcionario_id,
                    sistema_id: this.o_sistema.id,
                    sw_acceso: this.sw_acceso,
                })
                .then((response) => {
                    this.enviado = true;
                    this.sw_acceso = response.data.acceso;
                    setTimeout(() => {
                        this.enviando = false;
                    }, 1000);
                });
        },
    },
};
</script>
<style></style>
