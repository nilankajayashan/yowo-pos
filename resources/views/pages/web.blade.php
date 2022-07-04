<div class="m-0">
    <div class="bg-dark col-12" style="min-height: 100px; border-bottom-right-radius: 50px;">
        <div class="row">
            <h3 class="text-light col-lg-10">Site Settings</h3>
        </div>
    </div>
    <div class="ps-3 pe-3">
{{--        color models--}}
        <div class="modal fade" id="primaryButtonColorModal" tabindex="-1" aria-labelledby="primaryButtonColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="primaryButtonColorModalLabel">Primary Buttons Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="primary_button_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-primary" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-secondary" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-info" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="primary_button_color" value="btn-dark" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-light" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-danger" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-warning" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="primary_button_color" value="btn-success" class="" onchange="formSubmiter('primary_button_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="secondaryButtonColorModal" tabindex="-1" aria-labelledby="secondaryButtonColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondaryButtonColorModalLabel">Secondary Buttons Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="secondary_button_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-primary" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-secondary" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-info" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="secondary_button_color" value="btn-dark" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-light" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-danger" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-warning" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="secondary_button_color" value="btn-success" class="" onchange="formSubmiter('secondary_button_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ternaryButtonColorModal" tabindex="-1" aria-labelledby="ternaryButtonColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondaryButtonColorModalLabel">Ternary Buttons Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="ternary_button_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-primary" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-secondary" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-info" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="ternary_button_color" value="btn-dark" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-light" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-danger" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-warning" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="ternary_button_color" value="btn-success" class="" onchange="formSubmiter('ternary_button_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pendingStatusColorModal" tabindex="-1" aria-labelledby="pendingStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="secondaryButtonColorModalLabel">Pending Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="pending_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-primary" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-secondary" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-info" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="pending_status_color" value="btn-dark" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-light" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-danger" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-warning" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="pending_status_color" value="btn-success" class="" onchange="formSubmiter('pending_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="processingStatusColorModal" tabindex="-1" aria-labelledby="processingStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="processingStatusColorModalLabel">Processing Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="processing_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-primary" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-secondary" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-info" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="processing_status_color" value="btn-dark" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-light" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-danger" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-warning" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="processing_status_color" value="btn-success" class="" onchange="formSubmiter('processing_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="processedStatusColorModal" tabindex="-1" aria-labelledby="processedStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="processedStatusColorModalLabel">Processed Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="processed_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-primary" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-secondary" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-info" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="processed_status_color" value="btn-dark" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-light" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-danger" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-warning" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="processed_status_color" value="btn-success" class="" onchange="formSubmiter('processed_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="shippedStatusColorModal" tabindex="-1" aria-labelledby="shippedStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shippedStatusColorModalLabel">Shipped Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="shipped_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-primary" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-secondary" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-info" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="shipped_status_color" value="btn-dark" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-light" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-danger" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-warning" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="shipped_status_color" value="btn-success" class="" onchange="formSubmiter('shipped_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="completedStatusColorModal" tabindex="-1" aria-labelledby="completedStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completedStatusColorModalLabel">Completed Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="completed_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-primary" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-secondary" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-info" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="completed_status_color" value="btn-dark" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-light" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-danger" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-warning" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="completed_status_color" value="btn-success" class="" onchange="formSubmiter('completed_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="failedStatusColorModal" tabindex="-1" aria-labelledby="failedStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="failedStatusColorModalLabel">Failed Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="failed_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-primary" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-secondary" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-info" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="failed_status_color" value="btn-dark" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-light" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-danger" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-warning" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="failed_status_color" value="btn-success" class="" onchange="formSubmiter('failed_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="successStatusColorModal" tabindex="-1" aria-labelledby="successStatusColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successStatusColorModalLabel">Success Status Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="success_status_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-primary" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-secondary" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-info" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="success_status_color" value="btn-dark" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-light" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-danger" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-warning" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="success_status_color" value="btn-success" class="" onchange="formSubmiter('success_status_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="titleBarColorModal" tabindex="-1" aria-labelledby="titleBarColorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleBarColorModalLabel">Title Bar Color</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-web-color') }}" method="post" class="row justify-content-evenly" id="title_bar_color_form">
                            @csrf
                            <span class="mb-2 bg-primary p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-primary" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Blue&nbsp;</span>
                            <span class="mb-2 bg-secondary p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-secondary" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Gray&nbsp;</span>
                            <span class="mb-2 bg-info p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-info" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Sky Blue&nbsp;</span>
                            <span class="mb-2 bg-dark p-1 col-lg-5 rounded-pill text-white"><input type="radio" name="title_bar_color" value="bg-dark" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Black&nbsp;</span>
                            <span class="mb-2 bg-light p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-light" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;White&nbsp;</span>
                            <span class="mb-2 bg-danger p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-danger" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Red&nbsp;</span>
                            <span class="mb-2 bg-warning p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-warning" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Yellow&nbsp;</span>
                            <span class="mb-2 bg-success p-1 col-lg-5 rounded-pill"><input type="radio" name="title_bar_color" value="bg-success" class="" onchange="formSubmiter('title_bar_color_form')">&nbsp;Green&nbsp;</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--        end color models--}}
        <div class="row mt-3 justify-content-evenly">
            <div class="card col-lg-5 shadow" style="background-color:#F6FAFD;">
                <div class="card-body">
                    <h5>Color Settings</h5>

                    <div class="row mt-2">
                        <h6>Button Colors</h6>
                        <div class="col-lg-4">Primary Button: <button class="btn @if(isset($primaryButtonColor)) {{ $primaryButtonColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#primaryButtonColorModal"></button></div>
                        <div class="col-lg-4">Secondary Button: <button class="btn  @if(isset($secondaryButtonColor)) {{ $secondaryButtonColor->name }} @else btn-dark @endif rounded-pill"  data-bs-toggle="modal" data-bs-target="#secondaryButtonColorModal"></button></div>
                        <div class="col-lg-4">Ternary Button: <button class="btn  @if(isset($ternaryButtonColor)) {{ $ternaryButtonColor->name }} @else btn-dark @endif  rounded-pill" data-bs-toggle="modal" data-bs-target="#ternaryButtonColorModal"></button></div>

                    </div>
                    <div class="row mt-2">
                        <h6>Status Colors</h6>
                        <div class="col-lg-4">Pending: <button class="btn @if(isset($pendingStatusColor)) {{ $pendingStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#pendingStatusColorModal"></button></div>
                        <div class="col-lg-4">Processing: <button class="btn @if(isset($processingStatusColor)) {{ $processingStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#processingStatusColorModal"></button></div>
                        <div class="col-lg-4">Processed: <button class="btn @if(isset($processedStatusColor)) {{ $processedStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#processedStatusColorModal"></button></div>
                        <div class="col-lg-4">Shipped: <button class="btn @if(isset($shippedStatusColor)) {{ $shippedStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#shippedStatusColorModal"></button></div>
                        <div class="col-lg-4">Completed: <button class="btn @if(isset($completedStatusColor)) {{ $completedStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#completedStatusColorModal"></button></div>
                        <div class="col-lg-4">Failed: <button class="btn @if(isset($failedStatusColor)) {{ $failedStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#failedStatusColorModal"></button></div>
                        <div class="col-lg-4">Success: <button class="btn @if(isset($successStatusColor)) {{ $successStatusColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#successStatusColorModal"></button></div>
                    </div>

                    <div class="row mt-2">
                        <h6>Component Colors</h6>
                        <div class="col-lg-4">Title Bar: <button class="btn @if(isset($titleBarColor)) {{ $titleBarColor->name }} @else btn-dark @endif rounded-pill" data-bs-toggle="modal" data-bs-target="#titleBarColorModal"></button></div>
                    </div>
                    </div>
            </div>

            <div class="card col-lg-5 shadow" style="background-color:#F6FAFD;">
                <div class="card-body">
                    <h5>Basic Shop Details</h5>
                    <div class="row mb-2">
                       <span class="col-lg-4"> Logo: </span>
                        <button data-bs-toggle="modal" data-bs-target="#changeLogoModal" class="btn-sm btn-warning col-lg-8"> Change</button>

                    </div>
                    <form action="{{ route('update-shop-details') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <label for="name" class="col-lg-4">Name:</label>
                            <input type="text" placeholder="Shop Name" name="name" class="form-control col-lg-8" id="name">
                        </div>
                        <div class="row mb-2">
                            <label for="address" class="col-lg-4">Address:</label>
                            <input type="text" placeholder="Shop Address" name="address" class="form-control col-lg-8" id="address">
                        </div>
                        <div class="row mb-2">
                            <label for="email" class="col-lg-4">Email:</label>
                            <input type="text" placeholder="Shop Email" name="email" class="form-control col-lg-8" id="email">
                        </div>
                        <div class="row mb-2">
                            <label for="mobile" class="col-lg-4">Contact Number:</label>
                            <input type="text" placeholder="Shop Contact Number" name="mobile" class="form-control col-lg-8" id="mobile">
                        </div>

                        <div class="row mb-2">
                            <button type="submit" class="btn btn-warning">Update and Publish</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card col-lg-5 shadow" style="background-color:#F6FAFD;">
                <div class="card-body">
                    <h5>Slider Settings</h5>
                    <div class="row mb-2">
                        <span class="col-lg-4"> Images: </span>
                        <button data-bs-toggle="modal" data-bs-target="#changeSliderModal" class="btn-sm btn-warning col-lg-8"> Change</button>
                    </div>
                </div>
            </div>
            <div class="card col-lg-5 shadow" style="background-color:#F6FAFD;">
                <div class="card-body">
                    <h5>Social Links</h5>
                    <form action="{{ route('update-shop-social-links') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <label for="facebook" class="col-lg-4">FaceBook:</label>
                            <input type="text" placeholder="FaceBook URL" name="facebook" class="form-control col-lg-8" id="facebook">
                        </div>
                        <div class="row mb-2">
                            <label for="google" class="col-lg-4">Google:</label>
                            <input type="text" placeholder="Google URL" name="google" class="form-control col-lg-8" id="google">
                        </div>
                        <div class="row mb-2">
                            <button type="submit" class="btn btn-warning">Update and Publish</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function formSubmiter(form){
        document.getElementById(form).submit();
    }
</script>
