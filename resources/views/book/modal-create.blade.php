<div id="modal-create" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
        </div>
        <div class="modal-body">
         <form action="{{ route('book.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" >
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis">
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun" name="tahun">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                    <button type="submit" class="btn btn-secondary">Kembali</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
