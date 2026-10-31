    @if (! empty($item) && $item->fotoUrl())
        <p><b>Foto saat ini:</b></p>
        <p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt="Foto slide show saat ini"></p>
        <p class="help">Kosongkan kolom foto di bawah bila tidak ingin mengganti foto ini.</p>
    @endif
    <label for="foto">Foto Slide Show (JPG/PNG/WebP, maks 2 MB)</label>
    <input id="foto" type="file" name="foto" accept="image/*" {{ empty($item) ? 'required' : '' }}>
    <p class="help">Pilih foto masjid asli (misalnya tampak depan masjid). Foto akan tampil besar di bagian atas beranda, jadi pilih foto yang jelas dan tidak buram.</p>
    <label for="judul">Judul (opsional)</label>
    <input id="judul" type="text" name="judul" placeholder="Contoh: Masjid Jami Baeturohman" value="{{ old('judul', $item->judul ?? '') }}">
    <p class="help">Judul yang tampil di atas foto. Boleh dikosongkan.</p>
    <label for="keterangan">Keterangan (opsional)</label>
    <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Suasana sholat berjamaah di masjid kami.">{{ old('keterangan', $item->keterangan ?? '') }}</textarea>
    <p class="help">Satu atau dua kalimat singkat di bawah judul. Boleh dikosongkan.</p>
    <label for="urutan">Urutan Tampil</label>
    <input id="urutan" type="number" name="urutan" placeholder="Contoh: 1" value="{{ old('urutan', $item->urutan ?? 0) }}" required>
    <p class="help">Angka urutan tampil: 1 tampil paling dulu, lalu 2, 3, dan seterusnya.</p>
    <label for="aktif">Tampilkan di Beranda?</label>
    @php $aktifTerpilih = (int) old('aktif', isset($item) ? ($item->aktif ? 1 : 0) : 1); @endphp
    <select id="aktif" name="aktif" required>
        <option value="1" {{ $aktifTerpilih === 1 ? 'selected' : '' }}>Ya, tampilkan</option>
        <option value="0" {{ $aktifTerpilih === 0 ? 'selected' : '' }}>Tidak, sembunyikan dulu</option>
    </select>
    <p class="help">Pilih "Tidak, sembunyikan dulu" bila slide ini belum ingin ditampilkan, tanpa harus menghapusnya.</p>
