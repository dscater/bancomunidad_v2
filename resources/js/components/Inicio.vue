<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-primary text-white">
                                <p 
                                class="text-xl"
                                    style="
                                        text-align: center;
                                    "
                                >
                                    BAN<strong>COMUNIDAD</strong>
                                </p>
                                <p style="text-align: center">
                                    ¡BIENVENIDO USUARIO {{ user.tipo }}!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div
                        class="col-12 col-sm-6 col-md-3"
                        v-for="(item, index) in listInfoBox"
                        :key="index"
                    >
                        <div class="info-box">
                            <span
                                class="info-box-icon elevation-1"
                                :class="item.color"
                                ><i :class="item.icon"></i
                            ></span>
                            <div class="info-box-content">
                                <span class="info-box-text">{{
                                    item.label
                                }}</span>
                                <span class="info-box-number">{{
                                    item.cantidad
                                }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            usuarios: 10,
            user: JSON.parse(localStorage.getItem("user")),
            listInfoBox: [],
        };
    },
    mounted() {
        this.loadingWindow.close();
        // this.getInfoBox();
    },
    methods: {
        getInfoBox() {
            axios.get("/admin/usuarios/getInfoBox").then((res) => {
                this.listInfoBox = res.data;
            });
        },
    },
};
</script>

<style></style>
