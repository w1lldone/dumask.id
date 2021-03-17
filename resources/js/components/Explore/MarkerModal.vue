<template>
    <div>
        <div class="modal fade" id="marker-modal-id" tabindex="-1" role="dialog" aria-labelledby="modal-id" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mx-4">
                        <h5 class="modal-title font-weight-bold text-muted" id="modal-title">STATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-4">
                        <div class="d-flex">
                            <img src="img/dummy_image.png" alt="" class="img-fluid mx-auto" style="max-height:200px">
                        </div>
                        <div class="mt-4">
                            <h5 class="text-secondary font-weight-bold">{{ station.name }}</h5>
                            <p>{{ station.address }}</p>
                            <div>
                                <img src="img/icon_clock.svg" alt="" style="max-height:16px">
                                <span class="text-secondary font-weight-bold align-middle ml-2">07.00 - 20.00 WIB</span>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary shadow">ROUTE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "MarkerModal",
    props: {
        station: {
            type: Object
        }
    },
}
</script>

<style lang="sass" scoped>

</style>