<a class="btn btn-info" id="bulk_verify_btn"><i class="voyager-check-circle"></i> <span>Bulk Verify</span></a>

{{-- Bulk verify modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="bulk_verify_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="voyager-check-circle"></i> Are you sure? <span id="bulk_verify_count"></span> <span id="bulk_verify_display_name"></span>?
                </h4>
            </div>
            <div class="modal-body" id="bulk_verify_modal_body">
            </div>
            <div class="modal-footer">
                <form action="{{ route('voyager.'.$dataType->slug.'.index') }}/0" id="bulk_verify_form" method="POST">
                    {{ method_field("PATCH") }}
                    {{ csrf_field() }}
                    <input type="hidden" name="ids" id="bulk_verify_input" value="">
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                             value="Bulk Verify Challans">
                </form>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                    {{ __('voyager::generic.cancel') }}
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
window.onload = function () {
    // Bulk verify selectors
    var $bulkVerifyBtn = $('#bulk_verify_btn');
    var $bulkVerifyModal = $('#bulk_verify_modal');
    var $bulkVerifyCount = $('#bulk_verify_count');
    var $bulkVerifyDisplayName = $('#bulk_verify_display_name');
    var $bulkVerifyInput = $('#bulk_verify_input');
    // Reposition modal to prevent z-index issues
    $bulkVerifyModal.appendTo('body');
    // Bulk delete listener
    $bulkVerifyBtn.click(function () {
        var ids = [];
        var $checkedBoxes = $('#dataTable input[type=checkbox]:checked').not('.select_all');
        var count = $checkedBoxes.length;
        if (count) {
            // Reset input value
            $bulkVerifyInput.val('');
            // Deletion info
            var displayName = count > 1 ? '{{ $dataType->getTranslatedAttribute('display_name_plural') }}' : '{{ $dataType->getTranslatedAttribute('display_name_singular') }}';
            displayName = displayName.toLowerCase();
            $bulkVerifyCount.html(count);
            $bulkVerifyDisplayName.html(displayName);
            // Gather IDs
            $.each($checkedBoxes, function () {
                var value = $(this).val();
                ids.push(value);
            })
            // Set input value
            $bulkVerifyInput.val(ids);
            // Show modal
            $bulkVerifyModal.modal('show');
        } else {
            // No row selected
            toastr.warning('{{ __('voyager::generic.bulk_verify_nothing') }}');
        }
    });
}
</script>
