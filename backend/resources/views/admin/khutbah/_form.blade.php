    <label for="tanggal">Tanggal Jumat</label>
    <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', (isset($item) && $item->tanggal) ? $item->tanggal->format('Y-m-d') : '') }}" required>
    <p class="help">Pilih hari Jumat dari kalender.</p>
    <label for="khatib">Khatib</label>
    <input id="khatib" type="text" name="khatib" placeholder="Contoh: Ustadz Ahmad" value="{{ old('khatib', $item->khatib ?? '') }}" required>
    <p class="help">Nama lengkap khatib Jumat minggu itu.</p>
    <label for="imam">Imam</label>
    <input id="imam" type="text" name="imam" placeholder="Contoh: Ustadz Budi" value="{{ old('imam', $item->imam ?? '') }}" required>
    <p class="help">Nama lengkap imam sholat Jumat minggu itu.</p>
    <label for="muadzin">Muadzin</label>
    <input id="muadzin" type="text" name="muadzin" placeholder="Contoh: Bapak Candra" value="{{ old('muadzin', $item->muadzin ?? '') }}" required>
    <p class="help">Nama lengkap muadzin Jumat minggu itu.</p>
    <label for="tema">Tema (opsional)</label>
    <input id="tema" type="text" name="tema" placeholder="Contoh: Menjaga Ukhuwah di Tengah Masyarakat" value="{{ old('tema', $item->tema ?? '') }}">
    <p class="help">Tema khutbah, bila sudah ditentukan. Boleh dikosongkan.</p>
