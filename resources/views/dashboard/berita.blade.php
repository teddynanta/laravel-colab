<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berita</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    <h1>List Berita Bulan {{ $bulan }}</h1>
    <h3>Total Berita : {{ $totalData }} Berita</h3>
    <p><a href="/export-excel">Export ke Excel</a></p>
    <div class="container">
        <table border="1" style="width: 100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Post</th>
                    <th>Link</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data as $record)
                    {{-- @dd($data); --}}
                    <tr>
                        <td align="center">{{ $i }}</td>
                        <td>{{ $record->title }}</td>
                        <td>{{ $record->category->nama }}</td>
                        <td align="center">{{ $record->tanggal_post }}</td>
                        <td><a
                                href="https://lubuklinggaukota.go.id/public/detilberita/{{ $record->id . '/' . $record->title }}">https://lubuklinggaukota.go.id/public/detilberita/{{ $record->id . '/' . $record->title }}</a>
                        </td>
                        <!-- Add more columns as needed -->
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    @php
        Session::put('data', $data);
        Session::put('bulan', $bulan);
    @endphp
</body>

</html>
