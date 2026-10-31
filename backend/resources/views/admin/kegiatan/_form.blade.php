    <label for="judul">Judul</label>
    <input id="judul" type="text" name="judul" placeholder="Contoh: Pengajian Rutin Ahad Pagi" value="{{ old('judul', $item->judul ?? '') }}" required>
    <p class="help">Tulis judul kegiatan selengkap mungkin, misalnya nama pengajian atau acara.</p>
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="5" required placeholder="Contoh: Pengajian setiap Ahad pagi setelah Subuh, terbuka untuk seluruh jamaah.">{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
    <p class="help">Jelaskan kegiatan ini: apa, kapan, dan untuk siapa.</p>
    <label for="tanggal">Tanggal</label>
    <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', (isset($item) && $item->tanggal) ? $item->tanggal->format('Y-m-d') : '') }}" required>
    <p class="help">Tanggal pelaksanaan kegiatan.</p>
    @if (! empty($item) && $item->fotoUrl())
        <p><b>Foto saat ini:</b></p>
        <p><img style="max-width:400px;width:100%;border-radius:12px" src="{{ $item->fotoUrl() }}" alt="Foto kegiatan saat ini"></p>
        <p class="help">Kosongkan kolom foto di bawah bila tidak ingin mengganti foto ini.</p>
    @endif
    <label for="foto">Foto (JPG/PNG/WebP, maks 2 MB)</label>
    <input id="foto" type="file" name="foto" accept="image/*">
    <p class="help">Foto boleh dikosongkan. Bila diisi, foto lama akan diganti dengan foto baru ini.</p>
