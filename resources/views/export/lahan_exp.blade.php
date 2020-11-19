<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>Tanggal</th>
            <th>Luas</th>
            <th>Tampak Depan</th>
            <th>Lebar Jalan</th>
            <th>Jaringan Listrik</th>
            <th>Harga</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Tim</th>
            <th>Photo</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
    @foreach($lahans as $lahan)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $lahan->provinsi }}</td>
            <td>{{ $lahan->kabupaten }}</td>
            <td>{{ $lahan->kecamatan }}</td>
            <td>{{ $lahan->desa }}</td>
            <td>{{ $lahan->date }}</td>
            <td>{{ $lahan->luas }}</td>
            <td>{{ $lahan->tampak_depan }}</td>
            <td>{{ $lahan->lebar_jalan }}</td>
            <td>{{ $lahan->jaringan_listrik }}</td>
            <td>{{ $lahan->harga }}</td>
            <td>{{ $lahan->lat }}</td>
            <td>{{ $lahan->lng }}</td>
            <td>{{ $lahan->tim }}</td>
            <td>{{ $lahan->photo }}</td>
            <td>{{ $lahan->keterangan }}</td>
            <td>{{ $lahan->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>