@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">
                @php
                    $userPhoto = 'images/profile/' . ($user->foto ?? '');
                    $userPhotoUrl =
                        file_exists(public_path($userPhoto)) && !empty($user->foto)
                            ? asset($userPhoto)
                            : asset('images/user.png');
                @endphp

                <!-- Foto Profil -->
                <form id="photoUploadForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->user_id }}">
                    <label for="photoInput" style="cursor: pointer;">
                        <img id="profilePhotoPreview" src="{{ $userPhotoUrl }}" alt="User Photo" class="img-thumbnail mb-2"
                            style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;">
                    </label>
                    <input type="file" name="foto" id="photoInput" accept="image/*" style="display: none;">
                    <br>
                    <button type="button" class="btn btn-sm btn-primary"
                        onclick="document.getElementById('photoInput').click();">Edit Foto</button>
                </form>

                <!-- Form Data User -->
                <form action="{{ url('/profile/' . $user->user_id . '/profile_update_ajax') }}" method="POST"
                    id="form-edit">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-4 text-left">
                        <label>Username</label>
                        <input value="{{ $user->username }}" type="text" name="username" id="username"
                            class="form-control" required>
                        <small id="error-username" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group text-left">
                        <label>Nama</label>
                        <input value="{{ $user->nama }}" type="text" name="nama" id="nama" class="form-control"
                            required>
                        <small id="error-nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group text-left">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="form-text text-muted">Abaikan jika tidak ingin ubah password</small>
                        <small id="error-password" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        $(document).ready(function() {
            // validasi form data user
            $("#form-edit").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    password: {
                        minlength: 6,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataUser.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Auto-upload saat foto diganti
            $('#photoInput').on('change', function() {
                let formData = new FormData($('#photoUploadForm')[0]);

                $.ajax({
                    url: "{{ url('/profile/' . $user->user_id . '/foto_update_ajax') }}", 
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status) {
                            $('#profilePhotoPreview').attr('src', response.photo_url + '?t=' + new Date().getTime());
                            Swal.fire({
                                icon: 'success',
                                title: 'Foto Diperbarui',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengunggah foto.'
                        });
                    }
                });
            });

        });
    </script>
@endempty
