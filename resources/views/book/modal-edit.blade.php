<!-- Modal Edit -->
<div class="modal fade" id="modalUbah" tabindex="-1" aria-labelledby="modalUbahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUbahLabel">Ubah Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formUbah" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk edit form submission -->
<script>
    // Edit form submission
    $('#formUbah').submit(function(e) {
        e.preventDefault();
        var id = $('#modalUbah #id').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/book/' + id,
            type: 'PUT',
            data: formData,
            success: function(response) {
                $('#modal-edit').modal('hide');
                table.ajax.reload();
                // Tambahkan notifikasi sukses jika diperlukan
            },
            error: function(xhr) {
                // Handle error
                console.log(xhr.responseText);
                // Tambahkan notifikasi error jika diperlukan
            }
        });
    });
</script>
