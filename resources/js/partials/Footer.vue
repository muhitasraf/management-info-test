<template>
    <div class="navbar navbar-sm navbar-footer border-top">
        <div class="container-fluid">
            <span>&copy; 2022 <a href="">Limitless Web App Kit</a></span>

            <ul class="nav">
                <li class="nav-item">
                    <a href="" class="navbar-nav-link navbar-nav-link-icon rounded">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph-lifebuoy"></i>
                            <span class="d-none d-md-inline-block ms-2">Support</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    $(document).ready(function onDocumentReady() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });

    $('#dataTable').DataTable();
</script>
