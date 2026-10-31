    <label for="nama">Nama</label>
    <input id="nama" type="text" name="nama" placeholder="Contoh: Ahmad Fauzi" value="{{ old('nama', $item->nama ?? '') }}" required>
    <p class="help">Nama lengkap pengurus, sesuai nama yang biasa dipakai jamaah.</p>
    <label for="jabatan">Jabatan</label>
    <input id="jabatan" type="text" name="jabatan" placeholder="Contoh: Ketua DKM" value="{{ old('jabatan', $item->jabatan ?? '') }}" required>
    <p class="help">Jabatan di kepengurusan, misalnya Ketua DKM, Sekretaris, atau Bendahara.</p>
    @if (! empty($item) && $item->fotoUrl())
        <p><b>Foto saat ini:</b></p>
        <p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt="Foto pengurus saat ini"></p>
        <p class="help">Kosongkan kolom foto di bawah bila tidak ingin mengganti foto ini.</p>
    @endif
    <label for="foto">Foto (JPG/PNG/WebP, maks 2 MB)</label>
    <input id="foto" type="file" name="foto" accept="image/*">
    <p class="help">Foto boleh dikosongkan. Bila diisi, foto lama akan diganti dengan foto baru ini.</p>
    <label for="urutan">Urutan Tampil</label>
    <input id="urutan" type="number" name="urutan" placeholder="Contoh: 1" value="{{ old('urutan', $item->urutan ?? '') }}" required>
    <p class="help">Angka urutan tampil: 1 tampil paling atas, lalu 2, 3, dan seterusnya.</p>
